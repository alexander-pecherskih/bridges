<?php


namespace App\Tests\Entity\Process;


use App\Entity\Process;
use App\Tests\Builder\UserBuilder;
use PHPUnit\Framework\TestCase;

class CreateTest /*extends TestCase*/
{
    public function testSuccess(): void
    {
        $id = 1;
        $title = 'Process';
        $user = (new UserBuilder())->build();

        $process = new Process($id, $title, $user);

        self::assertEquals($id, $process->getId());
        self::assertEquals($title, $process->getTitle());
        self::assertEquals($user, $process->getOwner());

//        self::assertNull($task->getParent());
//        self::assertNull($task->getPlanDate());
//        self::assertNull($task->getStartDate());
//        self::assertNull($task->getEndDate());
//
//        self::assertTrue($task->isNew());
    }
}