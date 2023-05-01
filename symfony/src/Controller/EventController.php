<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Reclamation;
use App\Form\ReclamationType;
use Doctrine\ORM\Mapping\Id;

#[Route('/event')]
class EventController extends AbstractController
{
    #[Route('/', name: 'app_event_index', methods: ['GET'])]
    public function index(EventRepository $eventRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $pagination = $paginator->paginate(
            $eventRepository->findAll(),
            $request->query->getInt('page', 1),
            2
       );
       
       return $this->render('event/index.html.twig', [
        'events' => $pagination->getItems(),
            'pagination' => $pagination,
            'route' => 'app_event_index',
       ]);
    }
    #[Route('/front', name: 'app_event_frontindex', methods: ['GET'])]
    public function frontindex(EventRepository $eventRepository,PaginatorInterface $paginator, Request $request): Response
    {
        $pagination = $paginator->paginate(
            $eventRepository->findAll(),
            $request->query->getInt('page', 1),
            1
       );
        return $this->render('event/frontindex.html.twig', [
            'events' => $pagination->getItems(),
            'pagination' => $pagination,
            'route' => 'app_event_index',
        ]);
    }
    #[Route('/new', name: 'app_event_new', methods: ['GET', 'POST'])]

public function new(Request $request, EventRepository $eventRepository, SluggerInterface $slugger): Response
{
    $event = new Event();
    $form = $this->createForm(EventType::class, $event);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $eventRepository->save($event, true);

        return $this->redirectToRoute('app_event_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->renderForm('event/new.html.twig', [
        'event' => $event,
        'form' => $form,
    ]);
}
#[Route('/search', name: 'app_event_search')]
public function search(Request $request, PaginatorInterface $paginator): Response
{
    $query = $request->query->get('query');
    
    $em = $this->getDoctrine()->getManager();
    
    $events = $em->getRepository(Event::class)
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
        'events' => $pagination->getItems(),
        'pagination' => $pagination,
    ]);
}


    #[Route('/{id}', name: 'app_event_show', methods: ['GET'])]
    public function show(Event $event): Response
    {
        return $this->render('event/show.html.twig', [
            'event' => $event,
        ]);
    }
    #[Route('/{id}/show', name: 'app_event_frontshow', methods: ['GET'])]
    public function frontshow(Event $event): Response
    {
        return $this->render('event/frontshow.html.twig', [
            'event' => $event,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_event_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Event $event, EventRepository $eventRepository, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('Image')->getData();
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();
    
                try {
                    $imageFile->move(
                        $this->getParameter('event_images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    throw new \Exception("Error uploading image file");
                }
    
                $event->setImage($newFilename);
            }
    
            $eventRepository->save($event, true);
    
            return $this->redirectToRoute('app_event_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->renderForm('event/edit.html.twig', [
            'event' => $event,
            'form' => $form,
        ]);
    }
    

    #[Route('/{id}', name: 'app_event_delete', methods: ['POST'])]
    public function delete(Request $request, Event $event, EventRepository $eventRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$event->getId(), $request->request->get('_token'))) {
            $eventRepository->remove($event, true);
        }

        return $this->redirectToRoute('app_event_index', [], Response::HTTP_SEE_OTHER);
    }
   public function currentdt(){
        $currentDateTime = new \DateTime();
$formattedDateTime = $currentDateTime->format('Y-m-d\TH:i:s');
return $formattedDateTime;
    }
}
