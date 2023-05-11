<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use App\Repository\ReclamationCategoryRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
#[Route('/reclamation')]
class ReclamationController extends AbstractController
{
    

    #[Route('/', name: 'app_reclamation_index', methods: ['GET'])]
    public function index(ReclamationRepository $reclamationRepository): Response
    {
        return $this->render('reclamation/index.html.twig', [
            'reclamations' => $reclamationRepository->findAll(),
        ]);
    }

    #[Route("/All", name: "list", methods: ['GET','POST'])]
    //* Dans cette fonction, nous utilisons les services NormlizeInterface et StudentRepository, 
    //* avec la méthode d'injection de dépendances.
    public function getStudents(ReclamationRepository $repo, SerializerInterface $serializer)
    {
        $recs = $repo->findAll();

        $json = $serializer->serialize($recs, 'json', ['groups' => "reclamations"]);

        //* Nous renvoyons une réponse Http qui prend en paramètre un tableau en format JSON
        return new Response($json);
    }


    #[Route("/newJson", name: "addrecJSON", methods: ['GET','POST'])]
    public function addStudentJSON(ReclamationRepository $reclamationRepository,ReclamationCategoryRepository $rc ,UserRepository $repo,Request $req,   NormalizerInterface $Normalizer)
    {

        $em = $this->getDoctrine()->getManager();
        $student = new Reclamation();
        $student->setUser($repo->find(1));
        $student->setCategory($rc->find( $req->get('category_id')));
        $student->setMessage($req->get('message'));
        $student->setStatus($req->get('status'));
        $em->persist($student);
        $em->flush();
        //$reclamationRepository->sms();

        $jsonContent = $Normalizer->normalize($student, 'json', ['groups' => 'reclamations']);
        return new Response(json_encode($jsonContent));
    }

    

   #[Route('/pdf', name: 'PDF_Reclamation', methods: ['GET'])]
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

    #[Route('/new', name: 'app_reclamation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ReclamationRepository $reclamationRepository, SluggerInterface $slugger): Response
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reclamation->setCreatedAt(new \DateTimeImmutable());
            $reclamation->setStatus(0);
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
    public function show(Reclamation $reclamation): Response
    {
        return $this->render('reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }
    #[Route("/{id}/updateJSON", name: "updaterecJSON")]
    public function updateStudentJSON(ReclamationRepository $re,ReclamationCategoryRepository $rc ,UserRepository $repo,Request $req, $id, NormalizerInterface $Normalizer)
    {
        $em = $this->getDoctrine()->getManager();
        $student = $re->find($id);
        $student->setUser($repo->find(1));
        $student->setCategory($rc->find( $req->get('category_id')));
        $student->setMessage($req->get('message'));
        $student->setStatus($req->get('status'));

        $em->flush();

        $jsonContent = $Normalizer->normalize($student, 'json', ['groups' => 'reclamations']);
        return new Response("reclamation updated successfully " . json_encode($jsonContent));
    }
    #[Route("/{id}/del", name: "deleteStudentJSON")]
    public function deleteStudentJSON(ReclamationRepository $re,Request $req, $id, NormalizerInterface $Normalizer)
    {

        $em = $this->getDoctrine()->getManager();
        $student = $re->find($id);
        $em->remove($student);
        $em->flush();
        $jsonContent = $Normalizer->normalize($student, 'json', ['groups' => 'reclamations']);
        return new Response("Reclamations deleted successfully " . json_encode($jsonContent));
    }

    #[Route('/{id}/edit', name: 'app_reclamation_edit', methods: ['GET', 'POST'])]
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
    public function delete(Request $request, Reclamation $reclamation, ReclamationRepository $reclamationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getId(), $request->request->get('_token'))) {
            $reclamationRepository->remove($reclamation, true);
        }

        return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
    }
   
}
