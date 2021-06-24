<?php

namespace App\Form;

use App\Entity\LigneFacture;
use App\Entity\Service;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LigneFactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantite',TextType::class,['label'=> ' Quantité: '])
            ->add('montant',TextType::class, ['label'=> ' Montant:  '])
            ->add('service', EntityType::class, ['class'=> Service::class, 'choice_label' => 'libelle' , 'label'=>'Service: ' ])
           /* ->add('ajouter', SubmitType::class, ['validation_groups' => ['Registration']])
            ->add('supprimer', SubmitType::class, ['validation_groups' => ['Registration']])
            ->getForm()*/
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LigneFacture::class,
        ]);
    }
}
