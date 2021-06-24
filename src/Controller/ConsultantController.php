<?php

namespace App\Controller;

use App\Entity\CommentaireConsultant;
use App\Entity\Consultant;
use App\Form\CommentaireConsultantType;
use App\Form\ConsultantType;
use App\Repository\ConsultantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Controller\Uploader;

#[Route('/consultant')]
class ConsultantController extends AbstractController
{

   /* public function index(ConsultantRepository $consultantRepository): Response
    {
        return $this->render('consultant/index.html.twig', [
            'consultants' => $consultantRepository->findAll(),
        ]);
    }*/

    #[Route('/', name: 'consultant', methods: ['GET'])]
    public function index(EntityManagerInterface $em, PaginatorInterface $paginator, Request $request)
    {
        /*
         * Récuperation des adresses de l'entité Consultant
         */
        $dql   = "SELECT c,a FROM App\Entity\Consultant c JOIN c.adresse a";
        $query = $em->createQuery($dql);

        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        // parameters to template
        return $this->render('consultant/indexPagination.html.twig', ['pagination' => $pagination]);
    }



    #[Route('/new', name: 'consultant_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder, Uploader $uploader): Response
    {
        $consultant = new Consultant();
        $this->denyAccessUnlessGranted("ROLE_USER");
        $consultant->setRoles(["ROLE_USER"]);

        //Mettre par défaut dans la zone de l'auteur le pseudo de l'utilisateur connecté
        $consultant->setUsername($this->getUser()->getUsername());

        $consultant = new Consultant();

        $form = $this->createForm(ConsultantType::class, $consultant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //ajout pour la date de creation
            $consultant->setDateCreation(new \DateTime('now'));
            //Récupération du password depuis le formulaire
            $plainPassword = $form->get('password')->getData();

            //Encodage du password
            $encoded = $passwordEncoder->encodePassword($consultant, $plainPassword);
            $consultant->setPassword($plainPassword);

            /**
             * @var UploadedFile $brochureFile
             */
            $uploadedFile = $form->get('photos')->getData();

            if ($uploadedFile) {
                //on va définir un emplacement de fichier au niveau du services.yaml
                //Pour pouvoir configurer l'endroit ou on dépose nos fichiers.
                $newFilename = $uploader->upload($uploadedFile, $this->getParameter('photo_directory'), $consultant->getNom(), $consultant->getPrenom());
                $consultant->setPhotos($newFilename);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($consultant);
            $entityManager->flush();

            return $this->redirectToRoute('consultant');
        }

        return $this->render('consultant/new.html.twig', [
            'consultant' => $consultant,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/show', name: 'consultant_show', methods: ['GET'])]
    public function show(Consultant $consultant): Response
    {

        $commentaires = $this->getDoctrine()->getRepository(CommentaireConsultant::class)->findBy([
            'consultant' => $consultant,
        ],['date' => 'desc']);

        $commentaire = new CommentaireConsultant();
        $formCommentaire = $this->createForm(CommentaireConsultantType::class,$commentaire,[
            'action' => $this->generateUrl('commentaire_consultant_new'),
            'method' => 'POST',
        ]);
        return $this->render('consultant/show.html.twig', [
            'consultant' => $consultant,
            'commentaires'=>$commentaires,
            'comment_form' => $formCommentaire->createView(),

        ]);
    }

    #[Route('/{id}/edit', name: 'consultant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Consultant $consultant, UserPasswordEncoderInterface $passwordEncoder, Uploader $uploader): Response
    {
        $commentaires = $this->getDoctrine()->getRepository(CommentaireConsultant::class)->findBy([
            'consultant' => $consultant,
        ],['date' => 'desc']);

        $commentaire = new CommentaireConsultant();
        $formCommentaire = $this->createForm(CommentaireConsultantType::class,$commentaire);

        //Récupération de l'ancien password
        $oldPassord= $consultant->getPassword();

        //appliquer la regle des validations groups que pour celle qui non pas de validation de groupe donc on ne prendra pas en compte le groupe registration.
        $form = $this->createForm(ConsultantType::class, $consultant,['validation_groups' => ['Default']],);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form->get('password')->getData();
           if(($plainPassword != null) && ($plainPassword != $oldPassord)) {
               //Encodage du password
               $encoded = $passwordEncoder->encodePassword($consultant, $plainPassword);
               $consultant->setPassword($encoded);
           }else{
               $consultant->setPassword($oldPassord);
           }
            /**
             * @var UploadedFile $brochureFile
             */
            $uploadedFile = $form->get('photos')->getData();

            if ($uploadedFile) {
                //on va définir un emplacement de fichier au niveau du services.yaml
                //Pour pouvoir configurer l'endroit ou on dépose nos fichiers.

                $newFilename = $uploader->upload($uploadedFile, $this->getParameter('photo_directory'), $consultant->getNom(), $consultant->getPrenom());
                $consultant->setPhotos($newFilename);
            }

            $this->getDoctrine()->getManager()->flush();


           /* $commentaire = new CommentaireConsultant();
            $commentaire->setDescription($form->getData()->description);
            //$commentaire->setDescription("dddddddddddd");
            $commentaire->setDate(new \DateTime('now'));
            $commentaire->setConsultant($consultant);
            $doctrine = $this->getDoctrine()->getManager();

            // On hydrate notre instance $commentaire
            $doctrine->persist($commentaire);
            // On écrit en base de données
            $doctrine->flush();*/

            return $this->redirectToRoute('consultant');
        }

        return $this->render('consultant/edit.html.twig', [
            'consultant' => $consultant,
            'form' => $form->createView(),
            'commentaires'=>$commentaires,
            'comment_form' => $formCommentaire->createView(),
        ]);
    }

    #[Route('/{id}', name: 'consultant_delete', methods: ['POST'])]
    public function delete(Request $request, Consultant $consultant): Response
    {
        if ($this->isCsrfTokenValid('delete' . $consultant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($consultant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('consultant');
    }
}
