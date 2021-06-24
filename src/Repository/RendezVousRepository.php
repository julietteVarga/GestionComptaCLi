<?php

namespace App\Repository;
use \DateTime;
use App\Entity\RendezVous;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RendezVous|null find($id, $lockMode = null, $lockVersion = null)
 * @method RendezVous|null findOneBy(array $criteria, array $orderBy = null)
 * @method RendezVous[]    findAll()
 * @method RendezVous[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RendezVousRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RendezVous::class);
    }

    /**
     * Cette fonction a pour but de retrouver les consultants en plus des rendez-vous
     * Si on ne fait pas cette jointure, le consutlant lié au rendez-vous ne sera pas retourné
     * @return int|mixed|string
     */
    public function findAllConsultantWithRDV(){

        $query = $this->getEntityManager()->createQuery("select distinct u , r  from 
        App\Entity\RendezVous r join r.consultant as u with r.consultant = u.id ");

        return $query->getResult();
    }


    // /**
    //  * @return RendezVous[] Returns an array of RendezVous objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RendezVous
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    /**
     * Retourne le prochain rendez vous.
     * @return RendezVous|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function prochainRDV(): ?RendezVous
    {
        $dateDuJour= date("dmY");
        return $this->createQueryBuilder('r')
            ->andWhere('r.dateDebut >= :dateDuJour')
            ->setParameter('dateDuJour', $dateDuJour)
            ->orderBy('r.dateDebut','DESC')
            ->getQuery()
            ->getResult()[0]
            ;
    }
}
