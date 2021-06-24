<?php


namespace App\Service;

use \DateTime;
use App\Repository\FactureRepository;
use Doctrine\ORM\EntityManagerInterface;

class FactureService
{
    private $factureRepository;
    private $entityManager;
    public function __construct(FactureRepository $factureRepository,EntityManagerInterface $entityManager)
    {
        $this->factureRepository=$factureRepository;
        $this->entityManager=$entityManager;
    }

    /**
     * fonction qui permet de retourner le prochain numéro de facture disponible sous la forme (YYYY-MM-0001)
     * @return string
     */
    public function getNumeroDispo()
    {
        $date       = new DateTime();
        $debutNum   = $date->format('Y-m');
        //dump($debutNum);
        $qb = $this->factureRepository->createQueryBuilder('f')
            ->add('select', '(f.numeroFacture) as num');
        $qb->where($qb->expr()->like('f.numeroFacture', ':numero'))
            ->setParameter('numero', '%'.$debutNum.'%')
            ->orderBy('f.numeroFacture','DESC')
            ->setMaxResults(1);

        $num = $qb->getQuery()->getResult();

        if(count($num)>0)
        {
            //dd($num[0]['num']);
            $result=explode($debutNum."-",$num[0]['num']);
            //dd($result);
            $newNumero=$result[1]+1;
            if($newNumero<10){
                $newNumero="000".$newNumero;
            }else if($newNumero<100){
                $newNumero="00".$newNumero;
            }else if($newNumero<1000) {
                $newNumero = "0" . $newNumero;
            }
            $numAffich=$debutNum."-".$newNumero;
            return $numAffich;
        }
        else
        {
            return $debutNum."-0001";
        }

    }
}