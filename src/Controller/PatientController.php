<?php

namespace App\Controller;

use App\Entity\Appointments;
use App\Entity\Booking;
use App\Entity\Times;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

class PatientController extends AbstractController
{
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
    public function storeBooking( Request $request , EntityManagerInterface $entityManager ): Response
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

        $queryTime = $this->getDoctrine()->getRepository( Times::class )->findBy(['appointment_id'=>$appointmentId ,  'time'=>$time]);
        $queryTime[0]->setBooked(1);

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
