<?php


namespace App\Tests\Builder;


use App\Entity\Node\Node;
use App\Entity\Node\Position;
use App\Entity\Process;
use DateTimeImmutable;
use Exception;

class NodeBuilder
{
    private $id;
    private $title;
    private $created;
//    private $process;
//    private $position;

    public function __construct()
    {
        $this->id = 1;
        $this->title = 'Node';
        $this->created = new DateTimeImmutable();

//        $this->process = (new ProcessBuilder())->build(
//            (new UserBuilder())->build()
//        );
//
//        $this->position = new Position(100, 100);
    }

    /**
     * @param Process $process
     * @param Position $position
     * @return Node
     * @throws Exception
     */
    public function build(Process $process, Position $position): Node
    {
        return new Node($this->id, $this->title, $this->created, $process, $position);
    }
}