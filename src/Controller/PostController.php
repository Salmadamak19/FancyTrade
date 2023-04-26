<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sentiment\Analyzer;
use MercurySeries\FlashyBundle\FlashyNotifier;




/**
 * @Route("/post")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/", name="app_post_index", methods={"GET"})
     */
    public function index(PostRepository $postRepository): Response
    {
        return $this->render('post/index.html.twig', [
            'posts' => $postRepository->findAll(),
        ]);
    }

    /**
     * @Route("/date", name="app_post_date", methods={"GET"})
     */
    function decroissantDate(PostRepository $repository){
        $posts = $repository->trie_decroissant_date();
        // $posts= $repository->findAll();
        
        return $this->render('post/index.html.twig',['posts' => $posts]);
    }


    /**
     * @Route("/sujet", name="app_post_sujet", methods={"GET"})
     */
    function decroissantSujet(PostRepository $repository){
        $posts = $repository->trie_decroissant_sujet();
        // $posts= $repository->findAll();
        
        return $this->render('post/index.html.twig',['posts' => $posts]);
    }

    /**
     * @Route("/searchposteajax", name="app_searchpost")
     */

    public function searchajax(Request $request ,PostRepository $repository)
    {
        $repository = $this->getDoctrine()->getRepository(Post::class);
        $requestString=$request->get('searchValue');
        $post = $repository->findpostbyname($requestString);
        // $tache=$repository->findAll();

        return $this->render('post/ajax.html.twig', [
            "posts"=>$post,
        ]);
    }

    /**
     * @Route("/front", name="app_post_front", methods={"GET"})
     */
    public function frontpost(PostRepository $postRepository): Response
    {
        return $this->render('post/post.html.twig', [
            'posts' => $postRepository->findAll(),
        ]);
    }

    /**
     * @Route("/front/new", name="app_postfront_new", methods={"GET", "POST"})
     */
    public function addPost(Request $request, PostRepository $postRepository, SluggerInterface $slugger, FlashyNotifier $flashy): Response
    {
        $post = new Post();
        $post->setDateP(new \DateTime());
        $post->setNomUser("current_user");
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $analyzer = new Analyzer();

            //$a = array("neg => ", "new =>  ", "pos =>  ","compound =>  ");
            $b = $analyzer->getSentiment($post->getDescription());

            $output_text =  $b;


            $json = json_encode($output_text);
            // dd($json);
            $post->setAnalysePo($json);
            $negPos = strpos($post->getAnalysePo(), '"neg":');

            if ($negPos !== false) {
                // If the "neg" property exists, extract the value
                $negValue = (float) substr($post->getAnalysePo(), $negPos + 7, 5);
                //dd($post->getAnalysePo());
                if ($negValue != 0) {
                    return $this->render('post/badwords.html.twig');
                    // return $this->renderForm('post/addPost.html.twig', [
                    //     'post' => $post,
                    //     'form' => $form,
                    // ]);
                } 
            }

            //Analyse comment

           
            $brochureFile = $form->get('image')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('post_image'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $post->setImage($newFilename); 
            }



            $postRepository->add($post, true);
            $this->addFlash('success', 'This post added successfully');

            return $this->redirectToRoute('app_post_front', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post/addPost.html.twig', [
            'post' => $post,
            'form' => $form,
            'flashy' => $flashy,
        ]);
    }


    /**
     * @Route("/new", name="app_post_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PostRepository $postRepository, SluggerInterface $slugger): Response
    {
        $post = new Post();
        $post->setDateP(new \DateTime());
        $post->setNomUser("current_user");
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile = $form->get('image')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('post_image'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $post->setImage($newFilename); 
            }



            $postRepository->add($post, true);

            return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post/new.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/details/{id}", name="app_post_show", methods={"GET"})
     */
    public function show(Post $post): Response
    {
        return $this->render('post/show.html.twig', [
            'post' => $post,
        ]);
    }

    /**
     * @Route("/{id}", name="app_comment_post", methods={"GET"})
     */
    public function commentSection(Post $post): Response
    {
        return $this->render('commentaire/comments.html.twig', [
            'post' => $post,
        ]);
    }

    /**
     * @Route("/back/{id}", name="app_post_showcomments", methods={"GET"})
     */
    public function commentSectionBack(Post $post): Response
    {
        return $this->render('commentaire/showcomments.html.twig', [
            'post' => $post,
        ]);
    }

    /**
     * @Route("/{id}/editfront", name="app_post_editfront", methods={"GET", "POST"})
     */
    public function editfront(Request $request, Post $post, PostRepository $postRepository,SluggerInterface $slugger): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $brochureFile = $form->get('image')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('post_image'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $post->setImage($newFilename); 
            }


            $postRepository->add($post, true);

            return $this->redirectToRoute('app_post_front', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post/editfront.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_post_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Post $post, PostRepository $postRepository,SluggerInterface $slugger): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $brochureFile = $form->get('image')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('post_image'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $post->setImage($newFilename); 
            }


            $postRepository->add($post, true);

            return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post/edit.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_post_delete", methods={"POST"})
     */
    public function delete(Request $request, Post $post, PostRepository $postRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->request->get('_token'))) {
            $postRepository->remove($post, true);
        }

        return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
    }
    /**
     * @Route("/front/{id}", name="app_postfront_delete", methods={"POST"})
     */
    public function deletefront(Request $request, Post $post, PostRepository $postRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->request->get('_token'))) {
            $postRepository->remove($post, true);
            $this->addFlash('danger', 'This post removed successfully');
        }

        return $this->redirectToRoute('app_post_front', [], Response::HTTP_SEE_OTHER);
    }
}
