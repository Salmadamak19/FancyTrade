<?php

namespace App\Controller\Mobile;

use App\Entity\Commentaire;
use App\Repository\CommentaireRepository;
use App\Repository\UserRepository;
use App\Repository\PostRepository;
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
 * @Route("/mobile/commentaire")
 */
class CommentaireMobileController extends AbstractController
{
    /**
     * @Route("", methods={"GET"})
     */
    public function index(CommentaireRepository $commentaireRepository): Response
    {
        $commentaires = $commentaireRepository->findAll();

        if ($commentaires) {
            return new JsonResponse($commentaires, 200);
        } else {
            return new JsonResponse([], 204);
        }
    }

    /**
     * @Route("/add", methods={"POST"})
     */
    public function add(Request $request, UserRepository $userRepository, PostRepository $postRepository): JsonResponse
    {
        $commentaire = new Commentaire();


        $user = $userRepository->find((int)$request->get("user"));
        if (!$user) {
            return new JsonResponse("user with id " . (int)$request->get("user") . " does not exist", 203);
        }

        $post = $postRepository->find((int)$request->get("post"));
        if (!$post) {
            return new JsonResponse("post with id " . (int)$request->get("post") . " does not exist", 203);
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

        $commentaire->constructor(
            $user,
            $post,
            $imageFileName,
            $request->get("description"),
            DateTime::createFromFormat("d-m-Y", $request->get("date")),
            $request->get("analyse"),
            DateTime::createFromFormat("d-m-Y", $request->get("datecTs"))
        );

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($commentaire);
        $entityManager->flush();

        return new JsonResponse($commentaire, 200);


    }

    /**
     * @Route("/edit", methods={"POST"})
     */
    public function edit(Request $request, CommentaireRepository $commentaireRepository, UserRepository $userRepository, PostRepository $postRepository): Response
    {
        $commentaire = $commentaireRepository->find((int)$request->get("id"));

        if (!$commentaire) {
            return new JsonResponse(null, 404);
        }


        $user = $userRepository->find((int)$request->get("user"));
        if (!$user) {
            return new JsonResponse("user with id " . (int)$request->get("user") . " does not exist", 203);
        }

        $post = $postRepository->find((int)$request->get("post"));
        if (!$post) {
            return new JsonResponse("post with id " . (int)$request->get("post") . " does not exist", 203);
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

        $commentaire->constructor(
            $user,
            $post,
            $imageFileName,
            $request->get("description"),
            DateTime::createFromFormat("d-m-Y", $request->get("date")),
            $request->get("analyse"),
            DateTime::createFromFormat("d-m-Y", $request->get("datecTs"))
        );

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($commentaire);
        $entityManager->flush();

        return new JsonResponse($commentaire, 200);
    }

    /**
     * @Route("/delete", methods={"POST"})
     */
    public function delete(Request $request, EntityManagerInterface $entityManager, CommentaireRepository $commentaireRepository): JsonResponse
    {
        $commentaire = $commentaireRepository->find((int)$request->get("id"));

        if (!$commentaire) {
            return new JsonResponse(null, 200);
        }

        $entityManager->remove($commentaire);
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
