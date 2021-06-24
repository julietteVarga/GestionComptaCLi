<?php

namespace App\Controller;

use App\Repository\RendezVousRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(RendezVousRepository $rendezVousRepository): Response
    {
        $prochainRDV = $rendezVousRepository->prochainRDV();

        //dd($prochainRDV);
        return $this->render('main/index.html.twig', [
            'prochainRDV' => $prochainRDV,
        ]);
    }
}
