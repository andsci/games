<?php

namespace MI\AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConsoleControllerTest extends WebTestCase
{
    public function testConsole()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/console/{type}');
    }

}
