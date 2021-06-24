<?php

namespace App\Controller;

use App\Entity\CommentaireConsultant;
use App\Form\CommentaireConsultantType;
use App\Repository\CommentaireConsultantRepository;
use App\Repository\ConsultantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/commentaire/consultant')]
class CommentaireConsultantController extends AbstractController
{
    #[Route('/', name: 'commentaire_consultant_index', methods: ['GET'])]
    public function index(CommentaireConsultantRepository $commentaireConsultantRepository): Response
    {
        return $this->render('commentaire_consultant/index.html.twig', [
            'commentaire_consultants' => $commentaireConsultantRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'commentaire_consultant_new', methods: ['GET', 'POST'])]
    public function new(Request $request,ConsultantRepository $consultantRepository): Response
    {
        $commentaireConsultant = new CommentaireConsultant();
        $form = $this->createForm(CommentaireConsultantType::class, $commentaireConsultant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $idConsultant=$request->get('consultant_id');
            $consultant=$consultantRepository->find($idConsultant);

            $commentaireConsultant->setConsultant($consultant);
            $commentaireConsultant->setDate(new \DateTime('now'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentaireConsultant);
            $entityManager->flush();

            return $this->redirectToRoute('consultant_show',['id'=>$idConsultant]);
        }
        return $this->render('commentaire_consultant/new.html.twig', [
            'commentaire_consultant' => $commentaireConsultant,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'commentaire_consultant_show', methods: ['GET'])]
    public function show(CommentaireConsultant $commentaireConsultant): Response
    {
        return $this->render('commentaire_consultant/show.html.twig', [
            'commentaire_consultant' => $commentaireConsultant,
        ]);
    }

    #[Route('/{id}/edit', name: 'commentaire_consultant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CommentaireConsultant $commentaireConsultant): Response
    {
        $form = $this->createForm(CommentaireConsultantType::class, $commentaireConsultant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commentaire_consultant_index');
        }

        return $this->render('commentaire_consultant/edit.html.twig', [
            'commentaire_consultant' => $commentaireConsultant,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'commentaire_consultant_delete', methods: ['POST'])]
    public function delete(Request $request, CommentaireConsultant $commentaireConsultant): Response
    {
        $idConsultant = $commentaireConsultant->getConsultant()->getId();
        if ($this->isCsrfTokenValid('delete'.$commentaireConsultant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commentaireConsultant);
            $entityManager->flush();
        }

        //return $this->redirectToRoute('commentaire_consultant_index');
        return $this->redirectToRoute('consultant_show',['id'=>$idConsultant]);
    }
}
