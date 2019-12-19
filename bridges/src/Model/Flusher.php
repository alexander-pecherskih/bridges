<?php

namespace App\Model;

use Doctrine\ORM\EntityManagerInterface;
//use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class Flusher
{
    private $em;
//    private $dispatcher;

    public function __construct(EntityManagerInterface $em/*, EventDispatcherInterface $dispatcher*/)
    {
        $this->em = $em;
//        $this->dispatcher = $dispatcher;
    }

    public function flush(/*AggregateRoot ...$roots*/): void
    {
        $this->em->flush();

//        foreach ($roots as $root) {
//            $this->dispatcher->dispatch($root->releaseEvents());
//        }
    }
}