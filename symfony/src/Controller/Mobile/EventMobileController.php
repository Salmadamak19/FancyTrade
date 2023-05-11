<?php

namespace App\Controller\Mobile;

use App\Entity\Event;
use App\Repository\EventPlaceRepository;
use App\Repository\EventRepository;
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
 * @Route("/mobile/event")
 */
class EventMobileController extends AbstractController
{
    /**
     * @Route("", methods={"GET"})
     */
    public function index(EventRepository $eventRepository): Response
    {
        $events = $eventRepository->findAll();

        if ($events) {
            return new JsonResponse($events, 200);
        } else {
            return new JsonResponse([], 204);
        }
    }

    /**
     * @Route("/add", methods={"POST"})
     */
    public function add(Request $request, UserRepository $userRepository, EventPlaceRepository $eventPlaceRepository): JsonResponse
    {
        $event = new Event();

        $user = $userRepository->find((int)$request->get("user"));
        if (!$user) {
            return new JsonResponse("user with id " . (int)$request->get("user") . " does not exist", 203);
        }
        $eventplace = $eventPlaceRepository->find((int)$request->get("place"));
        if (!$eventplace) {
            return new JsonResponse("eventplace with id " . (int)$request->get("place") . " does not exist", 203);
        }

        $file = $request->files->get("file");
        if ($file) {
            $imageFileName = md5(uniqid()) . '.' . $file->guessExtension();
            try {
                $file->move($this->getParameter('event_images_directory'), $imageFileName);
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

        $event->setName($request->get("name"));
        $event->setDescription($request->get("description"));
        $event->setPlace($eventplace);
        $event->setImage($imageFileName);
        $event->setDateandTime(DateTime::createFromFormat("Y-m-d H:i:s", $request->get("dateandtime")));
        $event->setUser($user);
        $event->setOrganiser($request->get("organiser"));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($event);
        $entityManager->flush();

        return new JsonResponse($event, 200);
    }
    /**
     * @Route("/delete", methods={"POST"})
     */
    public function delete(Request $request, EntityManagerInterface $entityManager, EventRepository $eventRepository): JsonResponse
    {
        $event = $eventRepository->find((int)$request->get("id"));

        if (!$event) {
            return new JsonResponse(null, 200);
        }

        $entityManager->remove($event);
        $entityManager->flush();

        return new JsonResponse([], 200);
    }

    /**
     * @Route("/edit", methods={"POST"})
     */
    public function edit(Request $request, EventRepository $eventRepository, UserRepository $userRepository, EventPlaceRepository $eventPlaceRepository): JsonResponse
    {
        $event = $eventRepository->find((int)$request->get("id"));

        if (!$event) {
            return new JsonResponse(null, 404);
        }

        $user = $userRepository->find((int)$request->get("user"));
        if (!$user) {
            return new JsonResponse("user with id " . (int)$request->get("user") . " does not exist", 203);
        }
        $eventplace = $eventPlaceRepository->find((int)$request->get("place"));
        if (!$eventplace) {
            return new JsonResponse("eventplace with id " . (int)$request->get("place") . " does not exist", 203);
        }

        $file = $request->files->get("file");
        if ($file) {
            $imageFileName = md5(uniqid()) . '.' . $file->guessExtension();
            try {
                $file->move($this->getParameter('event_images_directory'), $imageFileName);
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

            $event->setImage($imageFileName);
        

        $event->setName($request->get("name"));
        $event->setDescription($request->get("description"));
        $event->setPlace($eventplace);
        $event->setDateandTime(DateTime::createFromFormat("Y-m-d H:i:s", $request->get("dateandtime")));
        $event->setUser($user);
        $event->setOrganiser($request->get("organiser"));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($event);
        $entityManager->flush();

        return new JsonResponse($event, 200);
    }
    /**
     * @Route("/image/{image}", methods={"GET"})
     */
    public function getPicture(Request $request): BinaryFileResponse
    {
        return new BinaryFileResponse(
            $this->getParameter('event_image') . "/" . $request->get("image")
        );
    }
}
