<?php

namespace App\Controller\Mobile;

use App\Entity\Post;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mobile/post")
 */
class PostMobileController extends AbstractController
{
    /**
     * @Route("", methods={"GET"})
     */
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findAll();

        if ($posts) {
            return new JsonResponse($posts, 200);
        } else {
            return new JsonResponse([], 204);
        }
    }

    /**
     * @Route("/add", methods={"POST"})
     */
    public function add(Request $request, UserRepository $userRepository): JsonResponse
    {
        $post = new Post();


        $user = $userRepository->find((int)$request->get("user"));
        if (!$user) {
            return new JsonResponse("user with id " . (int)$request->get("user") . " does not exist", 203);
        }


        $file = $request->files->get("file");
        if ($file) {
            $imageFileName = md5(uniqid()) . '.' . $file->guessExtension();
            try {
                $file->move($this->getParameter('post_image'), $imageFileName);
            } catch (FileException $e) {
                dd($e);
            }
        } else {
            if ($request->get("image")) {
                $imageFileName = $request->get("image");
            } else {
                $imageFileName = "null";
            }
        }

        $post->constructor(
            $user,
            $request->get("sujet"),
            $request->get("description"),
            (int)$request->get("nbrJaime"),
            $imageFileName,
            DateTime::createFromFormat("d-m-Y", $request->get("date")),
            $request->get("communaute"),
            $request->get("analyse"),
            (int)$request->get("liked"),
            (int)$request->get("badlevel")
        );

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($post);
        $entityManager->flush();

        return new JsonResponse($post, 200);


    }

    /**
     * @Route("/edit", methods={"POST"})
     */
    public function edit(Request $request, PostRepository $postRepository, UserRepository $userRepository): Response
    {
        $post = $postRepository->find((int)$request->get("id"));

        if (!$post) {
            return new JsonResponse(null, 404);
        }


        $user = $userRepository->find((int)$request->get("user"));
        if (!$user) {
            return new JsonResponse("user with id " . (int)$request->get("user") . " does not exist", 203);
        }


        $file = $request->files->get("file");
        if ($file) {
            $imageFileName = md5(uniqid()) . '.' . $file->guessExtension();
            try {
                $file->move($this->getParameter('post_image'), $imageFileName);
            } catch (FileException $e) {
                dd($e);
            }
        } else {
            if ($request->get("image")) {
                $imageFileName = $request->get("image");
            } else {
                $imageFileName = "null";
            }
        }

        $post->constructor(
            $user,
            $request->get("sujet"),
            $request->get("description"),
            (int)$request->get("nbrJaime"),
            $imageFileName,
            DateTime::createFromFormat("d-m-Y", $request->get("date")),
            $request->get("communaute"),
            $request->get("analyse"),
            (int)$request->get("liked"),
            (int)$request->get("badlevel")
        );

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($post);
        $entityManager->flush();

        return new JsonResponse($post, 200);
    }

    /**
     * @Route("/delete", methods={"POST"})
     */
    public function delete(Request $request, EntityManagerInterface $entityManager, PostRepository $postRepository): JsonResponse
    {
        $post = $postRepository->find((int)$request->get("id"));

        if (!$post) {
            return new JsonResponse(null, 200);
        }

        $entityManager->remove($post);
        $entityManager->flush();

        return new JsonResponse([], 200);
    }


    /**
     * @Route("/image/{image}", methods={"GET"})
     */
    public function getPicture(Request $request): BinaryFileResponse
    {
        return new BinaryFileResponse(
            $this->getParameter('post_image') . "/" . $request->get("image")
        );
    }

}
