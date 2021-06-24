<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\CommentaireConsultant;
use App\Entity\Consultant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\NotBlank;

class ConsultantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sex', ChoiceType::class, array('choices' => [
                'Masculin' => 'Masculin',
                'Féminin' => 'feminin'], 'label' => 'Sexe'))
            ->add('nom')
            ->add('prenom')
            ->add('adresse', AdresseType::class, ['label' => 'Adresse: '])
            ->add('email', EmailType::class, ['label' => 'Email: '])
            ->add('tel', TelType::class, ['label' => 'Téléphone: '])
            ->add('villeNaissance')
            ->add('dateNaissance', DateType::class, ['widget' => 'single_text'])
            ->add('paysNaissance', CountryType::class, array('label' => 'Pays de naissance:',
                'preferred_choices' => array('FR'),
            ))
            ->add('heureNaissance', TextType::class, ['label' => 'Heure de Naissance: (hh:mm) '])
            ->add('username', TextType::class, ['label' => 'Identifiant: '])
            // ->add('roles')
            ->add('password', PasswordType::class, ['label' => 'Mot de passe: ', 'required' => false],)
            // ->add('dateCreation', DateType::class)
            ->add('photos', FileType::class, ['mapped' => false, 'required' => false, 'label' => 'Veuillez choisir une photo: ']);
            //->add('commentaires',CommentaireConsultantType::class, ['label'=>'Commentaires','data_class'=>null]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Consultant::class,
            'validation_groups' => ['registration'],
        ]);
    }
}
