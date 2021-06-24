<?php

namespace App\Repository;

use App\Entity\Facture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraints\DateTime;


/**
 * @method Facture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Facture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Facture[]    findAll()
 * @method Facture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FactureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Facture::class);
    }

    /**
     * Sert a retrouver une facture selon l'année demandée.
     * @param string $year
     * @return int|mixed|string
     */
    public function findAllByYear(string $year){
        $query = $this->getEntityManager()->createQuery('select f from App\Entity\Facture f where f.date LIKE :year');
        $query->setParameter('year', $year);
        return $query->getResult();
    }

    /**
     * Trouver toutes les années disponibles dans la base de données
     * @return int|mixed|string
     */
    public function findYearsAvailable(){
        $query = $this->getEntityManager()->createQuery("select distinct year(f.date) as years from 
        App\Entity\Facture f group by years ");

        return $query->getResult();
    }

    /**
     * Retourner montant, quantité d'une ligne de facture qui datent de l'année et le mois demandé.
     * @param string $year
     * @param string $month
     * @return int|mixed|string
     */
    public function findAllLignesByDates(string $year, string $month){
        $query = $this->getEntityManager()->createQuery('select l.montant, l.quantite,f.date, f.id from App\Entity\LigneFacture l 
        join App\Entity\Facture f with l.facture = f.id where year(f.date) = :year and month(f.date) = :month');
        $query->setParameter('year', $year);
        $query->setParameter('month', $month);
        return $query->getResult();
    }

   // public function findAllMontantByDates(\DateTime $firstDateTime, \DateTime $lastDateTime){
//        $query = $this->getEntityManager()->createQuery('select l.montant  from App\Entity\LigneFacture l join
//        App\Entity\Facture  f with l.facture = f.id where f.date between :firstDate and :lastDate');
//
//        $query->setParameter('firstDate', $firstDateTime);
//        $query->setParameter('lastDate', $lastDateTime);
//        return $query->getResult();
//    }

//    /**
//     * fonction pour retrouver les factures par rapport aux dates données
//     * @param \DateTime $firstDateTime
//     * @param \DateTime $lastDateTime
//     * @return int|mixed|string
//     */
//    public function findByDateInterval(\DateTime $firstDateTime, \DateTime $lastDateTime){
//        $query = $this->getEntityManager()->createQueryBuilder('f')
//            ->from('facture','f')
//            ->where('f.date BETWEEN :firstDate AND :lastDate')
//            ->setParameter('firstDate', $firstDateTime)
//            ->setParameter('lastDate', $lastDateTime)
//            ->getQuery()
//        ;
//
//
//        return $query->getResult();
//    }
//    public function findByDateIntervalAndReturnSum(\DateTime $firstDateTime, \DateTime $lastDateTime)
//    {
//        $query = $this->getEntityManager()->createQuery('select SUM(f.montant) from App\Entity\LigneFacture f where f.date BETWEEN :firstDate AND :lastDate');
//        $query->setParameter('firstDate', $firstDateTime);
//        $query->setParameter('lastDate', $lastDateTime);
//        return $query->getResult();
//
//    }



    // /**
    //  * @return Facture[] Returns an array of Facture objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Facture
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
