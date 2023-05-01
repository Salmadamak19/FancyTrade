<?php

namespace App\Controller;

use App\Entity\Poste;
use App\Entity\User;
use App\Form\PosteType;
use App\Repository\PosteRepository;
use App\Repository\CommentaireRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/poste')]
class PosteController extends AbstractController
{
    #[Route('/posts', name: 'app_poste_index', methods: ['GET'])]
    public function index(PosteRepository $posteRepository): Response
    {
        return $this->render('poste/index.html.twig', [
            'postes' => $posteRepository->findAll(),
            'postesinfo'=>$posteRepository->findByDomaine("Info"),
            'posteselectro'=>$posteRepository->findByDomaine("Electromecanqiue"),
            'postessante'=>$posteRepository->findByDomaine("Sante"),
        ]);
    }

    #[Route('/addposts', name: 'app_poste_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PosteRepository $posteRepository, UserRepository $userrepo): Response
    {
        $poste = new Poste();
        
        
        $poste->setIduser($userrepo->findOneById(1));
        $form = $this->createForm(PosteType::class, $poste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('img')->getData();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
    
            // Move the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('uploads_directory'),
                $fileName
            );
    
            // ... other code to handle the $post object
    
            $poste->setImg($fileName);
            $poste->setDate(date('Y-m-d H:i:s'));
            // ...
            $posteRepository->save($poste, true);

            return $this->redirectToRoute('app_poste_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('poste/new.html.twig', [
            'poste' => $poste,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_poste_show', methods: ['GET'])]
    public function show(Poste $poste,CommentaireRepository $commentrepo): Response
    {
        return $this->render('poste/show.html.twig', [
            'poste' => $poste,
            'commentaires'=>$commentrepo->allcomments($poste->getId()),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_poste_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Poste $poste, PosteRepository $posteRepository): Response
    {
        $form = $this->createForm(PosteType::class, $poste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('img')->getData();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
    
            // Move the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('uploads_directory'),
                $fileName
            );
    
            // ... other code to handle the $post object
    
            $poste->setImg($fileName);
            $posteRepository->save($poste, true);

            return $this->redirectToRoute('app_poste_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('poste/edit.html.twig', [
            'poste' => $poste,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_poste_delete', methods: ['POST'])]
    public function delete(Request $request, Poste $poste, PosteRepository $posteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$poste->getId(), $request->request->get('_token'))) {
            $posteRepository->remove($poste, true);
        }

        return $this->redirectToRoute('app_poste_index', [], Response::HTTP_SEE_OTHER);
    }
}
