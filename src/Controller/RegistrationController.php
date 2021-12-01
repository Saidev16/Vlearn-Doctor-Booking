<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/registration", name="registration")
     */
    public function register( Request $request , UserPasswordEncoderInterface $passwordEncoder ): Response
    {
        // BUILD THE FORM FOR REGISTRATION
        $user = new User;
        $form = $this->createForm( UserType::class , $user );



    }
}
