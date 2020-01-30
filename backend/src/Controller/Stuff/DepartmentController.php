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
 * @Route("/stuff/departments")
 */
class DepartmentController extends AbstractController
{
    /**
     * @Route("", name="stuff.departments", methods={"GET"})
     * @param Request $request
     *
     */
    public function index(Request $request)
    {
    }

    /**
     * @Route("/{id}", name="stuff.departments.", methods={"GET"})
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
