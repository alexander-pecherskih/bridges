<?php

namespace App\Repository;

use App\Model\EntityNotFoundException;
use App\Model\Process\Entity\Node\Node;
use App\Model\Process\Entity\Node\NodeRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class NodeRepository implements NodeRepositoryInterface
{
    private $em;
    private $repo;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repo = $em->getRepository(Node::class);
    }

    /**
     * @return UuidInterface
     * @throws Exception
     */
    public static function nextId(): UuidInterface
    {
        return Uuid::uuid4();
    }

    public function add(Node $node): void
    {
        $this->em->persist($node);
    }

    /**
     * @param UuidInterface $id
     * @return Node
     * @throws EntityNotFoundException
     */
    public function get(UuidInterface $id): Node
    {
        /** @var Node $node */
        if (!$node = $this->repo->find($id)) {
            throw new EntityNotFoundException('Node not found');
        }

        return $node;
    }

    public function remove(Node $node): void
    {
        $this->em->remove($node);
    }
}
