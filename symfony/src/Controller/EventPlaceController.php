<?php

namespace App\Controller;

use App\Entity\EventPlace;
use App\Form\EventPlaceType;
use App\Repository\EventPlaceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/place')]
class EventPlaceController extends AbstractController
{
    #[Route('/', name: 'app_event_place_index', methods: ['GET'])]
    public function index(EventPlaceRepository $eventPlaceRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $pagination = $paginator->paginate(
            $eventPlaceRepository->findAll(),
            $request->query->getInt('page', 1),
            2
       );
        return $this->render('event_place/index.html.twig', [
                    'event_places' => $pagination->getItems(),
            'pagination' => $pagination,
            'route' => 'app_event_index',
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
    #[Route('/search', name: 'app_event_place_search')]
    public function search(Request $request, PaginatorInterface $paginator): Response
    {
        $query = $request->query->get('query');
        
        $em = $this->getDoctrine()->getManager();
        
        $events = $em->getRepository(EventPlace::class)
            ->createQueryBuilder('e')
            ->where('e.Name LIKE :query OR e.Description LIKE :query')
            ->setParameter('query', '%'.$query.'%')
            ->getQuery();
        
    
        $pagination = $paginator->paginate(
            $events,
            $request->query->getInt('page', 1),
            1
        );
    
        return $this->render('event/index.html.twig', [
            'event_places' => $pagination->getItems(),
            'pagination' => $pagination,
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
