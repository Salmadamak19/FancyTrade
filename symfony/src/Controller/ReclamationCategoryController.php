<?php

namespace App\Controller;

use App\Entity\ReclamationCategory;
use App\Form\ReclamationCategoryType;
use App\Repository\ReclamationCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route; 

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/category')]
class ReclamationCategoryController extends AbstractController
{
 
    #[Route('/', name: 'app_reclamation_category_index', methods: ['GET'])]
    public function index(ReclamationCategoryRepository $reclamationCategoryRepository): Response
    {
        return $this->render('reclamation_category/index.html.twig', [
            'reclamation_categories' => $reclamationCategoryRepository->findAll(),
        ]);
    }
    #[Route("/Allcat", name: "listcat", methods: ['GET','POST'])]
    //* Dans cette fonction, nous utilisons les services NormlizeInterface et StudentRepository, 
    //* avec la méthode d'injection de dépendances.
    public function getStudents(ReclamationCategoryRepository $repo, SerializerInterface $serializer)
    {
        $recs = $repo->findAll();

        $json = $serializer->serialize($recs, 'json', ['groups' => "catreclamations"]);

        //* Nous renvoyons une réponse Http qui prend en paramètre un tableau en format JSON
        return new Response($json);
    }

    #[Route("/catJson", name: "addcatJSON", methods: ['GET','POST'])]
    public function addStudentJSON(ReclamationCategoryRepository $rc ,Request $req,   NormalizerInterface $Normalizer)
    {

        $em = $this->getDoctrine()->getManager();
        $student = new ReclamationCategory();
        $student->setNom($req->get('nom'));

        $em->persist($student);
        $em->flush();
        

        $jsonContent = $Normalizer->normalize($student, 'json', ['groups' => 'catreclamations']);
        return new Response(json_encode($jsonContent));
    }


    #[Route('/new', name: 'app_reclamation_category_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ReclamationCategoryRepository $reclamationCategoryRepository): Response
    {
        $reclamationCategory = new ReclamationCategory();
        $form = $this->createForm(ReclamationCategoryType::class, $reclamationCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reclamationCategoryRepository->save($reclamationCategory, true);

            return $this->redirectToRoute('app_reclamation_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reclamation_category/new.html.twig', [
            'reclamation_category' => $reclamationCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reclamation_category_show', methods: ['GET'])]
    public function show(ReclamationCategory $reclamationCategory): Response
    {
        return $this->render('reclamation_category/show.html.twig', [
            'reclamation_category' => $reclamationCategory,
        ]);
    }
    #[Route("/updateJSON/{id}/", name: "upJSON" , methods: ['POST'])]
    public function updateStudentJSON(ReclamationCategoryRepository $rc ,Request $req, $id, NormalizerInterface $Normalizer)
    {
        $em = $this->getDoctrine()->getManager();
        $student = $rc->find($id);
        $student->setNom( $req->get('nom'));

        $em->flush();

        $jsonContent = $Normalizer->normalize($student, 'json', ['groups' => 'catreclamations']);
        return new Response("reclamation  Category updated successfully " . json_encode($jsonContent));
    }



    #[Route("/{id}/del", name: "deleteJSON" , methods: ['GET', 'POST'])]
    public function deleteJSON(ReclamationCategoryRepository $re,Request $req, $id, NormalizerInterface $Normalizer)
    {

        $em = $this->getDoctrine()->getManager();
        $student = $re->find($id);
        $em->remove($student);
        $em->flush();
        $jsonContent = $Normalizer->normalize($student, 'json', ['groups' => 'catreclamations']);
        return new Response("Reclamations Category deleted successfully " . json_encode($jsonContent));
    }
   

    #[Route('/{id}/edit', name: 'app_reclamation_category_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ReclamationCategory $reclamationCategory, ReclamationCategoryRepository $reclamationCategoryRepository): Response
    {
        $form = $this->createForm(ReclamationCategoryType::class, $reclamationCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reclamationCategoryRepository->save($reclamationCategory, true);

            return $this->redirectToRoute('app_reclamation_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reclamation_category/edit.html.twig', [
            'reclamation_category' => $reclamationCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reclamation_category_delete', methods: ['POST'])]
    public function delete(Request $request, ReclamationCategory $reclamationCategory, ReclamationCategoryRepository $reclamationCategoryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamationCategory->getId(), $request->request->get('_token'))) {
            $reclamationCategoryRepository->remove($reclamationCategory, true);
        }

        return $this->redirectToRoute('app_reclamation_category_index', [], Response::HTTP_SEE_OTHER);
    }
}
