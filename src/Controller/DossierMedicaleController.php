<?php

namespace App\Controller;

use App\Entity\DossierMedicale;
use App\Form\DossierMedicaleFormType;
use App\Form\MyDocsType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;


class DossierMedicaleController extends AbstractController
{
    

    /**
     * @Route("admin/mesPatients", name="mes_patients")
     */
    public function patients(UserRepository $userRepository): Response
    {
        $users = $userRepository->findByRole("ROLE_PATIENT" , ['created_at'=>'DESC']);
        if( !$users ){
            return $this->redirectToRoute('HomePage');
        }
        return $this->render('dossier_medicale/patients.html.twig', [
            'users' => array_reverse($users)
        ]);
    }



    /**
     * @Route("admin/dossier/medicale/{patient}", name="dossier_medicale")
     */
    public function index($patient ,Request $request , EntityManagerInterface $em): Response
    {
        $repository = $this->getDoctrine()->getRepository(DossierMedicale::class);
        $documents = $repository->findBy( ['user_id'=> $patient ] , ['created_at'=>'DESC'] );
        
        $document = new DossierMedicale();

        $form = $this->createForm( DossierMedicaleFormType::class, $document );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $brochureFile */
            $brochureFile = $form->get('document')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                // $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $document->setDocument($newFilename);
                $document->setUserId($patient);
                $document->setType( 'Document du Patient' );
                if( $form->get('commentaire')->getData()  ){

                    $document->setCommentaire( $form->get('commentaire')->getData() );
                }

            }

            // ... persist the $product variable or any other work
            $em->persist($document);
            $em->flush();

            return $this->redirectToRoute('dossier_medicale',['patient'=>$patient]);
        }



        return $this->render('dossier_medicale/index.html.twig', [
            'form' => $form->createView(),
            'documents'=>$documents
        ]);
    }


    /**
     * @Route("patient/dossier/medicale", name="dossier_medicale_patient")
     */
    public function dossierPatient( Request $request , EntityManagerInterface $em): Response
    {
        $repository = $this->getDoctrine()->getRepository(DossierMedicale::class);
        $documents = $repository->findBy( ['user_id'=> $this->getUser()->getId() ] , ['created_at'=>'DESC'] );
        
        $document = new DossierMedicale();

        $form = $this->createForm( DossierMedicaleFormType::class, $document );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $brochureFile */
            $brochureFile = $form->get('document')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                // $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $document->setDocument($newFilename);
                $document->setUserId($this->getUser()->getId());
                
            }

            // ... persist the $product variable or any other work
            $em->persist($document);
            $em->flush();

            return $this->redirectToRoute('dossier_medicale_patient');
        }



        return $this->render('dossier_medicale/dossierpatient.html.twig', [
            'form' => $form->createView(),
            'documents'=>$documents
        ]);
    }




       /**
     * @Route("admin/mesdoc", name="docAdmin")
     */
    public function docAdmin(Request $request , EntityManagerInterface $em): Response
    {
        $repository = $this->getDoctrine()->getRepository(DossierMedicale::class);
        $documents = $repository->findBy( ['user_id'=> $this->getUser()->getId() ] , ['created_at'=>'DESC'] );
        
        $document = new DossierMedicale();

        $form = $this->createForm( MyDocsType::class, $document );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $brochureFile */
            $brochureFile = $form->get('document')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                // $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $document->setDocument($newFilename);
                
                $document->setUserId($this->getUser()->getId());
                if( $form->get('commentaire')->getData()  ){
                         $document->setCommentaire( $form->get('commentaire')->getData() );
                }
                if( $form->get('Type')->getData() ){
                    $document->setType( $form->get('Type')->getData() );
                }
            }

            // ... persist the $product variable or any other work
            $em->persist($document);
            $em->flush();

            return $this->redirectToRoute('docAdmin');
        }



        return $this->render('dossier_medicale/index.html.twig', [
            'form' => $form->createView(),
            'documents'=>$documents
        ]);
    }




    /**
     * @Route("admin/mesdoc/{type}", defaults={"type"=null} , name="docTypes")
     */
    public function docTypes($type): Response
    {
        $repository = $this->getDoctrine()->getRepository(DossierMedicale::class);
        $documents = $repository->findBy( ['user_id'=> $this->getUser()->getId() , 'type'=>$type ] , ['created_at'=>'DESC'] );
        


        return $this->render('dossier_medicale/mesDocs.html.twig', [
            'documents'=>$documents
        ]);
    }







}
