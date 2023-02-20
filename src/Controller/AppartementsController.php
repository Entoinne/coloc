<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppartementsController extends AbstractController
{
    #[Route('/appartements', name: 'app_appartements')]
    public function index(): Response
    {
        return $this->render('appartements/index.html.twig', [
            'controller_name' => 'AppartementsController',
        ]);
    }
}
