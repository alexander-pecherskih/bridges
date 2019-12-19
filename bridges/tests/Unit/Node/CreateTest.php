<?php


namespace App\Tests\Entity\Node;


use App\Entity\Node\Node;
use App\Entity\Node\Position;
use App\Tests\Builder\ProcessBuilder;
use App\Tests\Builder\UserBuilder;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class CreateTest /*extends TestCase*/
{
    public function testSuccess()
    {
        $id = 1;
        $title = 'Node';
        $process = (new ProcessBuilder())->build((new UserBuilder())->build());

        $node = new Node($id, $title, new DateTimeImmutable(), $process, new Position(100, 100));

        self::assertEquals($id, $node->getId());
        self::assertEquals($title, $node->getTitle());
    }
}