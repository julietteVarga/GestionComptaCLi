<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConsultantControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/consultant/1/show');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('tr', 'Sexe');
    }
}

