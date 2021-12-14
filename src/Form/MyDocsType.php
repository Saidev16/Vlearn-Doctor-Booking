<?php

namespace App\Form;

use App\Entity\DossierMedicale;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class MyDocsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('document', FileType::class, [
            'attr'=>['class'=>'form-control'],
            'label'=> "Document",
            'mapped'=> false,
            "required"=> false,
            'constraints'=>[
                new File([
                    'maxSize'=>'2048k',
                    'mimeTypes'=>[
                        'application/pdf',
                        'application/x-pdf',
                        "image/png",
                        "image/jpeg",
                        "image/jpg",
                        'application/msword',
                        'application/vnd.ms-excel',
                        "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                        'application/vnd.ms-excel',
                        'application/octet-stream',
                        'text/csv',
                         'text/plain',
                         'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'

                    ],
                    'mimeTypesMessage'=>'Format non autorisés'
                ])
            ]
        ])
        ->add('commentaire', TextType::class )
        ->add('Type' ,ChoiceType::class ,[
            'choices'=> [
                'Dossier du personnel'=>'Dossierdupersonnel',
                'Factures'=>'Factures',
                'Chéques'=>"Cheques",
                'Autres'=>'Autres'
            ]
        ] )
        ->add('submit', SubmitType::class);
    

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class'=> DossierMedicale::class,
        ]);
    }
}
