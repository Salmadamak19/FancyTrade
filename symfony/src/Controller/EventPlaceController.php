<?php

namespace App\Controller;

use App\Entity\EventPlace;
use App\Form\EventPlaceType;
use App\Repository\EventPlaceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/place')]
class EventPlaceController extends AbstractController
{
    #[Route('/', name: 'app_event_place_index', methods: ['GET'])]
    public function index(EventPlaceRepository $eventPlaceRepository): Response
    {
        return $this->render('event_place/index.html.twig', [
            'event_places' => $eventPlaceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_event_place_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EventPlaceRepository $eventPlaceRepository): Response
    {
        $eventPlace = new EventPlace();
        $form = $this->createForm(EventPlaceType::class, $eventPlace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eventPlaceRepository->save($eventPlace, true);

            return $this->redirectToRoute('app_event_place_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('event_place/new.html.twig', [
            'event_place' => $eventPlace,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_event_place_show', methods: ['GET'])]
    public function show(EventPlace $eventPlace): Response
    {
        return $this->render('event_place/show.html.twig', [
            'event_place' => $eventPlace,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_event_place_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EventPlace $eventPlace, EventPlaceRepository $eventPlaceRepository): Response
    {
        $form = $this->createForm(EventPlaceType::class, $eventPlace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eventPlaceRepository->save($eventPlace, true);

            return $this->redirectToRoute('app_event_place_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('event_place/edit.html.twig', [
            'event_place' => $eventPlace,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_event_place_delete', methods: ['POST'])]
    public function delete(Request $request, EventPlace $eventPlace, EventPlaceRepository $eventPlaceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$eventPlace->getId(), $request->request->get('_token'))) {
            $eventPlaceRepository->remove($eventPlace, true);
        }

        return $this->redirectToRoute('app_event_place_index', [], Response::HTTP_SEE_OTHER);
    }
}
