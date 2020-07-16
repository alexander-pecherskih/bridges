<?php

namespace App\Controller\Process;

use App\Model\Process\Entity\Process;
use App\Model\Process\UseCase\Node\Move;
use App\ReadModel\Process\NodeFetcher;
use App\ReadModel\Process\RouteFetcher;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class NodesController extends AbstractController
{
    private $serializer;
    private $validator;

    public function __construct(SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

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
        $items = $fetcher->findAllByProcessId($process->getId());

        return $this->json($items);
    }

    /**
     * @Route("/node/{id}/move", name="node.move", methods={"POST"})
     *
     * @param string $id
     * @param Request $request
     * @param Move\Handler $handler
     * @return Response
     */
    public function move(string $id, Request $request, Move\Handler $handler): Response
    {
        /** @var Move\Command $command */
        $command = $this->serializer->deserialize(
            $request->getContent(),
            Move\Command::class,
            'json',
            [
                'object_to_populate' => new Move\Command(Uuid::fromString($id)),
                'ignored_attributes' => ['id'],
            ]
        );

        $violations = $this->validator->validate($command);

        if (count($violations)) {
            $json = $this->serializer->serialize($violations, 'json');
            return new JsonResponse($json, 400, [], true);
        }

        $handler->handle($command);

        return $this->json([]);
    }
}
