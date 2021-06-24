<?php

namespace App\Service;

use App\Entity\LigneFacture;
use App\Repository\FactureRepository;
use Exception;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class GraphiqueService{
    private FactureRepository $factureRepository;

    public function __construct(FactureRepository $factureRepository,ChartBuilderInterface $chartBuilder)
    {
        $this->factureRepository = $factureRepository;
    }
    /**
     * Fonction pour retourner l'année n- souhaitée
     * @param string -> combien d'année N- souhaité ('1 year' pour un an etc)
     * @return string -> l'année N- souhaitée
     */
    public function getYearN(string $howManyYears): string
    {
        //Année actuelle
        $currentYear = date('Y');
        //Convertis en DateTime
        $currentYear = date_create($currentYear);
        //On enlève une année à l'année actuelle
        $getYearN = date_sub($currentYear, date_interval_create_from_date_string($howManyYears));
        //On convertis en string
        $getYearN = $getYearN->format('Y');
        return $getYearN;
    }

    /**
     * Fonction pour actualiser l'année par rapport à l'année actuelle
     * @param String $dateString
     * @return \DateTime : La date demandée mais avec l'année actuelle (2021 si actuellement nous sommes en 2021)
     * @throws Exception
     */
    public function updateDate(string $dateString): \DateTime
    {
        $suppliedDate = new \DateTime($dateString);
        $currentYear = (int)(new \DateTime())->format('Y');
        return (new \DateTime())->setDate($currentYear, (int)$suppliedDate->format('m'), (int)$suppliedDate->format('d'));
    }

    /**
     * Fonction pour retourner un tableau d'intervalles de dates
     * 1=>JanvierMin, 2=>JanvierMax ... ainsi de suite
     * @return array -> tableau d'intervalles de dates.
     * @throws Exception
     *
     */
    public function getMonthIntervals(): array
    {
        $tabYear = [];
        //Intervales pour chaque mois
        $JANVIERMAX = $this->updateDate('2021-01-31');
        $JANVIERMIN = $this->updateDate('2021-01-01');
        $FEVRIERMAX = $this->updateDate('2021-02-29');
        $FEVRIERMIN = $this->updateDate('2021-02-01');
        $MARSMAX = $this->updateDate('2021-03-31');
        $MARSMIN = $this->updateDate('2021-03-01');
        array_push($tabYear, $JANVIERMIN, $JANVIERMAX, $FEVRIERMIN, $FEVRIERMAX, $MARSMIN, $MARSMAX);

        return $tabYear;
    }

    /**
     * fonction pour retrouver dynamiquement le montant total des factures par mois et années.
     * @param FactureRepository $factureRepository
     * @param string $annee format '2020'.
     * @param string $mois format '1' pour Janvier.
     * @return int -> le montant total suivant le mois et l'année demandé.
     */
    public function getMontantTotal(FactureRepository $factureRepository, string $annee, string $mois): int
    {

        //On trouve les lignes de factures de l'année voulue et le mois voulu
        $lignes = $factureRepository->findAllLignesByDates($annee, $mois);

        $montantFacture = [];
        $factureTab = [];
        $montantTotalTab = [];

        $montantTotal =0;


        // pour chaque ligne retrouvée, on set le montant, la facture et la quantité
        //Puis on les ajoute dans des array pour mieux s'y retrouver.
        foreach ($lignes as $ligne) {
            $testLignesFacture = new LigneFacture();

            $testLignesFacture->setMontant($ligne['montant']);
            $testLignesFacture->setFacture($factureRepository->find($ligne['id']));
            $testLignesFacture->setQuantite($ligne['quantite']);
            $facture = $testLignesFacture->getFacture();
            array_push($factureTab, $facture);
            array_push($montantFacture, $testLignesFacture);

        }
//        dd($montantFacture);
//        Pour chaque ligne de facture trouvée, on crée une facture pour trouver le montant total.
        foreach ($montantFacture as $ligneFacture) {
            $facture = $ligneFacture->getFacture();
            $montant = $facture->getMontantTotal();
            array_push($montantTotalTab, $montant);
        }

//        dd($montantTotalTab);

        foreach ($montantTotalTab as $montant){
            $montantTotal += $montant;
        }

        return $montantTotal;
    }

    /**
     * Fonction pour retrouver la facture pour l'année donnée
     * @param string $year
     * @return int|mixed|string
     */
    public function getFactureByYear(string $year): mixed
    {
        $facture = $this->factureRepository->findAllByYear($year);
        return $facture;
    }

    /**
     * Fonction pour retrouver tous les montant totaux sous forme de tableau
     * Pour retrouver un mois -> janvier  = letableau[0][0] , fevrier =letableau[0][1]
     * @param $year -> format '2020' pour 2020
     * @return array
     */
    public function getTabMontantParMois($year){
        $tabMontantParMois[]=[

        $montantTotalJanvier = $this->getMontantTotal($this->factureRepository, $year , '1'),
        $montantTotalFevrier = $this->getMontantTotal($this->factureRepository, $year , '2'),
        $montantTotalMars = $this->getMontantTotal($this->factureRepository, $year, '3'),
        $montantTotalAvril = $this->getMontantTotal($this->factureRepository, $year , '4'),
        $montantTotalMai = $this->getMontantTotal($this->factureRepository,  $year , '5'),
        $montantTotalJuin = $this->getMontantTotal($this->factureRepository,  $year , '6'),
        $montantTotalJuillet = $this->getMontantTotal($this->factureRepository, $year , '7'),
        $montantTotalAout = $this->getMontantTotal($this->factureRepository, $year , '8'),
        $montantTotalSeptembre = $this->getMontantTotal($this->factureRepository, $year , '9'),
        $montantTotalOctobre = $this->getMontantTotal($this->factureRepository, $year , '10'),
        $montantTotalNovembre = $this->getMontantTotal($this->factureRepository, $year, '11'),
        $montantTotalDecembre = $this->getMontantTotal($this->factureRepository, $year , '12')
        ];

//        dd($tabMontantParMois);
        return $tabMontantParMois;
    }

    /**
     * fonction pour creer une charte selon l'année choisie
     * @param ChartBuilderInterface $chartBuilder
     * @param string $year
     * @return Chart
     */
    public function buildChartByYear(ChartBuilderInterface $chartBuilder ,string $year): Chart
    {
        //Choisir le mois 0 = janvier et ainsi de suite
        $MOISDELANNEE = ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre',
            'Novembre', 'Decembre'];

        if(in_array($year,$this->getArrayOfYearsAvailable())) {

            $tabTotalAnnee = $this->getTabMontantParMois($year);



            $chart = $chartBuilder->createChart(Chart::TYPE_BAR);
            $chart->setData([
                'labels' => [$MOISDELANNEE[0], $MOISDELANNEE[1], $MOISDELANNEE[2], $MOISDELANNEE[3], $MOISDELANNEE[4],
                    $MOISDELANNEE[5], $MOISDELANNEE[6], $MOISDELANNEE[7], $MOISDELANNEE[8], $MOISDELANNEE[9]
                    , $MOISDELANNEE[10],$MOISDELANNEE[11]],

                'datasets' => [
                    [
                        'label' => $year,

                        'data' => [$tabTotalAnnee[0][0], $tabTotalAnnee[0][1], $tabTotalAnnee[0][2],$tabTotalAnnee[0][3],
                            $tabTotalAnnee[0][4],$tabTotalAnnee[0][5],$tabTotalAnnee[0][6],$tabTotalAnnee[0][7],$tabTotalAnnee[0][8],
                            $tabTotalAnnee[0][9],$tabTotalAnnee[0][10],$tabTotalAnnee[0][11]],
                        'backgroundColor' => ['rgba(255, 99, 132, 0.2)', 'rgba(255, 159, 64, 0.2)', 'rgba(255, 205, 86, 0.2)',
                            'rgba(255,160,122,0.2)','rgba(106,90,205,0.2)','rgba(186,85,211,0.2)','rgba(184,255,244,0.2)',
                            'rgba(220,20,60,0.2)','rgba(255,0,0,0.2)','rgba(199,21,133,0.2)','rgba(255,215,0,0.2)',
                            'rgba(128,0,128,0.2)'],
                        'borderColor' => ['rgb(255, 99, 132)', 'rgb(255, 159, 64)', 'rgb(255, 205, 86)','rgb(255,160,122)'
                            ,'rgb(106,90,205)','rgb(186,85,211)','rgb(184,255,244)', 'rgb(220,20,60)',
                            'rgb(255,0,0)','rgb(199,21,133)','rgb(255,215,0)','rgb(128,0,128)'],
                        'borderWidth' => 1,
                    ],

                ]
            ]);
        }
        else{
            $chart = $this->getChartComparatifAnnees($chartBuilder);
        }
        return $chart;
    }

    /**
     * Fonction pour retourner la charte de comparaison des mois pour chaque année.
     * @param ChartBuilderInterface $chartBuilder
     * @return Chart
     */
    public function getChartComparatifAnnees(ChartBuilderInterface $chartBuilder ): Chart
    {
        //Choisir le mois 0 = janvier et ainsi de suite
        $MOISDELANNEE = ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre',
            'Novembre', 'Decembre'];
        $year = date('Y');
        $yearN1 = $this->getYearN('1 year');
        $yearN2 = $this->getYearN('2 years');

        //Année actuelle
        $tabAnneeActuelle = $this->getTabMontantParMois($year);

        //Année N-1
        $tabAnneeN1 = $this->getTabMontantParMois($yearN1);

        // Année N-2
            $tabAnneeN2 = $this->getTabMontantParMois($yearN2);

        //L'année sera aussi selectionnée.
        $chart = $chartBuilder->createChart(Chart::TYPE_BAR);
        $chart->setData([
            'labels' => [$MOISDELANNEE[0], $MOISDELANNEE[1], $MOISDELANNEE[2], $MOISDELANNEE[3], $MOISDELANNEE[4],
                $MOISDELANNEE[5], $MOISDELANNEE[6], $MOISDELANNEE[7], $MOISDELANNEE[8], $MOISDELANNEE[9], $MOISDELANNEE[10]
                , $MOISDELANNEE[11]],
            'datasets' => [
                [
                    'label' => $year,
                    'data' => [$tabAnneeActuelle[0][0], $tabAnneeActuelle[0][1], $tabAnneeActuelle[0][2],$tabAnneeActuelle[0][3],
                        $tabAnneeActuelle[0][4],$tabAnneeActuelle[0][5],$tabAnneeActuelle[0][6],$tabAnneeActuelle[0][7],$tabAnneeActuelle[0][8],
                        $tabAnneeActuelle[0][9],$tabAnneeActuelle[0][10],$tabAnneeActuelle[0][11]],
                    'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                    'borderColor' => 'rgb(255, 99, 132)'
                ], [
                    'label' => $yearN1,
                    'data' => [$tabAnneeN1[0][0], $tabAnneeN1[0][1], $tabAnneeN1[0][2],$tabAnneeN1[0][3],
                        $tabAnneeN1[0][4],$tabAnneeN1[0][5],$tabAnneeN1[0][6],$tabAnneeN1[0][7],$tabAnneeN1[0][8],
                        $tabAnneeN1[0][9],$tabAnneeN1[0][10],$tabAnneeN1[0][11]],
                    'backgroundColor' => 'rgba(255, 159, 64, 0.2)',
                    'borderColor' => 'rgb(255, 159, 64)'
                ],
                [
                    'label' => $yearN2,

                    'data' => [$tabAnneeN2[0][0], $tabAnneeN2[0][1], $tabAnneeN2[0][2],$tabAnneeN2[0][3],
                        $tabAnneeN2[0][4],$tabAnneeN2[0][5],$tabAnneeN2[0][6],$tabAnneeN2[0][7],$tabAnneeN2[0][8],
                        $tabAnneeN2[0][9],$tabAnneeN2[0][10],$tabAnneeN2[0][11]],
                    'backgroundColor' => 'rgba(255, 205, 86, 0.2)',
                    'borderColor' => 'rgb(255, 205, 86)'
                ]
            ],
            'borderWidth' => 1,
        ]);

        return $chart;
    }
    /**
     * Trouver toutes les années disponibles
     * @return array
     */
    public function getArrayOfYearsAvailable(): array
    {
        $arrayOfYears = [];
        $anneesFactures = $this->factureRepository->findYearsAvailable();
        //Retrouver les années disponibles dans a BDD
        foreach ($anneesFactures as $year) {
            array_push($arrayOfYears, $year['years']);
        }
        //Ajout de la comparaison par mois de toutes les années dispo.
        array_push($arrayOfYears, 'Voir la comparaison des années');
        return $arrayOfYears;
    }

}
