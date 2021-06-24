<?php

namespace App\Controller;

use App\Entity\Consultant;
use App\Entity\Facture;
use App\Repository\FactureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

class PDFController extends AbstractController
{
    #[Route('{id}/pdf', name: 'pdf_generation')]
    public function index(Facture $facture): Response
    {
        //$facture = $factureRepository->find(1);
        //dd($facture);
        $title = "Facture de: " . $facture->getConsultant()->getNom() . ' ' . $facture->getConsultant()->getPrenom();
        $filename = 'Facture.pdf';
        $options = new Options();
        $options->set('defaultFont', 'Roboto');
        $options->setIsRemoteEnabled(false);
        $options->setIsHtml5ParserEnabled(true);

        //---------------------------
        // Get Base64 of the Logo
        $path = $this->getParameter('kernel.project_dir') . '/public/img/favicon.jpg';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($data);
        //---------------------------

        $dompdf = new Dompdf($options);
        //Génerer le html
        $html = $this->renderView('pdf/pdf_facture_template.html.twig', [
            'title' => $title,
            'logo' => $logo,
            'facture' => $facture
        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        //on envoie le pdf au navigateur
        $dompdf->stream($filename, [
            "Attachment" => false
        ]);
    }
}
