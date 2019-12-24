<?php


namespace App\Tests\Entity\Node;


use App\Model\Node\Entity\Node\Id;
use App\Model\Node\Entity\Node\Node;
use App\Model\Node\Entity\Node\Position;
use App\Tests\Builder\ProcessBuilder;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class CreateTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testSuccess(): void
    {
        $process = (new ProcessBuilder())->build();

        $node = new Node(
            $id = Uuid::uuid4(),
            $now = new DateTimeImmutable(),
            $title = 'Node',
            $process,
            new Position($top = 100, $left = 100)
        );

        self::assertEquals($id, $node->getId());
        self::assertEquals($now, $node->getCreated());
        self::assertEquals($title, $node->getTitle());
        self::assertEquals($process, $node->getProcess());
        self::assertEquals($top, $node->getPosition()->getTop());
        self::assertEquals($left, $node->getPosition()->getLeft());
    }
}