<?php

namespace App\Controller;

use App\Entity\Appointments;
use App\Entity\Times;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;




class AppointmentsController extends AbstractController
{

    private $session;
    public function __construct( SessionInterface $session   )
    {
        $this->session = $session;

    }

    /**
     * @Route("admin/appointments/create", name="create_appointments")
     */
    public function create( Request $request , EntityManagerInterface $entityManager): Response
    {
        // set the appoiontment date as todays date when you check the page for the first time
        if($this->session->get('appointment_date') == null) {

            $time = new \DateTime();
            $this->session->set('appointment_date', $time->format('Y-m-d') );
    
        }
        
        if ($request->getMethod() == 'POST') {

            $repository = $this->getDoctrine()->getRepository(Appointments::class);
            $searchAppointment = $repository->findOneBy([
                'user_id' => $this->getUser()->getId(),
                'date' => $this->session->get('appointment_date'),
            ]);
            if( $searchAppointment ){
                $this->addFlash(
                    'appointmentAlert',
                    "Plage d'heures déja créer pour ce jour"
                );

    
            return $this->render('appointments/create.html.twig', [
                'setted_date' => $this->session->get('appointment_date'),
            ]);

            }
        
            $selectedDate = $this->session->get('appointment_date');
            
            for ($i = 0; $i <= 30; $i++) {
                
                $appointment = new Appointments;
                $appointment->setUserId( $this->getUser()->getId() );
                $appointment->setDate( $selectedDate ) ;
                $entityManager->persist($appointment);
                $entityManager->flush();
                
                $selectedDate = date('Y-m-d', strtotime($selectedDate . ' +1 day'));
                //set times 
                $times = $request->request->get('time');
    
                foreach( $times as $timedata ){
                    $time = new Times;
                    $time->setAppointmentId( $appointment->getId() );
                    $time->setTime( $timedata );
                    $time->setStatus( 0 );
                    $time->setBooked( 0 );
                    $entityManager->persist($time);
                    
    
    
                }
    
    
            }
              

            $entityManager->flush();

            
                $this->addFlash(
                    'appointmentSuccess',
                    "Créer avec success"
                );

    
            return $this->render('appointments/create.html.twig', [
                'setted_date' => $this->session->get('appointment_date'),
            ]);
    
            
        }
        
        return $this->render('appointments/create.html.twig', [
            'setted_date' => $this->session->get('appointment_date'),
        ]);
    }


     /**
     * @Route("admin/appointments/changeDate", name="change_date")
     */
    public function checkDate( Request $request )
    {
        if ($request->getMethod() == 'POST') {

            $this->session->set('appointment_date' ,  $request->request->get('search_date') );
            return $this->redirectToRoute('create_appointments');


        }
        return $this->render('appointments/create.html.twig', [
            'controller_name' => 'AppointmentsController',
        ]); 


    }


    
    /**
     * @Route("admin/appointments/update", name="update_appointments")
     */
    public function update( Request $request , EntityManagerInterface $entityManager): Response
    {
        $appointmentId = $request->request->get('appointmentId');
        $repository = $this->getDoctrine()->getRepository(Times::class);
        $Appointment = $repository->findBy(
            ['appointment_id' => $appointmentId]
        );
        foreach ( $Appointment as $oneAppointment  ){
            $entityManager->remove($oneAppointment);

        }
        $entityManager->flush();

        $times = $request->request->get('time');
            //set times 
            foreach( $times as $timedata ){
                $time = new Times;
                $time->setAppointmentId( (int)$appointmentId );
                $time->setTime( $timedata );
                $time->setStatus( 0 );
                $time->setBooked( 0 );
                $entityManager->persist($time);
                


            }


            $entityManager->flush();

            
                $this->addFlash(
                    'appointmentUpdated',
                    "Plage d'heures modifier avec success"
                );

    
            return $this->render('appointments/check.html.twig', [
                'setted_date' => $this->session->get('appointment_date'),
            ]);



        
        return $this->redirectToRoute('changeCheckDate');
        

    }

     /**
     * @Route("doctor/appointments/changeCheckDate", name="changeCheckDate")
     */
    public function changeCheckDate( Request $request )
    {
        if ($request->getMethod() == 'POST') {

            $this->session->set('appointment_check_date' ,  $request->request->get('appointment_check_date') );
            $repository = $this->getDoctrine()->getRepository(Appointments::class);
            $checkAppointment = $repository->findOneBy([
                'date' => $request->request->get('appointment_check_date'),
                'user_id' => $this->getUser()->getId(),
            ]);

            if( !$checkAppointment ){
                $this->addFlash(
                    'dateNotFound',
                    "Les Heures ne sont pas disponibles par ce jour"
                );

    
                return $this->redirectToRoute('changeCheckDate');
                
            }

            $appointmentId = $checkAppointment->getId();
            $repository = $this->getDoctrine()->getRepository(Times::class);
            $times = $repository->findBy([
                'appointment_id' => $appointmentId
            ]);
            foreach ($times as $time){
                 $checkedDates[] = $time->getTime();
                
            }
            
            return $this->render('appointments/check.html.twig', [
                'setted_date' => $this->session->get('appointment_check_date'),
                'checkedDates'=>$checkedDates,
                'appointment_id'=>$appointmentId
            ]); 
    


        }
        return $this->render('appointments/check.html.twig', [
            'setted_date' => $this->session->get('appointment_check_date')
        ]); 


    }
}






