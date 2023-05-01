<?php

namespace App\Controller;

use App\Entity\ReclamationCategory;
use App\Form\ReclamationCategoryType;
use App\Repository\ReclamationCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
