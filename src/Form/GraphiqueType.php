<?php
namespace App\Form;

use App\Entity\Facture;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GraphiqueType extends AbstractType{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $array = [];

        $factureRepository = $this->em->getRepository(Facture::class);
        $anneesFactures = $factureRepository->findYearsAvailable();
        foreach ($anneesFactures as $year) {
            array_push($array, $year['years']);
        }
        array_push($array,'Voir la comparaison des années');
        $tabSwitched = array_flip($array);

        $builder
            ->add('annees', ChoiceType::class, [
                'mapped'=>false,
                'choices' => $tabSwitched,
                'required'=>false,
                'label'=>'Choisir une année: ',
                'attr' => ['class'=>'labelTest'],
            ])
            ->add('anneesTyped',TextType::class,[
                'label'=>'Renseigner une année: ',
                'mapped' => false,
                'required'=>false,
            ])

            ->add('save',SubmitType::class,[
                'label'=>'choisir'
            ])
            ->add('filtrer',SubmitType::class,[
                'label'=>'filtrer'
            ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Facture::class,

            //csrf_protection : on la désactive car dans un formulaire de recherche : pas de soucis de cross-scripting
            'csrf_protection' => false
        ]);
    }
}
