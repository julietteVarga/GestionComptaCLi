<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Facture;
use App\Entity\LigneFacture;
class FactureTest extends TestCase
{
    public function testMontant()
    {
        $facture = new Facture();
        $facture->setNumeroFacture("2021-02-008");
        $ligneFacture = new LigneFacture();
        $ligneFacture->setQuantite(1);
        $ligneFacture->setMontant(100);
        $ligneFacture->setFacture($facture);
        $facture->addLigneFacture($ligneFacture);

        $expected = 100;
        $this->assertEquals($expected, $facture->getMontantTotal(),"Le montant total doit être égale à 100");

    }
    public function testMontant2()
    {
        $facture = new Facture();
        $facture->setNumeroFacture("2021-02-008");
        $ligneFacture1 = new LigneFacture();
        $ligneFacture1->setQuantite(1);
        $ligneFacture1->setMontant(100);

        $ligneFacture1->setFacture($facture);
        $facture->addLigneFacture($ligneFacture1);

        $ligneFacture2 = new LigneFacture();
        $ligneFacture2->setQuantite(3);
        $ligneFacture2->setMontant(300);

        $ligneFacture2->setFacture($facture);
        $facture->addLigneFacture($ligneFacture2);

        $ligneFacture3 = new LigneFacture();
        $ligneFacture3->setQuantite(2);
        $ligneFacture3->setMontant(200);

        $ligneFacture3->setFacture($facture);
        $facture->addLigneFacture($ligneFacture3);

        $expected = 1400;
        $this->assertEquals($expected, $facture->getMontantTotal(),"Le montant total doit être égale à 1400");
    }
}
