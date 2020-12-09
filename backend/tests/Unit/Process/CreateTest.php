<?php

namespace App\Tests\Entity\Process;

use App\Model\Process\Entity\Process\Process;
use App\Tests\Builder\NodeBuilder;
use App\Tests\Builder\Stuff\EmployeeBuilder;
use App\Tests\Builder\UserBuilder;
use DateTimeImmutable;
use Exception;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class CreateTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testSuccess(): void
    {
        $owner = (new EmployeeBuilder())->build();

        $process = new Process(
            $id = Uuid::uuid4(),
            $now = new DateTimeImmutable(),
            $owner,
            $title = 'Process'
        );

        self::assertEquals($id, $process->getId());
        self::assertEquals($now, $process->getCreated());
        self::assertEquals($title, $process->getTitle());
        self::assertEquals($owner, $process->getOwner());
        self::assertNull($process->getStartNodeId());


    }
}
