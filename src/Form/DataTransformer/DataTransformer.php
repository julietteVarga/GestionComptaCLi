<?php
namespace App\Form\DataTransformer;

use App\Entity\Consultant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class DataTransformer implements DataTransformerInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Transforms an object (consultant) to a string (nom - prenom).
     *
     * @param  Consultant|null $consultant
     */
    public function transform($consultant): string
    {
        if (null === $consultant) {
            return '';
        }

        return $consultant->getNom().'- '.$consultant->getPrenom() ;

    }

    /**
     * Transforms a string (nom et prenom) to an object (consultant).
     *
     * @param  string $consultantNom
     * @throws TransformationFailedException if object (consultant) is not found.
     */
    public function reverseTransform($consultantSent): object
    {
        //On envoie le nom et le prenom séparés par un - pour pouvoir retirer le nom et le prenom
        $consultantNomPrenomArray = explode('-',$consultantSent);
        //On enlève tous les espaces
        $consultantNom = str_replace(' ','',$consultantNomPrenomArray[0]);
        $consultantPrenom = str_replace(' ','',$consultantNomPrenomArray[1]);

//        dd($consultantPrenom,$consultantNom);

        $consultant = $this->entityManager
            ->getRepository(Consultant::class)
            // requête obligatoire pour un soucis d'unicité de la personne
            ->findByNomAndPrenom($consultantNom,$consultantPrenom)
//        ->find($consultantId)
        ;
//        dd($consultant);

        if (null === $consultant) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'A consultant with name "%s" does not exist!',
                $consultantNom
            ));
        }
//        dd($consultant[0]);

        //On retourne Le premier de la liste (normalement il y en a qu'un)
        return $consultant[0];
    }
}