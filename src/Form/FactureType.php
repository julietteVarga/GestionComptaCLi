<?php

namespace App\Form;

use App\Entity\Consultant;
use App\Entity\Facture;
use App\Entity\LigneFacture;
use App\Entity\Service;
use App\Entity\TypeDePaiement;
use App\Form\DataTransformer\DataTransformer;
use App\Repository\FactureRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\AbstractList;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FactureType extends AbstractType
{
    private EntityManagerInterface $em;
    private $transformer;

    public function __construct(DataTransformer $transformer,EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->transformer = $transformer;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $array = [];

        $factureRepository = $this->em->getRepository(Facture::class);
        $anneesFactures = $factureRepository->findYearsAvailable();
        foreach ($anneesFactures as $year){
            array_push($array,$year['years']);
        }

        $tabSwitched=array_flip($array);

        $builder
            /*->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $consultant = $event->getData();
                $form = $event->getForm();

                // checks if the Product object is "new"
                // If no data is passed to the form, the data is "null".
                // This should be considered a new "Product"
                if (!$consultant || null === $consultant->getId()) {
                    $form->add('consultant', TextType::class);
                }
            })*/
            ->add('consultant', TextType::class, [
                // validation message if the data transformer fails
                'invalid_message' => 'Le nom de ce consultant n\'existe pas',
            ])
            ->add('numeroFacture',TextType::class,['label'=> 'Numéro de facture: ','required' => false])
           // ->get('adresse', EntityType::class, ['classe'=>Consultant::class, ''])
            ->add('date',DateType::class, ['widget' => 'single_text','required' => true, 'label'=> ' Date: '])
            ->add('typeDePaiement',EntityType::class, ['class'=> TypeDePaiement::class, 'choice_label' => 'libelle' , 'label'=>'Type de paiement: ' ,'required' => false, 'placeholder'=> 'Sélectionnez votre choix de paiement'])
            ->add('numeroChequeOuPaypal',TextType::class,['label'=>' Numero de Chèque ou Paypal', 'required'=> false ])
            /*->add('service' , EntityType::class, ['class'=> Service::class, 'choice_label' => 'libelle' , 'label'=>'Service: ' ])*/
            /*->add('ligneFactures',EntityType::class,['class'=> LigneFacture::class ,'choice_label' => 'ligneFacture','label'=> 'lignes de facture'])*/
            /*->add('ligneFactures', LigneFactureType::class,['label'=>'Lignes de facture'])*/
            ->add('ligneFactures', CollectionType::class, ['entry_type' => LigneFactureType::class, 'by_reference' => false, 'allow_add' => true,'required'=> true, 'label' => false])
        ;


            //->add('service' , EntityType::class, ['class'=> Service::class, 'choice_label' => 'libelle' , 'label'=>'Service: ' ,'required' => false])

            /*->add('annees',ChoiceType::class,[
                'choices' => $tabSwitched
            ])*/
            ;


//                'choice_label'=> function(FactureRepository $em){
//                return $em->findYearsAvailable()['years'];
//                }
//            ])
        $builder->get('consultant')

            ->addModelTransformer($this->transformer);
    }





    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Facture::class,
        ]);
    }

}


