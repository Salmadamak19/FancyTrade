<?php

namespace App\Controller\Mobile;

use App\Entity\EventPlace;
use App\Repository\EventPlaceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mobile/eventplace")
 */
class EventPlaceMobileController extends AbstractController
{
    /**
     * @Route("", methods={"GET"})
     */
    public function index(EventPlaceRepository $eventPlaceRepository): Response
    {
        $eventPlaces = $eventPlaceRepository->findAll();

        if ($eventPlaces) {
            return new JsonResponse($eventPlaces, 200);
        } else {
            return new JsonResponse([], 204);
        }
    }

    /**
     * @Route("/add", methods={"POST"})
     */
    public function add(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Validate the request data
        if (!isset($data['name']) || !isset($data['description'])) {
            return new JsonResponse(['error' => 'Invalid request data'], 400);
        }

        // Create a new EventPlace entity
        $eventPlace = new EventPlace();
        $eventPlace->setName($data['name']);
        $eventPlace->setDescription($data['description']);

        // Save the event place to the database
        $entityManager->persist($eventPlace);
        $entityManager->flush();

        return new JsonResponse(['message' => 'Event place added successfully'], 200);
    }

    /**
     * @Route("/edit", methods={"POST"})
     */
    public function edit(Request $request, EntityManagerInterface $entityManager, EventPlaceRepository $eventPlaceRepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Validate the request data
        if (!isset($data['id']) || !isset($data['name']) || !isset($data['description'])) {
            return new JsonResponse(['error' => 'Invalid request data'], 400);
        }

        // Find the existing EventPlace entity
        $eventPlace = $eventPlaceRepository->find($data['id']);

        if (!$eventPlace) {
            return new JsonResponse(['error' => 'Event place not found'], 404);
        }

        // Update the event place data
        $eventPlace->setName($data['name']);
        $eventPlace->setDescription($data['description']);

        // Save the updated event place to the database
        $entityManager->flush();

        return new JsonResponse(['message' => 'Event place updated successfully'], 200);
    }

    /**
     * @Route("/delete", methods={"POST"})
     */
    public function delete(Request $request, EntityManagerInterface $entityManager, EventPlaceRepository $eventPlaceRepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Validate the request data
        if (!isset($data['id'])) {
            return new JsonResponse(['error' => 'Invalid request data'], 400);
        }

        // Find the existing EventPlace entity
        $eventPlace = $eventPlaceRepository->find($data['id']);

        if (!$eventPlace) {
            return new JsonResponse(['error' => 'Event place not found'], 404);
        }

        // Remove the event place from the database
        $entityManager->remove($eventPlace);
        $entityManager->flush();

        return new JsonResponse(['message' => 'Event place deleted successfully'], 200);
    }
}
