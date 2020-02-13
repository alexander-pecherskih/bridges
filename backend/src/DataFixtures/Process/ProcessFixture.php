<?php

namespace App\DataFixtures\Process;

use App\DataFixtures\StuffFixture;
use App\Model\Process\Entity\Process\Process;
use App\Model\Stuff\Entity\Employee\Employee;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Ramsey\Uuid\Uuid;

class ProcessFixture extends Fixture implements DependentFixtureInterface
{
    public const PROCESS1_REFERENCE = 'process1';
    public const PROCESS2_REFERENCE = 'process2';

    /**
     * @param ObjectManager $manager
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {

        /** @var Employee $owner1 */
        $owner1 = $this->getReference(StuffFixture::EMPLOYEE1_REFERENCE);
        /** @var Employee $owner2 */
        $owner2 = $this->getReference(StuffFixture::EMPLOYEE2_REFERENCE);

        $process1 = new Process(
            Uuid::uuid4(),
            new DateTimeImmutable(),
            $owner1,
            'Process 1'
        );
        $this->addReference(self::PROCESS1_REFERENCE, $process1);


        $process2 = new Process(
            Uuid::uuid4(),
            new DateTimeImmutable(),
            $owner2,
            'Process 2'
        );
        $this->addReference(self::PROCESS2_REFERENCE, $process2);

        $manager->persist($process1);
        $manager->persist($process2);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            StuffFixture::class
        ];
    }
}
