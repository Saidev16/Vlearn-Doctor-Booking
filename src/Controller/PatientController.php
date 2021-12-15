<?php

namespace App\Controller;

use App\Entity\Appointments;
use App\Entity\Booking;
use App\Entity\Times;
use App\Entity\User;
use App\services\MailerService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class PatientController extends AbstractController
{


    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }


    /**
     * @Route("/bookingSearch", name="search_booking")
     */
    public function search( Request $request ): Response
    {
        if ($request->isMethod('post')) {
            return $this->redirectToRoute('booking', ['date'=>$request->request->get('search_date')]) ;
        }
        
        return $this->render('patient/index.html.twig', [
            'controller_name' => 'PatientController',
        ]);
    }


    /**
     * @Route("/booking/{date}", name="booking")
     */
    public function booking( Request $request , $date): Response
    {

        
        $appointmentRepo = $this->getDoctrine()->getRepository(Appointments::class);
        $appointment = $appointmentRepo->findOneBy(['date'=>$date]);

        if( !$appointment ){
            $this->addFlash(
                'noAppointment',
                'Aucune donnés disponile pour ce jour'
            );
    
            return $this->redirectToRoute('HomePage');
        }


        $timesRepo = $this->getDoctrine()->getRepository(Times::class);
        $times = $timesRepo->findBy(['appointment_id'=>$appointment->getId()  , 'booked'=> 0 ]);
        $usersRepo = $this->getDoctrine()->getRepository(User::class);
        $doctor = $usersRepo->findOneBy(['id'=>$appointment->getUserId() ]);

        
        return $this->render('patient/book.html.twig', [
            'appointment' => $appointment,
            'times' => $times,
            'doctor' => $doctor,
            'date'=> $date
        ]);
    }

    /**
     * @Route("patient/storeBooking", name="store_booking")
     */
    public function storeBooking( Request $request , EntityManagerInterface $entityManager ,MailerService $mailerService ): Response
    {
        $time = $request->request->get('time');
        $date = $request->request->get('date');
        $appointmentId = $request->request->get('appointmentId');
        $doctorId = $request->request->get('doctorId');

        $timeEntity = new Times();
        $dateEntity = new Date();
        $appointmentEntity = new Appointments();
        $bookingEntity = new Booking();

        $bookingEntity->setUserId($this->getUser()->getId());
        $bookingEntity->setDoctorId($doctorId);
        $bookingEntity->setTime($time);
        $bookingEntity->setStatus(0);
        $bookingEntity->setBooked(1);
        $bookingEntity->setConfirmation(0);
        $bookingEntity->setDate($date);

        if( $request->request->get('motif') ){
            $bookingEntity->setMotif( $request->request->get('motif') );
        }

        $queryTime = $this->getDoctrine()->getRepository( Times::class )->findBy(['appointment_id'=>$appointmentId ,  'time'=>$time]);
        $queryTime[0]->setBooked(1);


        $doctor = $this->getDoctrine()->getRepository( User::class )->findOneBy(['id'=>$doctorId ]);

        $mailerService->send(
            "Vous avez une nouvelle Réservation",
            "ounsa@piimt.us",
            $doctor->getEmail(),

            "email/new_booking.html.twig",
            [ "time"=>$time , 'date'=> $date]
        );

        // send SMS 

        $this->client->request(
            'GET',
            "https://platform.clickatell.com/messages/http/send?apiKey=JQHZLSAJSWKfkYChmuZNjg==&to=+212762379479&content=Vous avez une nouvelle reservation pour le ". $date . " a ". $time
        );


        $entityManager->persist($bookingEntity);
        $entityManager->flush();


        return $this->redirectToRoute('myBookings');


    }

    /**
     * @Route("patient/myBooking", name="myBookings")
     */
    public function myBookings( Request $request )
    {

        $bookingRepo = $this->getDoctrine()->getRepository(Booking::class);
        $bookings = $bookingRepo->findBy([ 'user_id'=>$this->getUser()->getId() ] , ['created_at'=>'DESC']);
        
        if( $bookings){
            $usersRepo = $this->getDoctrine()->getRepository(User::class);
            $doctor = $usersRepo->findOneBy([ 'id'=>$bookings[0]->getDoctorId() ]);
        }else{
            $doctor = null;
        }
        



        return $this->render('patient/my_bookings.html.twig' ,[
            'doctor'=>$doctor,
            'bookings'=>$bookings
        ]);


    }
}
