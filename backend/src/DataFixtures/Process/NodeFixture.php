<?php

namespace App\DataFixtures\Process;

use App\DataFixtures\StuffFixture;
use App\Model\Process\Entity\Node\Node;
use App\Model\Process\Entity\Node\Position;
use App\Model\Process\Entity\Node\Title;
use App\Model\Process\Entity\Process\Process;
use App\Model\Process\Entity\Process\ProcessRepositoryInterface;
use App\Model\Stuff\Entity\Department\Department;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Ramsey\Uuid\Uuid;
use DateTimeImmutable;

class NodeFixture extends Fixture implements DependentFixtureInterface
{
    public ProcessRepositoryInterface $processRepository;

    public function __construct(ProcessRepositoryInterface $processRepository)
    {
        $this->processRepository = $processRepository;
    }

    /**
     * @param ObjectManager $manager
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        /** @var Process $process */
        $process = $this->getReference(ProcessFixture::PROCESS1_REFERENCE);
        /** @var Department $department1 */
        $department1 = $this->getReference(StuffFixture::DEPARTMENT1_REFERENCE);
        /** @var Department $department2 */
        $department2 = $this->getReference(StuffFixture::DEPARTMENT2_REFERENCE);
        /** @var Department $department3 */
        $department3 = $this->getReference(StuffFixture::DEPARTMENT3_REFERENCE);

        $node1 = new Node(
            Uuid::uuid4(),
            new DateTimeImmutable(),
            'Node 1',
            $process,
            new Position(150, 70)
        );
        $node1->assignDepartment($department1);

        $node2 = new Node(
            Uuid::uuid4(),
            new DateTimeImmutable(),
            'Node 2',
            $process,
            new Position(200, 350)
        );
        $node2->assignDepartment($department2);

        $node3 = new Node(
            Uuid::uuid4(),
            new DateTimeImmutable(),
            'Node 3',
            $process,
            new Position(140, 400)
        );
        $node3->assignDepartment($department3);

        $node4 = new Node(
            Uuid::uuid4(),
            new DateTimeImmutable(),
            'Node 4',
            $process,
            new Position(110, 740)
        );
        $node4->assignDepartment($department2);

        $node5 = new Node(
            Uuid::uuid4(),
            new DateTimeImmutable(),
            'Node 5',
            $process,
            new Position(420, 680)
        );

        $process->setStartNode($node1);

        $process->addRoute($node1, $node2);
        $process->addRoute($node2, $node3);
        $process->addRoute($node2, $node5);
        $process->addRoute($node3, $node4);
        $process->addRoute($node4, $node5);

        $manager->persist($node1);
        $manager->persist($node2);
        $manager->persist($node3);
        $manager->persist($node4);
        $manager->persist($node5);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProcessFixture::class
        ];
    }
}
