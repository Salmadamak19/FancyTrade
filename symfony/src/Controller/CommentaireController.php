<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Repository\CommentaireRepository;
use App\Repository\PostRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/commentaire")
 */
class CommentaireController extends AbstractController
{
     /**
     * @Route("/", name="app_commentaire_index", methods={"GET"})
     */
    public function index(CommentaireRepository $commentaireRepository): Response
    {
        return $this->render('commentaire/index.html.twig', [
            'commentaires' => $commentaireRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_commentaire_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CommentaireRepository $commentaireRepository): Response
    {
        $commentaire = new Commentaire();
        $commentaire->setDatec(new \DateTime());
        $commentaire->setNomUser("current_user");


        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $commentaireRepository->add($commentaire, true);
            return $this->redirectToRoute('app_commentaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commentaire/new.html.twig', [
            'commentaire' => $commentaire,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_commentaire_show", methods={"GET"})
     */
    public function show(Commentaire $commentaire): Response
    {
        return $this->render('commentaire/show.html.twig', [
            'commentaire' => $commentaire,
        ]);
    }

    /**
     * @Route("/{id}/new", name="app_commentaire_post", methods={"GET","POST"})
     */
    public function commentpost(Request $request, CommentaireRepository $commentaireRepository, PostRepository $rep, $id): Response
    {

        $post= $rep->find($id);
        $commentaire = new Commentaire();
        $commentaire->setPost($post);
        $commentaire->setDatec(new \DateTime());
        $commentaire->setNomUser("current_user");


        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $commentaireRepository->add($commentaire, true);
            return $this->redirectToRoute('app_comment_post', ['id'=>$id], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commentaire/addComment.html.twig', [
            'commentaire' => $commentaire,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/editfront", name="app_commentaire_editfront", methods={"GET","POST"})
     */
    public function editfront(Request $request, Commentaire $commentaire, CommentaireRepository $commentaireRepository, PostRepository $rep): Response
    {
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $post = $commentaire->getPost()->getId();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentaireRepository->add($commentaire, true);

            return $this->redirectToRoute('app_comment_post', ['id'=>$post], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commentaire/editComment.html.twig', [
            'commentaire' => $commentaire,
            'form' => $form,
        ]);
    }


     /**
     * @Route("/{id}/edit", name="app_commentaire_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Commentaire $commentaire, CommentaireRepository $commentaireRepository): Response
    {
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentaireRepository->add($commentaire, true);

            return $this->redirectToRoute('app_commentaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commentaire/edit.html.twig', [
            'commentaire' => $commentaire,
            'form' => $form,
        ]);
    }

/**
     * @Route("/{id}/remove", name="app_commentaire_remove", methods={"GET"})
     */
    public function Remove($id,CommentaireRepository $rep){

        $commentaire=$rep->find($id);
        $post = $commentaire->getPost();
        $res=$post->getId();
        //dd($commentaire);
        $em=$this->getDoctrine()->getManager();
        $em->remove($commentaire);
        $em->flush();
        return $this->redirectToRoute('app_comment_post', ['id'=> $res]);
    }




    /**
     * @Route("/{id}", name="app_commentaire_delete", methods={"POST"})
     */
    public function delete(Request $request, Commentaire $commentaire, CommentaireRepository $commentaireRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commentaire->getId(), $request->request->get('_token'))) {
            $commentaireRepository->remove($commentaire, true);
        }

        return $this->redirectToRoute('app_commentaire_index', [], Response::HTTP_SEE_OTHER);
    }
}
