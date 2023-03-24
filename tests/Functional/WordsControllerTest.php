<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Throwable;

class WordsControllerTest extends WebTestCase
{
//    Points testing

    public function testUniquePoints(): void
    {
        $testData = [
            'word' => 'coffee'
        ];

        $client = static::createClient();
        $client->request('POST', '/api/play', [], [], [], json_encode($testData));

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(200, 'OK');
        $this->assertEquals(4, $client->getResponse()->getContent());
    }

    public function testPalindromePoints(): void
    {
        $testData = [
            'word' => 'kayak'
        ];

        $client = static::createClient();
        $client->request('POST', '/api/play', [], [], [], json_encode($testData));

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(200, 'OK');
        $this->assertEquals(6, $client->getResponse()->getContent());
    }

    public function testAlmostPalindromePoints(): void
    {
        $testData = [
            'word' => 'test'
        ];

        $client = static::createClient();
        $client->request('POST', '/api/play', [], [], [], json_encode($testData));

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(200, 'OK');
        $this->assertEquals(5, $client->getResponse()->getContent());
    }

    public function testNotAWord(): void
    {
        $testData = [
            'word' => 'coffee123'
        ];

        $client = static::createClient();
        $client->request('POST', '/api/play', [], [], [], json_encode($testData));

        $this->assertResponseIsSuccessful();
        $this->assertEquals('"Word is not an english word"', $client->getResponse()->getContent());

    }

    public function testWordWithSymbol(): void
    {
        $testData = [
            'word' => 'coffee@!'
        ];

        $client = static::createClient();
        $client->request('POST', '/api/play', [], [], [], json_encode($testData));

        $this->assertResponseIsSuccessful();
        $this->assertEquals('"Word is not an english word"', $client->getResponse()->getContent());
    }

    public function testWordWithSpace(): void
    {
        $testData = [
            'word' => 'cof fee'
        ];

        $client = static::createClient();
        $client->request('POST', '/api/play', [], [], [], json_encode($testData));

        $this->assertResponseIsSuccessful();
        $this->assertEquals('"Word is not an english word"', $client->getResponse()->getContent());
    }

//    HTTP testing


    // Request body
    public function testBodyInvalidKey(): void
    {
        $testData = [
            'badKey' => 'test'
        ];

        $client = static::createClient();
        $client->request('POST', '/api/play', [], [], [], json_encode($testData));

        $this->assertResponseStatusCodeSame(500, 'Internal Server Error');
    }

    public function testBodyMultipleValues(): void
    {
        $testData = [
            'word' => 'coffee',
            'otherKey' => 'someValue'
        ];

        $client = static::createClient();
        $client->request('POST', '/api/play', [], [], [], json_encode($testData));

        $this->assertResponseStatusCodeSame(200, 'OK');
    }

    // Request methods
    public function testGETRequest(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/play');

        $this->assertResponseStatusCodeSame(405, 'Method Not Allowed');

    }

    public function testPUTRequest(): void
    {
        $client = static::createClient();
        $client->request('PUT', '/api/play');

        $this->assertResponseStatusCodeSame(405, 'Method Not Allowed');

    }

    public function testPATCHRequest(): void
    {
        $client = static::createClient();
        $client->request('PATCH', '/api/play');

        $this->assertResponseStatusCodeSame(405, 'Method Not Allowed');
    }

    public function testDELETERequest(): void
    {
        $client = static::createClient();
        $client->request('DELETE', '/api/play');

        $this->assertResponseStatusCodeSame(405, 'Method Not Allowed');
    }
}
