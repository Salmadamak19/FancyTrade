<?php

namespace App\Controller\Mobile;

use App\Entity\Publication;
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
 * @Route("/mobile/publication")
 */
class PublicationMobileController extends AbstractController
{
    /**
     * @Route("", methods={"GET"})
     */
    public function index(PublicationRepository $publicationRepository): Response
    {
        $publications = $publicationRepository->findAll();

        if ($publications) {
            return new JsonResponse($publications, 200);
        } else {
            return new JsonResponse([], 204);
        }
    }

    /**
     * @Route("/add", methods={"POST"})
     */
    public function add(Request $request, UserRepository $userRepository): JsonResponse
    {
        $publication = new Publication();


        $user = $userRepository->find((int)$request->get("user"));
        if (!$user) {
            return new JsonResponse("user with id " . (int)$request->get("user") . " does not exist", 203);
        }


        $file = $request->files->get("file");
        if ($file) {
            $imageFileName = md5(uniqid()) . '.' . $file->guessExtension();
            try {
                $file->move($this->getParameter('publication_images_directory'), $imageFileName);
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

        $publication->constructor(
            $user,
            $request->get("content"),
            DateTime::createFromFormat("d-m-Y", $request->get("date")),
            $imageFileName
        );

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($publication);
        $entityManager->flush();

        return new JsonResponse($publication, 200);


    }

    /**
     * @Route("/edit", methods={"POST"})
     */
    public function edit(Request $request, PublicationRepository $publicationRepository, UserRepository $userRepository): Response
    {
        $publication = $publicationRepository->find((int)$request->get("id"));

        if (!$publication) {
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
                $file->move($this->getParameter('publication_images_directory'), $imageFileName);
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

        $publication->constructor(
            $user,
            $request->get("content"),
            DateTime::createFromFormat("d-m-Y", $request->get("date")),
            $imageFileName
        );

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($publication);
        $entityManager->flush();

        return new JsonResponse($publication, 200);
    }

    /**
     * @Route("/delete", methods={"POST"})
     */
    public function delete(Request $request, EntityManagerInterface $entityManager, PublicationRepository $publicationRepository): JsonResponse
    {
        $publication = $publicationRepository->find((int)$request->get("id"));

        if (!$publication) {
            return new JsonResponse(null, 200);
        }

        $entityManager->remove($publication);
        $entityManager->flush();

        return new JsonResponse([], 200);
    }


    /**
     * @Route("/image/{image}", methods={"GET"})
     */
    public function getPicture(Request $request): BinaryFileResponse
    {
        return new BinaryFileResponse(
            $this->getParameter('publication_images_directory') . "/" . $request->get("image")
        );
    }

}
