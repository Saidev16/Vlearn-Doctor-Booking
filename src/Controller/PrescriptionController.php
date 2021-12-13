<?php

namespace App\Controller;

use App\Entity\Booking;
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
    public function adminBookings( EntityManagerInterface $entityManager): Response
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
       dd( $request->request->getData );
    }

}