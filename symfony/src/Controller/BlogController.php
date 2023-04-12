<?php

namespace App\Controller;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index(): Response
    {
        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->findAll();
        return $this->render('blog/index.html.twig', [
            'u'=>$user
        ]);
    }

    #[Route('/addUser', name: 'app_User')]
    public function addUser(UserRepository $r,UserPasswordEncoderInterface $password_encoder,ManagerRegistry $doctrine,Request $request)
    
    {
        $user = new user();
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        
        
        
        
        $user->setRoles(['ROLE_USER']);

        if($form->isSubmitted() && $form->isValid()) {
                       $em =$doctrine->getManager() ;
                       $em->persist($user); //add
                       $em->flush();
                       return $this->redirectToRoute("app_blog");
        }
        return $this->render('blog/createUser.html.twig', [
            'f' =>$form->createView(),
        ]);
    }
    #[Route('/removeUser/{id}', name: 'supp_User')]
public function suppressionUser($id,UserRepository $r,ManagerRegistry $doctrine): Response
{
    $user=$r->find($id);
    $em =$doctrine->getManager();
    $em->remove($user);
    $em->flush();    
    
    return $this->redirectToRoute('app_blog');

}

#[Route('/modifUser/{id}', name: 'modifUser')]
    public function modifUserr($id,UserRepository $r,ManagerRegistry $doctrine,Request $request): Response
    {
        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find($id);
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
                       $em = $this->getDoctrine()->getManager();
                       $em->flush();
                       return $this->redirectToRoute("app_blog");
        }
        return $this->render('blog/updateUser.html.twig', [
            'f' =>$form->createView(),
        ]);

    }
        #[Route('/admin', name: 'app_admin')]
        public function indexAdmin(): Response
        {
           // $user = $this->getDoctrine()->getManager()->getRepository(User::class)->findAll();
            return $this->render('admin/dashboard.html.twig', [
                //'u'=>$user
            ]);
        }

        #[Route('/client', name: 'app_client')]
        public function indexClient(): Response
        {
            return $this->render('Client/index.html.twig', [
                
            ]);
        }

        


    #[Route('/detailUsr/{id}/{email}/{name}', name: 'app_detailUsr')]
    public function detailFormation($id,$email,$name): Response
    {
        return $this->render('/blog/detailUsr.html.twig', [
            'i' => $id,'e' => $email,'n'=> $name]);
    }

    #[Route('/profilAD', name: 'profilAD')]
    public function profilAD(UserRepository $r,ManagerRegistry $doctrine,Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
                       $em =$doctrine->getManager() ;
                       $em->persist($user); 
                       $em->flush();
                       return $this->redirectToRoute("profilAD");
        }
        return $this->render('admin/profilAD.html.twig', [
            'f' =>$form->createView(),
        ]);
    }

    #[Route('/profilUS', name: 'app_profilUS')]
    public function profilUS(UserRepository $r,ManagerRegistry $doctrine,Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
                       $em =$doctrine->getManager() ;
                       $em->persist($user); 
                       $em->flush();
                       return $this->redirectToRoute("app_profilUS");
        }
        return $this->render('Client/profilUS.html.twig', [
            'f' =>$form->createView(),
        ]);
    }

    #[Route('/categorie', name: 'app_categorie')]
    public function Client(): Response
    {
        return $this->render('blog/index.html.twig', [
            
        ]);
    }

    #[Route('/post', name: 'app_post')]
    public function indeClient(): Response
    {
        return $this->render('Client/index.html.twig', [
            
        ]);
    }

    #[Route('/echanges', name: 'app_echanges')]
    public function indexClint(): Response
    {
        return $this->render('Client/index.html.twig', [
            
        ]);
    }

    #[Route('/forum', name: 'app_forum')]
    public function indxClient(): Response
    {
        return $this->render('Client/index.html.twig', [
            
        ]);
    }

    #[Route('/evenement', name: 'app_evenement')]
    public function ndexClient(): Response
    {
        return $this->render('Client/index.html.twig', [
            
        ]);
    }

    

}
