<?php

declare(strict_types=1);

namespace App\Tests\Functional\Api;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Trikoder\Bundle\OAuth2Bundle\Model\Client;

/* extends Fixture*/
class ClientFixture
{
    public const REFERENCE_CLIENT = 'test_oauth_client';

    public function load(ObjectManager $manager): void
    {
        $client = new Client('test', 'secret');
        $manager->persist($client);

        $this->setReference(self::REFERENCE_CLIENT, $client);

        $manager->flush();
    }
}
