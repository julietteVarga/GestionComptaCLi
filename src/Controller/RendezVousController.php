<?php

namespace App\Controller;

use App\Entity\Consultant;
use App\Entity\RendezVous;
use App\Form\RendezVousType;
use App\Form\RendezVousTypeTest;
use App\Repository\RendezVousRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

#[Route('/rendez_vous')]
class RendezVousController extends AbstractController
{
    #[Route('/', name: 'rendez_vous', methods: ['GET'])]
    public function index(RendezVousRepository $rendezVousRepository): Response
    {

//        dd($rendezVousRepository->findAllConsultantWithRDV());

        return $this->render('rendez_vous/index.html.twig', [
            // Il faut absolument cette fonction du repository sinon on ne retrouve pas les consultants
            'rendez_vouses' => $rendezVousRepository->findAllConsultantWithRDV()
        ]);
    }

    /**
     * fonction qui sert a retrouver la requête envoyée par le javascript dans _form.html.twig
     * https://www.youtube.com/watch?v=cYMq-9Znh1U&ab_channel=OverSeasMediaOverSeasMedia -> video qui explique comment faire
     * @param Request $request
     * @param $query -> pas obligatoire, sinon on se retrouve avec une erreur bloquante
     * @return JsonResponse
     */
    #[Route('/handleSearch/{query?}', name: 'rendez_vous_handle_search', methods: ['GET', 'POST'])]
    public function handleSearchRequest(Request $request,$query): JsonResponse
    {
        $em = $this->getDoctrine()->getManager();

        //Si il y a une requête, on retrouve le nom et la prénom avec la lettre envoyée par la requête.
        if($query){
            $data = $em->getRepository(Consultant::class)->findNomPrenombyLetter($query);
        }
        //Sinon on les récupère tous.
        else{
            $data = $em->getRepository(Consultant::class)->findAll();
        }
        $normalizers = [
            new ObjectNormalizer()
        ];
        $encoders = [
            new JsonEncoder()
        ];
        $serializer = new Serializer($normalizers,$encoders);

        $data = $serializer->serialize($data,'json');

        //On retourne une réponse 200 avec les données sous forme de Json
        return new JsonResponse($data,200,[],true);
    }


    #[Route('/new', name: 'rendez_vous_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $rendezVou = new RendezVous();
        $rendezVou->setCreateur($this->getUser());
        $form = $this->createForm(RendezVousType::class, $rendezVou);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $consultant = $form->getData()->getConsultant();
//            dd($consultant);
            $rendezVou->setConsultant($consultant);

            $entityManager->persist($rendezVou);
            $entityManager->flush();
            return $this->redirectToRoute('rendez_vous');
        }

        return $this->render('rendez_vous/new.html.twig', [
            'rendez_vou' => $rendezVou,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'rendez_vous_show', methods: ['GET'])]
    public function show(RendezVous $rendezVou): Response
    {
        return $this->render('rendez_vous/show.html.twig', [
            'rendez_vou' => $rendezVou,
        ]);
    }


    #[Route('/{id}/edit', name: 'rendez_vous_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RendezVous $rendezVou): Response
    {
        $form = $this->createForm(RendezVousType::class, $rendezVou);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rendez_vous');
        }

        return $this->render('rendez_vous/edit.html.twig', [
            'rendez_vou' => $rendezVou,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'rendez_vous_delete', methods: ['POST'])]
    public function delete(Request $request, RendezVous $rendezVou): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rendezVou->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rendezVou);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rendez_vous');
    }
}
