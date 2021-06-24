<?php


namespace App\Service;

use App\Repository\RendezVousRepository;
use \DateTime;
use App\Repository\FactureRepository;
use Doctrine\ORM\EntityManagerInterface;

class CalendrierService
{


    /**
     * fonction qui retourne un json des rendez-vous afin de les afficher dans le calendrier
     * @param $rendezVousRepository
     * @return bool|string
     */
    public function jsonRendezVous ( RendezVousRepository $rendezVousRepository): bool|string
    {
        $events = $rendezVousRepository->findAll();
        $rdvs = [];
        foreach ($events as $event) {
            $rdvs[] = [
                'id' => $event->getId(),
                'start' => $event->getDateDebut()->format('Y-m-d H:i:s'),
                'end' => $event->getDateFin()->format('Y-m-d H:i:s'),
                'title' => $event->getTitre(),
                'description' => $event->getCommentaire(),
                'extendedProps' => [
                    'consultant_id' => $event->getConsultant()->getId(),
                    'createur_id' => $event->getCreateur()->getId()
                ]

            ];
        }
        return  json_encode($rdvs);
    }


}