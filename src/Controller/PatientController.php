<?php

namespace App\Controller;

use App\Entity\Appointments;
use App\Entity\Times;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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


        $timesRepo = $this->getDoctrine()->getRepository(Times::class);
        $times = $timesRepo->findBy(['appointment_id'=>$appointment->getId() , 'status'=>0]);
        
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
     * @Route("/storeBooking", name="store_booking")
     */
    public function storeBooking( Request $request ): Response
    {
        $time = $request->request->get('time');
        $date = $request->request->get('date');
        $appointmentId = $request->request->get('appointmentId');
        $doctorId = $request->request->get('doctorId');
        return dd( $time , $date , $appointmentId , $doctorId ) ;

    }
}
