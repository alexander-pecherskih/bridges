<?php

declare(strict_types=1);

namespace App\Tests\Functional\OAuth;

use App\Tests\Builder\UserBuilder;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Trikoder\Bundle\OAuth2Bundle\Model\Client;
use Trikoder\Bundle\OAuth2Bundle\Model\Grant;
use Trikoder\Bundle\OAuth2Bundle\OAuth2Grants;
use Exception;

class OAuthFixture extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $user = (new UserBuilder(Uuid::uuid4(), 'OAuth', 'User'))
            ->withEmail(
                'oauth-password-user@app.test',
                '$2y$10$UroTFDYDMPs5juulB/.ntubqFRGjS26hd0DY8akpW/aUcrzMMtTBK' // 'password'
            )
            ->confirmed()
            ->build();

        $manager->persist($user);

        $client = new Client('app', 'secret');
        $client->setGrants(new Grant(OAuth2Grants::PASSWORD));

        $manager->persist($client);

        $manager->flush();
    }
}
