<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppointmentsController extends AbstractController
{
    /**
     * @Route("doctor/appointments", name="appointments")
     */
    public function index( Request $request ): Response
    {
        if ($request->getMethod() == 'POST') {
            dd(  $request->request->get('time') );
            dd(  $request->request->get('appointmentId') );
            
        }
        return $this->render('appointments/index.html.twig', [
            'controller_name' => 'AppointmentsController',
        ]);
    }


     /**
     * @Route("doctor/appointments/check", name="check_date")
     */
    public function checkDate( Request $request )
    {
        if ($request->getMethod() == 'POST') {
            dd(  $request->request->get('search_date') );

        }
        return $this->render('appointments/index.html.twig', [
            'controller_name' => 'AppointmentsController',
        ]); 


    }
}
