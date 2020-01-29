<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeTest extends WebTestCase
{
    public function testGet(): void
    {
        $client = static::createClient();

        $client->request('GET', '/');

        self::assertEquals(200, $client->getResponse()->getStatusCode());
        self::assertJson($content = $client->getResponse()->getContent());

        $data = json_decode($content, true);

        self::assertEquals([
            'name' => 'REST Api',
        ], $data);
    }
}
