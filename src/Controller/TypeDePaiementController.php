<?php

namespace App\Controller;

use App\Entity\TypeDePaiement;
use App\Form\TypeDePaiementType;
use App\Repository\TypeDePaiementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/type/de/paiement')]
class TypeDePaiementController extends AbstractController
{
    #[Route('/', name: 'type_de_paiement', methods: ['GET'])]
    public function index(TypeDePaiementRepository $typeDePaiementRepository): Response
    {
        return $this->render('type_de_paiement/index.html.twig', [
            'type_de_paiements' => $typeDePaiementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'type_de_paiement_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $typeDePaiement = new TypeDePaiement();
        $form = $this->createForm(TypeDePaiementType::class, $typeDePaiement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeDePaiement);
            $entityManager->flush();

            return $this->redirectToRoute('type_de_paiement');
        }

        return $this->render('type_de_paiement/new.html.twig', [
            'type_de_paiement' => $typeDePaiement,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'type_de_paiement_show', methods: ['GET'])]
    public function show(TypeDePaiement $typeDePaiement): Response
    {
        return $this->render('type_de_paiement/show.html.twig', [
            'type_de_paiement' => $typeDePaiement,
        ]);
    }

    #[Route('/{id}/edit', name: 'type_de_paiement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypeDePaiement $typeDePaiement): Response
    {
        $form = $this->createForm(TypeDePaiementType::class, $typeDePaiement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_de_paiement');
        }

        return $this->render('type_de_paiement/edit.html.twig', [
            'type_de_paiement' => $typeDePaiement,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'type_de_paiement_delete', methods: ['POST'])]
    public function delete(Request $request, TypeDePaiement $typeDePaiement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeDePaiement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeDePaiement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_de_paiement');
    }
}
