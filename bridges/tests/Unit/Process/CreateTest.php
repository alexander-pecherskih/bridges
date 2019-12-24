<?php


namespace App\Tests\Entity\Process;


use App\Model\Process\Entity\Process\Process;
use App\Model\Process\Entity\Process\Title;
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
        $user = (new UserBuilder())->withEmail()->build();

        $process = new Process(
            $id = Uuid::uuid4(),
            $now = new DateTimeImmutable(),
            new Title($title = 'Process'),
            $user
        );

        self::assertEquals($id, $process->getId());
        self::assertEquals($now, $process->getCreated());
        self::assertEquals($title, $process->getTitle()->getValue());
        self::assertEquals($user, $process->getOwner());
        self::assertNull($process->getStartNode());
    }
}