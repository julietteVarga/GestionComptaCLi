<?php

namespace App\Controller;

use App\Service\GraphiqueService;
use App\Service\UtilAnneeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UrssafController extends AbstractController
{
    #[Route('/urssaf', name: 'urssaf')]
    public function index(UtilAnneeService $utilAnneeService): Response
    {
        $anneeEnCours = date('Y');
        $montantTotalJanvier=$utilAnneeService->getMonTotalParMois(1,$anneeEnCours);
        $montantTotalFevrier = $utilAnneeService->getMonTotalParMois(2,$anneeEnCours);
        $montantTotalMars = $utilAnneeService->getMonTotalParMois(3,$anneeEnCours);
        $montantTotal1erTrimestre=$montantTotalJanvier+$montantTotalFevrier+$montantTotalMars;

        $montantTotalAvril=$utilAnneeService->getMonTotalParMois(4,$anneeEnCours);
        $montantTotalMai=$utilAnneeService->getMonTotalParMois(5,$anneeEnCours);
        $montantTotalJuin=$utilAnneeService->getMonTotalParMois(6,$anneeEnCours);
        $montantTotal2emeTrimestre=$montantTotalAvril+$montantTotalMai+$montantTotalJuin;

        $montantTotalJuillet=$utilAnneeService->getMonTotalParMois(7,$anneeEnCours);
        $montantTotalAout=$utilAnneeService->getMonTotalParMois(8,$anneeEnCours);
        $montantTotalSeptembre=$utilAnneeService->getMonTotalParMois(9,$anneeEnCours);
        $montantTotal3emeTrimestre=$montantTotalJuillet+$montantTotalAout+$montantTotalSeptembre;

        $montantTotalOctobre=$utilAnneeService->getMonTotalParMois(10,$anneeEnCours);
        $montantTotalNovembre=$utilAnneeService->getMonTotalParMois(11,$anneeEnCours);
        $montantTotalDecembre=$utilAnneeService->getMonTotalParMois(12,$anneeEnCours);
        $montantTotal4emeTrimestre=$montantTotalOctobre+$montantTotalNovembre+$montantTotalDecembre;


        //---------------------------------------------
        //Déclaration des taux
        //---------------------------------------------
        $tauxVenteMarchandise=13.80;
        $tauxPrestationsDeServicesCommercialesOuArtisanales=23.70;
        $tauxAutresPrestationsDeService=24.20;
        $tauxFormationArtisan=0.30;
        $tauxTaxeCMAVente=0.22;
        $tauxTaxeCMAService=0.48;
        //---------------------------------------------

        $chiffreAffaire1erTrimestreVenteMarchandise = 0;
        $calculVenteMarchandise1erTrimestre =($chiffreAffaire1erTrimestreVenteMarchandise*$tauxVenteMarchandise)/100;

        $chiffreAffaire1erTrimestrePrestationsServicesCommerciales = 0;
        $calculPrestationsDeServices1erTrimestre=($chiffreAffaire1erTrimestrePrestationsServicesCommerciales * $tauxPrestationsDeServicesCommercialesOuArtisanales)/100;

        $calculAutresPrestationsServices1erTrimestre=($montantTotal1erTrimestre*$tauxAutresPrestationsDeService)/100;

        $calculFormationArtisan1erTrimestre=(($chiffreAffaire1erTrimestreVenteMarchandise+$chiffreAffaire1erTrimestrePrestationsServicesCommerciales+$montantTotal1erTrimestre)*$tauxFormationArtisan)/100;

        $calculTaxeCMAVente1erTrimestre=(($chiffreAffaire1erTrimestreVenteMarchandise+$chiffreAffaire1erTrimestrePrestationsServicesCommerciales+$montantTotal1erTrimestre)*$tauxTaxeCMAVente)/100;;
        $calculTaxeCMAService1erTrimestre=(($chiffreAffaire1erTrimestreVenteMarchandise+$chiffreAffaire1erTrimestrePrestationsServicesCommerciales+$montantTotal1erTrimestre)*$tauxTaxeCMAService)/100;;
        $calculTotalCotisationEtImpot1erTrimestre=$calculVenteMarchandise1erTrimestre+$calculPrestationsDeServices1erTrimestre+$calculAutresPrestationsServices1erTrimestre+$calculFormationArtisan1erTrimestre+$calculTaxeCMAVente1erTrimestre+$calculTaxeCMAService1erTrimestre;
        $deduction1erTrimestre=0;
        $montantAPayer1erTrimestre= $calculTotalCotisationEtImpot1erTrimestre-$deduction1erTrimestre;

        //--------------------------------------------------------
        $chiffreAffaire2emeTrimestreVenteMarchandise = 0;
        $calculVenteMarchandise2emeTrimestre =($chiffreAffaire2emeTrimestreVenteMarchandise*$tauxVenteMarchandise)/100;

        $chiffreAffaire2emeTrimestrePrestationsServicesCommerciales = 0;
        $calculPrestationsDeServices2emeTrimestre=($chiffreAffaire2emeTrimestrePrestationsServicesCommerciales * $tauxPrestationsDeServicesCommercialesOuArtisanales)/100;

        $calculAutresPrestationsServices2emeTrimestre=($montantTotal2emeTrimestre*$tauxAutresPrestationsDeService)/100;

        $calculFormationArtisan2emeTrimestre=(($chiffreAffaire2emeTrimestreVenteMarchandise+$chiffreAffaire2emeTrimestrePrestationsServicesCommerciales+$montantTotal2emeTrimestre)*$tauxFormationArtisan)/100;

        $calculTaxeCMAVente2emeTrimestre=(($chiffreAffaire2emeTrimestreVenteMarchandise+$chiffreAffaire2emeTrimestrePrestationsServicesCommerciales+$montantTotal2emeTrimestre)*$tauxTaxeCMAVente)/100;;
        $calculTaxeCMAService2emeTrimestre=(($chiffreAffaire2emeTrimestreVenteMarchandise+$chiffreAffaire2emeTrimestrePrestationsServicesCommerciales+$montantTotal2emeTrimestre)*$tauxTaxeCMAService)/100;;
        $calculTotalCotisationEtImpot2emeTrimestre=$calculVenteMarchandise2emeTrimestre+$calculPrestationsDeServices2emeTrimestre+$calculAutresPrestationsServices2emeTrimestre+$calculFormationArtisan2emeTrimestre+$calculTaxeCMAVente2emeTrimestre+$calculTaxeCMAService2emeTrimestre;
        $deduction2emeTrimestre=0;
        $montantAPayer2emeTrimestre= $calculTotalCotisationEtImpot2emeTrimestre-$deduction2emeTrimestre;


        //--------------------------------------------------------
        $chiffreAffaire3emeTrimestreVenteMarchandise = 0;
        $calculVenteMarchandise3emeTrimestre =($chiffreAffaire3emeTrimestreVenteMarchandise*$tauxVenteMarchandise)/100;

        $chiffreAffaire3emeTrimestrePrestationsServicesCommerciales = 0;
        $calculPrestationsDeServices3emeTrimestre=($chiffreAffaire3emeTrimestrePrestationsServicesCommerciales * $tauxPrestationsDeServicesCommercialesOuArtisanales)/100;

        $calculAutresPrestationsServices3emeTrimestre=($montantTotal3emeTrimestre*$tauxAutresPrestationsDeService)/100;

        $calculFormationArtisan3emeTrimestre=(($chiffreAffaire3emeTrimestreVenteMarchandise+$chiffreAffaire3emeTrimestrePrestationsServicesCommerciales+$montantTotal3emeTrimestre)*$tauxFormationArtisan)/100;

        $calculTaxeCMAVente3emeTrimestre=(($chiffreAffaire3emeTrimestreVenteMarchandise+$chiffreAffaire3emeTrimestrePrestationsServicesCommerciales+$montantTotal3emeTrimestre)*$tauxTaxeCMAVente)/100;;
        $calculTaxeCMAService3emeTrimestre=(($chiffreAffaire3emeTrimestreVenteMarchandise+$chiffreAffaire3emeTrimestrePrestationsServicesCommerciales+$montantTotal3emeTrimestre)*$tauxTaxeCMAService)/100;;
        $calculTotalCotisationEtImpot3emeTrimestre=$calculVenteMarchandise3emeTrimestre+$calculPrestationsDeServices3emeTrimestre+$calculAutresPrestationsServices3emeTrimestre+$calculFormationArtisan3emeTrimestre+$calculTaxeCMAVente3emeTrimestre+$calculTaxeCMAService3emeTrimestre;
        $deduction3emeTrimestre=0;
        $montantAPayer3emeTrimestre= $calculTotalCotisationEtImpot3emeTrimestre-$deduction3emeTrimestre;


        //--------------------------------------------------------
        $chiffreAffaire4emeTrimestreVenteMarchandise = 0;
        $calculVenteMarchandise4emeTrimestre =($chiffreAffaire4emeTrimestreVenteMarchandise*$tauxVenteMarchandise)/100;

        $chiffreAffaire4emeTrimestrePrestationsServicesCommerciales = 0;
        $calculPrestationsDeServices4emeTrimestre=($chiffreAffaire4emeTrimestrePrestationsServicesCommerciales * $tauxPrestationsDeServicesCommercialesOuArtisanales)/100;

        $calculAutresPrestationsServices4emeTrimestre=($montantTotal4emeTrimestre*$tauxAutresPrestationsDeService)/100;

        $calculFormationArtisan4emeTrimestre=(($chiffreAffaire4emeTrimestreVenteMarchandise+$chiffreAffaire4emeTrimestrePrestationsServicesCommerciales+$montantTotal4emeTrimestre)*$tauxFormationArtisan)/100;

        $calculTaxeCMAVente4emeTrimestre=(($chiffreAffaire4emeTrimestreVenteMarchandise+$chiffreAffaire4emeTrimestrePrestationsServicesCommerciales+$montantTotal4emeTrimestre)*$tauxTaxeCMAVente)/100;;
        $calculTaxeCMAService4emeTrimestre=(($chiffreAffaire4emeTrimestreVenteMarchandise+$chiffreAffaire4emeTrimestrePrestationsServicesCommerciales+$montantTotal4emeTrimestre)*$tauxTaxeCMAService)/100;;
        $calculTotalCotisationEtImpot4emeTrimestre=$calculVenteMarchandise4emeTrimestre+$calculPrestationsDeServices4emeTrimestre+$calculAutresPrestationsServices4emeTrimestre+$calculFormationArtisan4emeTrimestre+$calculTaxeCMAVente4emeTrimestre+$calculTaxeCMAService4emeTrimestre;
        $deduction4emeTrimestre=0;
        $montantAPayer4emeTrimestre= $calculTotalCotisationEtImpot4emeTrimestre-$deduction4emeTrimestre;


        return $this->render('urssaf/index.html.twig', [
            'anneeEnCours' => $anneeEnCours,
            'tauxVenteMarchandise'=>$tauxVenteMarchandise,
            'tauxPrestationsDeServicesCommercialesOuArtisanales'=>$tauxPrestationsDeServicesCommercialesOuArtisanales,
            'tauxAutresPrestationsDeService'=>$tauxAutresPrestationsDeService,
            'tauxFormationArtisan'=> $tauxFormationArtisan,
            'tauxTaxeCMAVente'=>$tauxTaxeCMAVente,
            'tauxTaxeCMAService'=>$tauxTaxeCMAService,

            'montantTotal1erTrimestre' => $montantTotal1erTrimestre,
            'chiffreAffaire1erTrimestreVenteMarchandise' => $chiffreAffaire1erTrimestreVenteMarchandise,
            'chiffreAffaire1erTrimestrePrestationsServicesCommerciales' => $chiffreAffaire1erTrimestrePrestationsServicesCommerciales,
            'calculVenteMarchandise1erTrimestre' => $calculVenteMarchandise1erTrimestre,
            'calculPrestationsDeServices1erTrimestre' => $calculPrestationsDeServices1erTrimestre,
            'calculAutresPrestationsServices1erTrimestre'=>$calculAutresPrestationsServices1erTrimestre,
            'calculFormationArtisan1erTrimestre'=>$calculFormationArtisan1erTrimestre,
            'calculTaxeCMAVente1erTrimestre'=>$calculTaxeCMAVente1erTrimestre,
            'calculTaxeCMAService1erTrimestre'=>$calculTaxeCMAService1erTrimestre,
            'calculTotalCotisationEtImpot1erTrimestre'=>$calculTotalCotisationEtImpot1erTrimestre,
            'deduction1erTrimestre'=>$deduction1erTrimestre,
            'montantAPayer1erTrimestre'=>$montantAPayer1erTrimestre,

            'montantTotal2emeTrimestre' => $montantTotal2emeTrimestre,
            'chiffreAffaire2emeTrimestreVenteMarchandise' => $chiffreAffaire2emeTrimestreVenteMarchandise,
            'chiffreAffaire2emeTrimestrePrestationsServicesCommerciales' => $chiffreAffaire2emeTrimestrePrestationsServicesCommerciales,
            'calculVenteMarchandise2emeTrimestre' => $calculVenteMarchandise2emeTrimestre,
            'calculPrestationsDeServices2emeTrimestre' => $calculPrestationsDeServices2emeTrimestre,
            'calculAutresPrestationsServices2emeTrimestre'=>$calculAutresPrestationsServices2emeTrimestre,
            'calculFormationArtisan2emeTrimestre'=>$calculFormationArtisan2emeTrimestre,
            'calculTaxeCMAVente2emeTrimestre'=>$calculTaxeCMAVente2emeTrimestre,
            'calculTaxeCMAService2emeTrimestre'=>$calculTaxeCMAService2emeTrimestre,
            'calculTotalCotisationEtImpot2emeTrimestre'=>$calculTotalCotisationEtImpot2emeTrimestre,
            'deduction2emeTrimestre'=>$deduction2emeTrimestre,
            'montantAPayer2emeTrimestre'=>$montantAPayer2emeTrimestre,

            'montantTotal3emeTrimestre' => $montantTotal3emeTrimestre,
            'chiffreAffaire3emeTrimestreVenteMarchandise' => $chiffreAffaire3emeTrimestreVenteMarchandise,
            'chiffreAffaire3emeTrimestrePrestationsServicesCommerciales' => $chiffreAffaire3emeTrimestrePrestationsServicesCommerciales,
            'calculVenteMarchandise3emeTrimestre' => $calculVenteMarchandise3emeTrimestre,
            'calculPrestationsDeServices3emeTrimestre' => $calculPrestationsDeServices3emeTrimestre,
            'calculAutresPrestationsServices3emeTrimestre'=>$calculAutresPrestationsServices3emeTrimestre,
            'calculFormationArtisan3emeTrimestre'=>$calculFormationArtisan3emeTrimestre,
            'calculTaxeCMAVente3emeTrimestre'=>$calculTaxeCMAVente3emeTrimestre,
            'calculTaxeCMAService3emeTrimestre'=>$calculTaxeCMAService3emeTrimestre,
            'calculTotalCotisationEtImpot3emeTrimestre'=>$calculTotalCotisationEtImpot3emeTrimestre,
            'deduction3emeTrimestre'=>$deduction3emeTrimestre,
            'montantAPayer3emeTrimestre'=>$montantAPayer3emeTrimestre,

            'montantTotal4emeTrimestre' => $montantTotal4emeTrimestre,
            'chiffreAffaire4emeTrimestreVenteMarchandise' => $chiffreAffaire4emeTrimestreVenteMarchandise,
            'chiffreAffaire4emeTrimestrePrestationsServicesCommerciales' => $chiffreAffaire4emeTrimestrePrestationsServicesCommerciales,
            'calculVenteMarchandise4emeTrimestre' => $calculVenteMarchandise4emeTrimestre,
            'calculPrestationsDeServices4emeTrimestre' => $calculPrestationsDeServices4emeTrimestre,
            'calculAutresPrestationsServices4emeTrimestre'=>$calculAutresPrestationsServices4emeTrimestre,
            'calculFormationArtisan4emeTrimestre'=>$calculFormationArtisan4emeTrimestre,
            'calculTaxeCMAVente4emeTrimestre'=>$calculTaxeCMAVente4emeTrimestre,
            'calculTaxeCMAService4emeTrimestre'=>$calculTaxeCMAService4emeTrimestre,
            'calculTotalCotisationEtImpot4emeTrimestre'=>$calculTotalCotisationEtImpot4emeTrimestre,
            'deduction4emeTrimestre'=>$deduction4emeTrimestre,
            'montantAPayer4emeTrimestre'=>$montantAPayer4emeTrimestre,

        ]);
    }
}
