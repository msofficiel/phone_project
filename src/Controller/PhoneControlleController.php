<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PhoneControlleController extends AbstractController
{
    #[Route('/phone/controlle', name: 'app_phone_controlle')]
    public function index(): Response
    {
        return $this->render('phone_controlle/index.html.twig', [
            'controller_name' => 'PhoneControlleController',
        ]);
    }
}
