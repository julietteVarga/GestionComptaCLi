<?php

namespace App\Repository;

use App\Entity\CommentaireConsultant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommentaireConsultant|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentaireConsultant|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommentaireConsultant[]    findAll()
 * @method CommentaireConsultant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentaireConsultantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommentaireConsultant::class);
    }

    // /**
    //  * @return CommentaireConsultant[] Returns an array of CommentaireConsultant objects
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
    public function findOneBySomeField($value): ?CommentaireConsultant
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
