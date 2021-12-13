<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrescriptionController extends AbstractController
{



    //     /**
    //  * @Route("/admin/bookings", name="adminBookings")
    //  */
    // public function adminBookings(Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     $bookingRepo = $this->getDoctrine()->getRepository(Booking::class);
    //     $bookings = $bookingRepo->findBy([ 'doctor_id'=>$this->getUser()->getId() , 'status'=> 1] , ['created_at'=>'DESC']);

        
    //     if( $bookings){
    //         $usersRepo = $this->getDoctrine()->getRepository(User::class);
    //         $patient = $usersRepo->findOneBy([ 'id'=>$bookings[0]->getUserId() ]);
    //     }else{
    //         $this->addFlash(
    //             'NoBookingsfound',
    //             'Aucune Réservations Trouver'
    //         );
    
    //         return $this->redirectToRoute('user_index');

    //     }
        



    //     return $this->render('prescription/index.html.twig', [
    //         'controller_name' => 'PrescriptionController',
    //     ]);

            
    // }

}