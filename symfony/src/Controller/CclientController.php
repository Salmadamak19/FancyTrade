<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CclientController extends AbstractController
{
    #[Route('/client', name: 'app_client')]
        public function indexClient(): Response
        {
            return $this->render('Cclient/index.html.twig', [
                
            ]);
        }
}
