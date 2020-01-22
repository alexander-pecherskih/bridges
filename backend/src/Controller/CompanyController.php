<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CompanyController extends AbstractController
{
    /**
     * @Route("/work/projects", name="work.projects", methods={"GET"})
     * @param Request $request
     *
     */
    public function index(Request $request)
    {
    }
}
