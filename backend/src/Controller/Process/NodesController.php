<?php

namespace App\Controller\Process;

use App\Model\Process\Entity\Process;
use App\ReadModel\Process\NodeFetcher;
use App\ReadModel\Process\RouteFetcher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NodesController extends AbstractController
{
    /**
     * @param Process\Process $process
     * @param NodeFetcher $fetcher
     * @return Response
     *
     * @Route("/process/{id}/nodes", name="process.process.nodes", methods={"GET"})
     */
    public function nodes(Process\Process $process, NodeFetcher $fetcher): Response
    {
        $items = $fetcher->findAllByProcess($process->getId());

//        return $this->json($items);

        return $this->json(array_map(static function (array $item) {
            return [
                'id' => $item['id'],
                'title' => $item['title'],
                'created' => $item['created'],
                'position' => [
                    'top' => $item['position_top'],
                    'left' => $item['position_left'],
                ]
            ];
        }, $items));
    }

    /**
     * @param Process\Process $process
     * @param RouteFetcher $fetcher
     * @return Response
     *
     * @Route("/process/{id}/routes", name="process.process.routes", methods={"GET"})
     */
    public function routes(Process\Process $process, RouteFetcher $fetcher): Response
    {
        $items = $fetcher->findAllByProcess($process->getId());

        return $this->json($items);
    }
}
