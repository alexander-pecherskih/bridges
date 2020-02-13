<?php

namespace App\Controller\Process;

use App\Model\Process\Entity\Process;
use App\ReadModel\Process\ProcessFetcher;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProcessController extends AbstractController
{
    private SerializerInterface $serializer;
    private ValidatorInterface $validator;

    public function __construct(SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    /**
     * @param ProcessFetcher $fetcher
     * @return Response
     *
     * @Route("/process", name="process.index", methods={"GET"})
     */
    public function index(ProcessFetcher $fetcher): Response
    {
        $items = $fetcher->findAll();

        return $this->json(array_map(static function (array $item) {
            return $item;
        }, $items));
    }

    /**
     * @param Process\Process $process
     * @return Response
     * @throws Exception
     *
     * @Route("/process/{id}", name="process.process", methods={"GET"})
     */
    public function view(Process\Process $process): Response
    {
        return $this->json($this->serializer->normalize($process, 'json', [
            'groups' => 'process-view',
        ]));
//        return $this->json($process);
//        return $this->json([
//            'id' => $process->getId(),
//            'title' => $process->getTitle(),
//            'routes' => $process->getRoutes()
//            'nodes' => $process->getNodes(),
//        ]);
    }
}
