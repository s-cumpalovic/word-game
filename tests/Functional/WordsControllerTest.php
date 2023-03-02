<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class WordsControllerTest extends WebTestCase
{
    public function testPlayEndpoint()
    {
        $client = static::createClient();

        // Expects good response

        $goodTestData = [
            'name' => 'Ivana',
            'word' => 'coffee'
        ];
        $client->request('POST', '/api/word-game', [], [], [], json_encode($goodTestData));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(7, json_decode($client->getResponse()->getContent())->message);

        // Expects bad response 
        $badTestData = [
            'name' => 'Ivana',
            'word' => 'coffee13213ds'
        ];
        $client->request('POST', '/api/word-game', [], [], [], json_encode($badTestData));
        $this->assertEquals(400, $client->getREsponse()->getStatusCode());
    }
}
