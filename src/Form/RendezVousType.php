<?php

namespace App\Form;

use App\Entity\Consultant;


use App\Entity\RendezVous;

use App\Form\DataTransformer\DataTransformer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RendezVousType extends AbstractType
{
    private $transformer;

    public function __construct(DataTransformer $transformer)
    {
        $this->transformer = $transformer;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
            ->add('titre')
            ->add('dateDebut',DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date début: ',
                ])
            ->add('dateFin',DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date fin: ',
            ])
            ->add('commentaire' ,TextareaType::class ,['attr' => ['class' => 'tinymce']])
            //->add('createur',EntityType::class, ['class'=> User::class, 'choice_label' => 'nom' , 'label'=>'Nom du créateur: ' ])
//            ->add('consultant',EntityType::class, ['class'=> Consultant::class, 'choice_label' => 'nom' , 'label'=>'Nom du consultant: '])
            ->add('consultant', TextType::class, [
                // validation message if the data transformer fails
                'invalid_message' => 'Le nom de ce consultant n\'existe pas',
            ]);

        $builder->get('consultant')

            ->addModelTransformer($this->transformer);
    }



    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RendezVous::class,
        ]);
    }
}
