<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;




class AppointmentsController extends AbstractController
{

    private $session;
    public function __construct( SessionInterface $session )
    {
        $this->session = $session;
    }

    /**
     * @Route("doctor/appointments/create", name="create_appointments")
     */
    public function create( Request $request ): Response
    {
        if($this->session->get('appointment_date') == null) {

            $time = new \DateTime();
            $this->session->set('appointment_date', $time->format('Y-m-d') );
    
        }
        // set the appoiontment date as todays date when you check the page for the first time
        
        if ($request->getMethod() == 'POST') {
            dd(  $request );
            dd(  $request->request->get('appointmentId') );
            
            
        }
        
        return $this->render('appointments/create.html.twig', [
            'setted_date' => $this->session->get('appointment_date'),
        ]);
    }


     /**
     * @Route("doctor/appointments/changeDate", name="change_date")
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
}
