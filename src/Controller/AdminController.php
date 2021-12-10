<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\LoginFormAuthenticator;
use App\services\MailerService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Dompdf\Dompdf;
use Dompdf\Options;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;





class AdminController extends AbstractController
{
    /**
     * @Route("/admin/addDoctor", name="adminAddDoctor")
     */
    public function add(Request $request, UserPasswordEncoderInterface $userPasswordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $passwordEntred =  $form->get('plainPassword')->getData();

            // encode the plain password
            $user->setPassword(
            $userPasswordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setRoles(["ROLE_DOCTOR"]);

            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('user_index');


        }

        return $this->render('admin/addDoctor.html.twig', [
            'addDoctor' => $form->createView(),
        ]);

    }

        /**
     * @Route("/admin/bookings", name="adminBookings")
     */
    public function adminBookings(Request $request, EntityManagerInterface $entityManager): Response
    {
        $bookingRepo = $this->getDoctrine()->getRepository(Booking::class);
        $bookings = $bookingRepo->findBy([ 'doctor_id'=>$this->getUser()->getId() ] , ['created_at'=>'DESC']);

        if ($request->getMethod() == 'POST') {
            $bookings = $bookingRepo->findBy([ 'doctor_id'=>$this->getUser()->getId() , 'date'=>$request->request->get('bookings_search') ] , ['created_at'=>'DESC']);
        }
        
        if( $bookings){
            $usersRepo = $this->getDoctrine()->getRepository(User::class);
            $patient = $usersRepo->findOneBy([ 'id'=>$bookings[0]->getUserId() ]);
        }else{
            $this->addFlash(
                'NoBookingsfound',
                'Aucune Réservations Trouver'
            );
    
            return $this->redirectToRoute('user_index');

        }
        



        return $this->render('admin/bookings.html.twig' ,[
            'patient'=>$patient,
            'bookings'=>$bookings
        ]);

            
    }

    
        /**
     * @Route("/admin/todayBookings", name="todayBookings")
     */
    public function todayBookings(): Response
    {
        $todaysDate = new \DateTime();

        $bookingRepo = $this->getDoctrine()->getRepository(Booking::class);
        $bookings = $bookingRepo->findBy([ 'doctor_id'=>$this->getUser()->getId(), 'date'=>$todaysDate->format('Y-m-d') ] , ['created_at'=>'DESC']);
        
        if( $bookings){
            $usersRepo = $this->getDoctrine()->getRepository(User::class);
            $patient = $usersRepo->findOneBy([ 'id'=>$bookings[0]->getUserId() ]);
        }else{
            $this->addFlash(
                'NoBookingsfound',
                'Aucune Réservations Trouver'
            );
    
            return $this->redirectToRoute('adminBookings');

        }




        return $this->render('admin/today_bookings.html.twig' ,[
            'patient'=>$patient,
            'bookings'=>$bookings
        ]);


    }

            /**
     * @Route("/admin/toggleVisited/{booking}/{redirection}",defaults={"redirection"=1}, name="toggleVisited")
     */
    public function toggleVisited($booking , $redirection , EntityManagerInterface $entityManager): Response
    {
        $bookingRepo = $this->getDoctrine()->getRepository(Booking::class);
        $booking = $bookingRepo->find($booking);
        $newStatus =null;

        if(  $booking->getStatus() == 0 ){
            $newStatus = 1;
        }else{
            $newStatus = 0;
        }
        $booking->setStatus($newStatus);
        $entityManager->flush();

        if ($redirection == 1){

            return $this->redirectToRoute('adminBookings');
        }elseif( $redirection == 2 ){
            return $this->redirectToRoute('todayBookings');
        }


    }

    
    /**
     * @Route("/admin/confirmBooking/{booking}/{redirection}",defaults={"redirection"=1}, name="confirmBooking")
     */
    public function confirmBooking($booking , $redirection , EntityManagerInterface $entityManager , MailerService $mailerService ): Response
    {
        $bookingRepo = $this->getDoctrine()->getRepository(Booking::class);
        $booking = $bookingRepo->find($booking);
        $booking->setConfirmation(1);
        $entityManager->flush();

        // Get user
        $usersRepo = $this->getDoctrine()->getRepository(User::class);
        $patient = $usersRepo->findOneBy([ 'id'=> $booking->getUserId() ]);
        

        $mailerService->send(
            "Votre Réservation est confirmé",
            "ounsa@piimt.us",
            $patient->getEmail(),

            "email/booking_confirmed.html.twig",
            [ "time"=>$booking->getTime() , 'date'=> $booking->getDate()]
        );


        if ($redirection == 1){

            return $this->redirectToRoute('adminBookings');
        }elseif( $redirection == 2 ){
            return $this->redirectToRoute('todayBookings');
        }


    }

    /**
     * @Route("/admin/cancelBooking/{booking}/{redirection}",defaults={"redirection"=1}, name="cancelBooking")
     */
    public function cancelBooking($booking , $redirection , EntityManagerInterface $entityManager , MailerService $mailerService): Response
    {
        $bookingRepo = $this->getDoctrine()->getRepository(Booking::class);
        $booking = $bookingRepo->find($booking);
        $booking->setConfirmation(2);
        $entityManager->flush();

        // Get user
        $usersRepo = $this->getDoctrine()->getRepository(User::class);
        $patient = $usersRepo->findOneBy([ 'id'=> $booking->getUserId() ]);
        

        $mailerService->send(
            "Votre Réservation est annulé",
            "ounsa@piimt.us",
            $patient->getEmail(),
            "email/booking_cancelled.html.twig",
            [ "time"=>$booking->getTime() , 'date'=> $booking->getDate()]
        );


        if ($redirection == 1){

            return $this->redirectToRoute('adminBookings');
        }elseif( $redirection == 2 ){
            return $this->redirectToRoute('todayBookings');
        }


    }


    /**
     * @Route("/admin/certificatMedicale" , name="certificat")
     */
    public function certificatMedicale(  )
    {
        
        return $this->render('pdf/mypdf.html.twig' ,[
            'headline'=>"headline"
        ]);

            // // Retrieve the HTML generated in our twig file
            // $html = $this->renderView('pdf/mypdf.html.twig', [
            //     'headline' => 'headline'
            // ]);
            // //Generate pdf with the retrieved HTML
            // return new Response( $snappy->getOutputFromHtml($html), 200, array(
            //     'Content-Type'          => 'application/pdf',
            //     'Content-Disposition'   => 'inline; filename="export.pdf"'
            // )
            // );
 

        // $options = new Options();
        // $options->set('defaultFont', 'Roboto');


       
        // $dompdf = new Dompdf($options);
        
        // $data = array(
        //     'headline' => 'my headline'
        // );
        // $html = $this->renderView('pdf/mypdf.html.twig', [
        //     'headline' => "Test pdf generator"
        // ]);
        
        
        // $dompdf->loadHtml($html);
        // $dompdf->setPaper('A4', 'portrait');
        //  $dompdf->render();
        //  $dompdf->stream("", [
        //     "Attachment" => false
        // ]);
    


    }

}
