<?php

namespace App\Controller;

use App\Entity\Echange;
use App\Repository\EchangeRepository;
use App\Repository\ProduitRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
#[Route('/echange')]
class EchangeController extends AbstractController
{

    #[Route('/Admin', name: 'app_echange_index_admin', methods: ['GET'])]
    public function indexAdminEchange(EchangeRepository $echangeRepository): Response
    {
        return $this->render('echange/indexBack.html.twig', [
            'echanges' => $echangeRepository->findAll(),
        ]);
    }

    #[Route('/editApp/{id}', name: 'app_echange_edit_approuvee', methods: ['GET', 'POST'])]
    public function editApp(Request $request, Echange $echange, EchangeRepository $echangeRepository): Response
    {

        $echange->setStatut("Approuvée");
        $echangeRepository->save($echange, true);

        return $this->redirectToRoute('app_echange_myechanges', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/editRef/{id}', name: 'app_echange_edit_refusee', methods: ['GET', 'POST'])]
    public function editRef(Request $request, Echange $echange, EchangeRepository $echangeRepository): Response
    {

        $echange->setStatut("Refusée");
        $echangeRepository->save($echange, true);

            return $this->redirectToRoute('app_echange_myechanges', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/exchange/{id}', name: 'app_echange')]
    public function index(ProduitRepository $produitRepository,UserRepository $userRepository,$id,TokenStorageInterface $tokenStorage): Response
    {
        $user = $tokenStorage->getToken()->getUser();
        $produit = $produitRepository->find($id);
        $produits = $produitRepository->findBy([
            'User' => $user,
        ]);

        return $this->render('echange/index.html.twig', [
            'produit' => $produit,
            'Mesproduits' => $produits

        ]);
    }

    #[Route('/Editexchange/{id}', name: 'app_echange_edit')]
    public function Edit(ProduitRepository $produitRepository,UserRepository $userRepository,Echange $echange,TokenStorageInterface $tokenStorage): Response
    {

        $user = $userRepository->find(1);
        $produits = $produitRepository->findBy([
            'User' => $user,
        ]);

        return $this->render('echange/edit.html.twig', [
            'echange' =>$echange,
            'Mesproduits' => $produits

        ]);
    }
    #[Route('/MesEchanges', name: 'app_echange_myechanges', methods: ['GET'])]
    public function MesEchanges(EchangeRepository $echangeRepository,UserRepository $userRepository,TokenStorageInterface $tokenStorage): Response
    {
        $user = $tokenStorage->getToken()->getUser();
        $echanges = $echangeRepository->findBy([
            'user' => $user
        ]);
        $echangesReq = $echangeRepository->findBy([
            'userRequest' => $user
        ]);
        return $this->render('echange/MesEchanges.html.twig', [
            'echanges' => $echanges,
            'echangesReq' => $echangesReq
        ]);
    }
    #[Route('/AddEchange/{id}/{idreq}', name: 'app_echange_add', methods: ['GET'])]
    public function AddEchange(EchangeRepository $echangeRepository,UserRepository $userRepository,ProduitRepository $produitRepository,$id,$idreq,TokenStorageInterface $tokenStorage): Response
    {
        $produitReq = $produitRepository->find($idreq);

        $user = $tokenStorage->getToken()->getUser();
        $userReq = $produitReq->getUser();
        $produit = $produitRepository->find($id);
        $echange = new Echange();
        $echange->setUser($user);
        $echange->setProduit($produit);
        $echange->setStatut("En Attente");
        $echange->setDateEchange(new \DateTime());
        $echange->setUserRequest($userReq);
        $echange->setProduitRequest($produitReq);
        $echangeRepository->save($echange, true);


        $echanges = $echangeRepository->findBy([
            'user' => $user
        ]);
        return $this->redirectToRoute('app_echange_myechanges', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/EditEchange/{id}/{idech}', name: 'app_echange_editt', methods: ['GET'])]
    public function EditEchange(EchangeRepository $echangeRepository,UserRepository $userRepository,ProduitRepository $produitRepository,$id,$idech,TokenStorageInterface $tokenStorage): Response
    {
        $echange = $echangeRepository->find($idech);

        $user = $tokenStorage->getToken()->getUser();
        $produit =  $produitRepository->find($id);
        $echange->setProduit($produit);

        $echangeRepository->save($echange, true);


        $echanges = $echangeRepository->findBy([
            'user' => $user
        ]);
        return $this->redirectToRoute('app_echange_myechanges', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/delete/{id}', name: 'app_echange_delete', methods: ['POST'])]
    public function delete(Request $request, Echange $echange, EchangeRepository $echangeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$echange->getId(), $request->request->get('_token'))) {
            $echangeRepository->remove($echange, true);
        }

        return $this->redirectToRoute('app_echange_myechanges', [], Response::HTTP_SEE_OTHER);
    }


}
