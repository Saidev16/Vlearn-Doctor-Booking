<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Prescription;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrescriptionController extends AbstractController
{

    /**
     * @Route("/admin/bookings/visited", name="BookingsVisited")
     */
    public function adminBookings( ): Response
    {

        
        $bookingRepo = $this->getDoctrine()->getRepository(Booking::class);
        $bookings = $bookingRepo->findBy([ 'doctor_id'=>$this->getUser()->getId() , 'status'=> 1 ] , ['created_at'=>'DESC']);
        
        if( $bookings){
            foreach( $bookings as $booking ){
                $usersRepo = $this->getDoctrine()->getRepository(User::class);
                $patient = $usersRepo->findOneBy([ 'id'=>$booking->getUserId() ]);

                $patients[$booking->getId()] = [$booking->getId() => $patient ];
                
            }
        }else{
            $this->addFlash(
                'NoBookingsfound',
                'Aucune Réservations Trouver'
            );
    
            return $this->redirectToRoute('adminBookings');

        }




        return $this->render('prescription/index.html.twig' ,[
            'patients'=>$patients,
            'bookings'=>$bookings
        ]);

            
    }

        /**
     * @Route("/admin/savePrescription", name="savePrescription")
     */
    public function savePrescription( Request $request ,EntityManagerInterface $entityManager): Response
    {

        $prescription = new Prescription();
        $prescription->setMaladie($request->request->get('Maladie'));
        $prescription->setSymptoms($request->request->get('Symptomes'));
        $prescription->setMedicaments($request->request->get('Medicaments'));
        $prescription->setTraitement($request->request->get('Traitement'));
        $prescription->setUserId($request->request->get('user_id'));
        $prescription->setDate($request->request->get('date'));
        $prescription->setRetour($request->request->get('Retour'));
        $prescription->setBookingId($request->request->get('booking_id'));


        // set prescription as sent :
        $bookingRepo = $this->getDoctrine()->getRepository(Booking::class);
        $booking = $bookingRepo->findOneBy([ 'id'=>$request->request->get('booking_id')]);
        $booking->setPrescriptionSent(1);


       $entityManager->persist($booking);
       $entityManager->persist($prescription);
       $entityManager->flush();

       $this->addFlash(
        'PrescriptionSent',
        "La prescription est envoyé avec success"
    );
    

       return $this->redirectToRoute('BookingsVisited');

    }

        /**
     * @Route("/patient/clientPrescriptions", name="clientPrescriptions")
     */
    public function clientPrescriptions( EntityManagerInterface $entityManager): Response
    {
        $prescriptionRepo = $this->getDoctrine()->getRepository(Prescription::class);
        $prescriptions = $prescriptionRepo->findBy([ 'user_id'=>$this->getUser()->getId() ] , ['created_at'=>'DESC']);



        return $this->render('prescription/client_prescriptions.html.twig', ['prescriptions'=>$prescriptions] );


    }

}