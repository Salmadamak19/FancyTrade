<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Entity\ReclamationCategory;
use App\Entity\Event;
use App\Entity\Post;
use App\Entity\Publication;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
#[Route('/reclamation')]
class ReclamationController extends AbstractController
{
    #[Route('/', name: 'app_reclamation_index', methods: ['GET'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function index(ReclamationRepository $reclamationRepository): Response
    {
        return $this->render('reclamation/index.html.twig', [
            'reclamations' => $reclamationRepository->findAll(),
        ]);
    }

   #[Route('/pdf', name: 'PDF_Reclamation', methods: ['GET'])]
   #[IsGranted('IS_AUTHENTICATED_FULLY')]
   public function pdf(ReclamationRepository $ReclamationRepository)
   {
       $pdfOptions = new Options();
       $pdfOptions->set('defaultFont', 'Arial');
       $dompdf = new Dompdf($pdfOptions);
       $html = $this->renderView('reclamation/pdf.html.twig', [
           'reclamations' => $ReclamationRepository->findAll(),
       ]);
       $dompdf->loadHtml($html);
       $dompdf->setPaper('A4', 'portrait');
       $dompdf->render();
       $dompdf->stream("ListeDesreclmations.pdf", [
           "reclamations" => true
       ]);
   }

    #[Route('/pdf1', name: 'pdf1')]
    public function pdf1(reclamationRepository $reclamationRepository)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('reclamation/pdf.html.twig', [
            'reclamations' => $reclamationRepository->findAll(),
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);
    }
    #[Route('/autocreaterec1', name: 'create_reclamation_event', methods: ['GET', 'POST'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function create_reclamation_event(Request $request): Response
    {
        $category = $this->getDoctrine()->getRepository(ReclamationCategory::class)->find(3);
        
        // Create a new instance of the Reclamation entity and set its attributes
        $reclamation = new Reclamation();
        
        // Get the event id sent from the form and use it to set the message of the new Reclamation entity
        $eventId = $request->request->get('event');
        $event = $this->getDoctrine()->getRepository(Event::class)->find($eventId);
        $reclamation->setMessage('You reported ' . $event->getName());
        
        $reclamation->setCreatedAt(new \DateTimeImmutable());
        $reclamation->setStatus(false);
        $reclamation->setCategory($category);
        
        // Set the currently logged in user as the user of the reclamation
        $user = $this->getUser();
        $reclamation->setUser($user);
        
        // Persist the new reclamation in the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($reclamation);
        $entityManager->flush();
        
        // Redirect to the previous page or to a success page
        return $this->redirect('http://localhost/fancytrade/public/index.php/event/' . $event->getId() . '/show');
    }
    #[Route('/autocreaterec2', name: 'create_reclamation_post', methods: ['GET', 'POST'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function create_reclamation_post(Request $request): Response
    {
        $category = $this->getDoctrine()->getRepository(ReclamationCategory::class)->find(2);
        
        // Create a new instance of the Reclamation entity and set its attributes
        $reclamation = new Reclamation();
        
        // Get the event id sent from the form and use it to set the message of the new Reclamation entity
        $eventId = $request->request->get('post');
        $event = $this->getDoctrine()->getRepository(Publication::class)->find($eventId);
        $reclamation->setMessage('You reported post id :' . $event->getId());
        
        $reclamation->setCreatedAt(new \DateTimeImmutable());
        $reclamation->setStatus(false);
        $reclamation->setCategory($category);
        
        // Set the currently logged in user as the user of the reclamation
        $user = $this->getUser();
        $reclamation->setUser($user);
        
        // Persist the new reclamation in the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($reclamation);
        $entityManager->flush();
        
        // Redirect to the previous page or to a success page
        return $this->redirect('http://localhost/fancytrade/public/index.php/afficherpublication');
    }
    #[Route('/autocreaterec3', name: 'create_reclamation_forum', methods: ['GET', 'POST'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function create_reclamation_forum(Request $request): Response
    {
        $category = $this->getDoctrine()->getRepository(ReclamationCategory::class)->find(4);
        
        // Create a new instance of the Reclamation entity and set its attributes
        $reclamation = new Reclamation();
        
        // Get the event id sent from the form and use it to set the message of the new Reclamation entity
        $eventId = $request->request->get('forum');
        $event = $this->getDoctrine()->getRepository(Post::class)->find($eventId);
        $reclamation->setMessage('You reported forum post id :' . $event->getId());
        
        $reclamation->setCreatedAt(new \DateTimeImmutable());
        $reclamation->setStatus(false);
        $reclamation->setCategory($category);
        
        // Set the currently logged in user as the user of the reclamation
        $user = $this->getUser();
        $reclamation->setUser($user);
        
        // Persist the new reclamation in the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($reclamation);
        $entityManager->flush();
        
        // Redirect to the previous page or to a success page
        return $this->redirect('http://localhost/fancytrade/public/index.php/post/front');
    }
    
    #[Route('/new', name: 'app_reclamation_new', methods: ['GET', 'POST'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function new(Request $request, ReclamationRepository $reclamationRepository, SluggerInterface $slugger,TokenStorageInterface $tokenStorage): Response
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);
        $user = $tokenStorage->getToken()->getUser();
        if ($form->isSubmitted() && $form->isValid()) {
            $reclamation->setCreatedAt(new \DateTimeImmutable());
            $reclamation->setStatus(0);
            $reclamation->setUser($user);
            $image = $form->get('image')->getData();
            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();
                try {
                    $image->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $reclamation->setImage($newFilename);
            }
            $reclamationRepository->sms();
            $reclamationRepository->save($reclamation, true);

            return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reclamation/new.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reclamation_show', methods: ['GET'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function show(Reclamation $reclamation): Response
    {
        return $this->render('reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reclamation_edit', methods: ['GET', 'POST'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function edit(Request $request, Reclamation $reclamation, ReclamationRepository $reclamationRepository): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reclamationRepository->save($reclamation, true);

            return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reclamation/edit.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reclamation_delete', methods: ['POST'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function delete(Request $request, Reclamation $reclamation, ReclamationRepository $reclamationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getId(), $request->request->get('_token'))) {
            $reclamationRepository->remove($reclamation, true);
        }

        return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
    }
   
}
