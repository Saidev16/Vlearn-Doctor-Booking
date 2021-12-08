<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\LoginFormAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\HttpFoundation\RedirectResponse;


class AdminController extends AbstractController
{
    /**
     * @Route("/admin/addDoctor", name="adminAddDoctor")
     */
    public function add(Request $request, UserPasswordEncoderInterface $userPasswordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $passwordEntred =  $form->get('plainPassword')->getData();

            // encode the plain password
            $user->setPassword(
            $userPasswordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setRoles(["ROLE_DOCTOR"]);

            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('user_index');


        }

        return $this->render('admin/addDoctor.html.twig', [
            'addDoctor' => $form->createView(),
        ]);

    }

        /**
     * @Route("/admin/bookings", name="adminBookings")
     */
    public function adminBookings(Request $request, EntityManagerInterface $entityManager): Response
    {
        $bookingRepo = $this->getDoctrine()->getRepository(Booking::class);
        $bookings = $bookingRepo->findBy([ 'doctor_id'=>$this->getUser()->getId() ] , ['created_at'=>'DESC']);
        
        if( $bookings){
            $usersRepo = $this->getDoctrine()->getRepository(User::class);
            $patient = $usersRepo->findOneBy([ 'id'=>$bookings[0]->getUserId() ]);
        }
        



        return $this->render('admin/bookings.html.twig' ,[
            'patient'=>$patient,
            'bookings'=>$bookings
        ]);

            
    }
}
