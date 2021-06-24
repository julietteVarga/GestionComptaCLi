<?php

namespace App\Controller;


use App\Entity\LigneFacture;

use App\Form\GraphiqueType;

use App\Repository\FactureRepository;
use App\Service\GraphiqueService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;


class GraphiqueController extends AbstractController
{
    #[Route('/chiffreAffaireParAnnees', name: 'chiffreAffaireParAnnees')]
    public function chiffresDAffairesAnnees(GraphiqueService $graphiqueService,ChartBuilderInterface $chartBuilder, Request $request): Response
    {
        $actualYear = date('Y');
        $year = $actualYear;
        $facture = $graphiqueService->getFactureByYear( '%' . $year . '%')[0];

        //Formulaire pour selectionner l'année voulue ou le comparatif de tous les mois par années.
        $myform = $this->createForm(GraphiqueType::class, $facture);
        $myform->handleRequest($request);

        $arrayOfYears = $graphiqueService->getArrayOfYearsAvailable();

        $chart = $graphiqueService->getChartComparatifAnnees($chartBuilder);

        if ($myform->isSubmitted()) {
            // Si c'est le bouton choisir alors on affiche un graphique selon le choix
            // A modifier si on rajoute des années
            if($myform->get('save')->isClicked()) {

                switch ($myform['annees']->getData()) {
                    case 0:
                        $year = $arrayOfYears[0];
                        $chart = $graphiqueService->buildChartByYear($chartBuilder,$year);
                        break;
                    case 1:
                        $year = $arrayOfYears[1];
                        $chart = $graphiqueService->buildChartByYear($chartBuilder,$year);
                        break;

                    case 2:
                        $year = $arrayOfYears[2];
                        $chart = $graphiqueService->buildChartByYear($chartBuilder,$year);
                        break;
                        // Le dernier case doit toujours être celui du comparatif de toutes les années.
                    case 3:
                        $chart = $graphiqueService->getChartComparatifAnnees($chartBuilder);

                }
            }
            // Si c'est le bouton filtrer alors on affiche le graphique grâce à l'année écrite dans le formulaire.
            if($myform->get('filtrer')->isClicked()){
               $year = $myform['anneesTyped']->getData();
               $chart = $graphiqueService->buildChartByYear($chartBuilder,$year);
            }
        }
        return $this->render('graphique/chiffreAffaireParAnnees.html.twig', [

            'testForm' => $myform->createView(),
            'chart' => $chart,

        ]);
    }


//    /**
//     * Fonction pour retourner un tableau des chiffres d'affaires par mois
//     * @param FactureRepository $factureRepository
//     * @param array $getMonthIntervals
//     * @return array
//     * @throws Exception
//     */
//    public function getSumRevenuePerMonth(FactureRepository $factureRepository, array $getMonthIntervals): array
//    {
//
//        $tabMonthly = [];
//
//        //Janvier
//        $factureJanvier = $factureRepository->findAllMontantByDates($getMonthIntervals[0], $getMonthIntervals[1]);
//        var_dump($factureJanvier);
//        $factureJanvier = $factureJanvier[0];
//
//        $factureJanvier = intval($factureJanvier);
//
//        //Fevrier
//        $factureFevrier = $factureRepository->findAllMontantByDates($getMonthIntervals[2], $getMonthIntervals[3]);
//        $factureFevrier = $factureFevrier[0];
//        $factureFevrier = intval($factureFevrier);
//
//        //Mars
//        $factureMars = $factureRepository->findAllMontantByDates($getMonthIntervals[4], $getMonthIntervals[5]);
//        $factureMars = $factureMars[0];
//        $factureMars = intval($factureMars);
//
//        //On met tout dans le tableau
//        array_push($tabMonthly, $factureJanvier, $factureFevrier, $factureMars);
//
//
//        return $tabMonthly;
//    }
}


