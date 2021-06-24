<?php

namespace App\Service;

use App\Entity\LigneFacture;
use App\Repository\FactureRepository;

class UtilAnneeService
{
    private FactureRepository $factureRepository;

    public function __construct(FactureRepository $factureRepository)
    {
        $this->factureRepository = $factureRepository;
    }

    /**
     * fonction pour retrouver dynamiquement le montant total des factures par mois et années.
     * @param string $annee format '%2020%'.
     * @param string $mois format '%1%' pour Janvier.
     * @return array -> le montant total suivant le mois et l'année demandé.
     */
    public function getMontantTotal(string $annee, string $mois): array
    {
        //On trouve les lignes de factures de l'année voulue et le mois voulu
        $lignes = $this->factureRepository->findAllLignesByDates($annee, $mois);
        $montantFacture = [];
        $factureTab = [];
        $montantTotal = [];

        // pour chaque ligne retrouvée, on set le montant, la facture et la quantité
        //Puis on les ajoute dans des array pour mieux s'y retrouver.
        foreach ($lignes as $ligne) {
            $testLignesFacture = new LigneFacture();

            $testLignesFacture->setMontant($ligne['montant']);
            $testLignesFacture->setFacture($this->factureRepository->find($ligne['id']));
            $testLignesFacture->setQuantite($ligne['quantite']);
            $facture = $testLignesFacture->getFacture();
            array_push($factureTab, $facture);
            array_push($montantFacture, $testLignesFacture);

        }
        //Pour chaque ligne de facture trouvée, on crée une facture pour trouver le montant total.
        foreach ($montantFacture as $ligneFacture) {
            $facture = $ligneFacture->getFacture();
            $montant = $facture->getMontantTotal();
            array_push($montantTotal, $montant);
        }
        return $montantTotal;
    }

    /**
     * Fonction pour retrouver le montant total des factures
     * @param string $mois -> sous forme de string '1' pour janvier et ainsi de suite
     * @param string $annee -> sous forme de string '2020' pour 2020
     * @return mixed
     */
    public function getMonTotalParMois(string $mois, string $annee): mixed
    {
        $tab = $this->getMontantTotal( $annee, $mois);
        $montantTotalParMois=0;
        foreach ($tab as $value){
            $montantTotalParMois+=$value;
        }
        return $montantTotalParMois;
    }
}