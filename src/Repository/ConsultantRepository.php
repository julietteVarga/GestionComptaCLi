<?php

namespace App\Repository;

use App\Entity\Consultant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Consultant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Consultant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Consultant[]    findAll()
 * @method Consultant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConsultantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Consultant::class);
    }

    /**
     * Fonction pour retrouver le nom et le prenom d'une personne pour l'autocomplete
     * @param string $letter
     * @return int|mixed[]|string
     */
    public function findNomPrenombyLetter(string $letter): array|int|string
    {
        return $this->createQueryBuilder('consultant')
            ->from('App\Entity\Consultant', 'c')
            ->select('c.nom', 'c.prenom')
            ->where('c.nom LIKE :letter')
            ->setParameter('letter', '%' . $letter . '%')
            ->orderBy('c.nom', 'desc')
            ->distinct('c.nom')
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * Fonction pour retrouver le consultant selon son nom et prenom
     * @param string $nom
     * @param string $prenom
     * @return int|mixed|string
     */
    public function findByNomAndPrenom(string $nom, string $prenom)
    {
        $query = $this->getEntityManager()->createQuery("select c from 
        App\Entity\Consultant c Where c.nom = :nom and c.prenom = :prenom ");
        $query->setParameter('nom', $nom);
        $query->setParameter('prenom', $prenom);


        return $query->getResult();
    }

    /**
     * Fonction pour retrouver le consultant selon son id
     * @param int $id
     * @return int|mixed|string
     */
    public function findById(int $id){

        $query = $this->getEntityManager()->createQuery("select c from 
        App\Entity\Consultant c Where c.id = :id");
        $query->setParameter('id', $id);


        return $query->getResult();
    }


//    public function findByNomAndPrenom(string $nom,string $prenom): array
//    {
//        return $this ->createQueryBuilder('consultant')
//            ->from('App\Entity\Consultant','c')
//            ->select('c')
//            ->where('c.nom = :nom')
//            ->andWhere('c.prenom = :prenom')
//            ->setParameter('nom',$nom)
//            ->setParameter('prenom',$prenom)
//            ->getQuery()
//            ->getResult();
//    }

    // /**
    //  * @return Consultant[] Returns an array of Consultant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Consultant
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
