<?php

namespace App\Controller\Mobile;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use App\Repository\PublicationRepository;
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
 * @Route("/mobile/comment")
 */
class CommentMobileController extends AbstractController
{
    /**
     * @Route("", methods={"GET"})
     */
    public function index(CommentRepository $commentRepository): Response
    {
        $comments = $commentRepository->findAll();

        if ($comments) {
            return new JsonResponse($comments, 200);
        } else {
            return new JsonResponse([], 204);
        }
    }

    /**
     * @Route("/add", methods={"POST"})
     */
    public function add(Request $request, PublicationRepository $publicationRepository, UserRepository $userRepository): JsonResponse
    {
        $comment = new Comment();


        $publication = $publicationRepository->find((int)$request->get("publication"));
        if (!$publication) {
            return new JsonResponse("publication with id " . (int)$request->get("publication") . " does not exist", 203);
        }

        $user = $userRepository->find((int)$request->get("user"));
        if (!$user) {
            return new JsonResponse("user with id " . (int)$request->get("user") . " does not exist", 203);
        }


        $comment->constructor(
            $publication,
            $user,
            $request->get("content"),
            DateTime::createFromFormat("d-m-Y", $request->get("date"))
        );

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($comment);
        $entityManager->flush();

        return new JsonResponse($comment, 200);


    }

    /**
     * @Route("/edit", methods={"POST"})
     */
    public function edit(Request $request, CommentRepository $commentRepository, PublicationRepository $publicationRepository, UserRepository $userRepository): Response
    {
        $comment = $commentRepository->find((int)$request->get("id"));

        if (!$comment) {
            return new JsonResponse(null, 404);
        }


        $publication = $publicationRepository->find((int)$request->get("publication"));
        if (!$publication) {
            return new JsonResponse("publication with id " . (int)$request->get("publication") . " does not exist", 203);
        }

        $user = $userRepository->find((int)$request->get("user"));
        if (!$user) {
            return new JsonResponse("user with id " . (int)$request->get("user") . " does not exist", 203);
        }


        $comment->constructor(
            $publication,
            $user,
            $request->get("content"),
            DateTime::createFromFormat("d-m-Y", $request->get("date"))
        );

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($comment);
        $entityManager->flush();

        return new JsonResponse($comment, 200);
    }

    /**
     * @Route("/delete", methods={"POST"})
     */
    public function delete(Request $request, EntityManagerInterface $entityManager, CommentRepository $commentRepository): JsonResponse
    {
        $comment = $commentRepository->find((int)$request->get("id"));

        if (!$comment) {
            return new JsonResponse(null, 200);
        }

        $entityManager->remove($comment);
        $entityManager->flush();

        return new JsonResponse([], 200);
    }


}
