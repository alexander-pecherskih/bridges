<?php

declare(strict_types=1);

namespace App\Controller\Stuff;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CompanyController
 * @package App\Controller
 *
 * @Route("/stuff/companies", name="stuff")
 */
class CompanyController extends AbstractController
{
    /**
     * @Route("", name="stuff.companies", methods={"GET"})
     * @param Request $request
     *
     */
    public function index(Request $request)
    {
    }

    /**
     * @Route("/{id}", name="stuff.companies", methods={"GET"})
     * @param int $id
     */
    public function show(int $id)
    {
    }

    public function post(Request $request)
    {
    }

    public function patch(Request $request)
    {
    }

    public function delete()
    {
    }
}
