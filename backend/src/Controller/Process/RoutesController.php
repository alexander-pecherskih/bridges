<?php

namespace App\Controller\Process;

use App\ReadModel\Process\RouteFetcher;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RoutesController extends AbstractController
{
    /**
     * @param string $processId
     * @param RouteFetcher $fetcher
     * @return Response
     *
     * @Route("/routes/{processId}", name="routes.index", methods={"GET"})
     */
    public function index(string $processId, RouteFetcher $fetcher): Response
    {
        return $this->json($fetcher->findAllByProcessId(Uuid::fromString($processId)));
    }
}
