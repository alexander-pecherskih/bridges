<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @return Response
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->json([
            'name' => 'REST Api'
        ]);
    }
}
