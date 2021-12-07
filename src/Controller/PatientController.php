<?php

namespace App\Controller;

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
           return  dd( $request->request->get('search_date'));
        }
        
        return $this->render('patient/index.html.twig', [
            'controller_name' => 'PatientController',
        ]);
    }


    /**
     * @Route("/booking", name="booking")
     */
    public function booking( Request $request ): Response
    {
        return $this->render('patient/book.html.twig', [
            'controller_name' => 'PatientController',
        ]);
    }
}
