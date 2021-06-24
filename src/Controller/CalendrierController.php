<?php

namespace App\Controller;

use App\Entity\Consultant;
use App\Entity\RendezVous;
use App\Repository\ConsultantRepository;
use App\Repository\RendezVousRepository;
use App\Repository\UserRepository;
use App\Service\CalendrierService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendrierController extends AbstractController
{


    #[Route('/calendrierGoogle', name: 'calendrier_google')]
    public function indexGoogle(CalendrierService $calendrierService,RendezVousRepository $rendezVousRepository, EntityManagerInterface $manager, Request $request): Response
    {

        $data = $calendrierService->jsonRendezVous($rendezVousRepository);
        return $this->render('calendrier/googleCalendarExemple.html.twig', compact('data'));
    }


    #[Route('/calendrier', name: 'calendrier')]
    public function index(CalendrierService $calendrierService,RendezVousRepository $rendezVousRepository, EntityManagerInterface $manager, Request $request): Response
    {


        $data = $calendrierService->jsonRendezVous($rendezVousRepository);

        return $this->render('calendrier/index.html.twig', compact('data'));
    }



    #[Route('/calendrier/{id}/edit', name: 'calendrier_edit', methods: ['POST', 'GET'])]
    public function eventModif(CalendrierService $calendrierService,RendezVousRepository $rendezVousRepository,
                               ?RendezVous $rendezVous, EntityManagerInterface $manager, Request $request,
                               UserRepository $userRepository, ConsultantRepository $consultantRepository): Response
    {
        //On décode le json envoyé par la requête, pour pouvoir utiliser les données
        //données envoyées exemple {"id":"16","title":"Rendez-vous de test","description":"Je teste pour voir si c'est bon"
        //,"start":"2021-06-04T04:01:00.000Z","end":"2021-06-04T05:03:00.000Z","consultant":27,"createur":40}
        $data = json_decode($request->getContent(), true);


        if (
            isset($data['title']) && !empty($data['title']) &&
            isset($data['start']) && !empty($data['start']) &&
            isset($data['description']) && !empty($data['description']) &&
            isset($data['end']) && !empty($data['end']) &&
            isset($data['consultant']) && !empty($data['consultant']) &&
            isset($data['createur']) && !empty($data['createur'])
        ) {
            // Les données sont complètes
            //On initialise un code
            $code = 200;

            // On vérifie si l'id existe

            //Si'il n'existe pas, on crée un nouveau rdv
            if (!$rendezVous) {
                // On instancie un rdv
                $createur = $userRepository->findById((int)$data['createur']);
                $consultant = $consultantRepository->findById((int)$data["consultant"]);
                $rendezVous = new RendezVous();
                $rendezVous->setTitre($data['title']);
                $rendezVous->setDateDebut(new \DateTime($data['start']));
                $rendezVous->setDateFin(new \DateTime($data['end']));
                $rendezVous->setCommentaire($data['description']);
                $rendezVous->setCreateur($createur[0]);
                $rendezVous->setConsultant($consultant[0]);
                $manager->persist($rendezVous);
                $manager->flush();
                // On change le code a 'created'
                $code = 201;
            }

            //Sinon On hydrate l'objet avec nos données envoyées par la requête
            $createur = $userRepository->findById((int)$data['createur']);
            $consultant = $consultantRepository->findById((int)$data['consultant']);

            $rendezVous->setTitre($data['title']);
            $rendezVous->setDateDebut(new \DateTime($data['start']));
            $rendezVous->setDateFin(new \DateTime($data['end']));
            $rendezVous->setCommentaire($data['description']);
            $rendezVous->setCreateur($createur[0]);
            $rendezVous->setConsultant($consultant[0]);
            $manager->persist($rendezVous);
            $manager->flush();

            $data = $calendrierService->jsonRendezVous($rendezVousRepository);
            return $this->render('calendrier/index.html.twig', compact('data'));
        }
        //Si rien n'est envoyé par la requête, on va quand même checher les rdv dans la bdd pour les afficher

        $data = $calendrierService->jsonRendezVous($rendezVousRepository);
        return $this->render('calendrier/index.html.twig', compact('data'));
    }
}
