<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WordsControllerTest extends WebTestCase
{
//    public function testUniquePoints(): void
//    {
//        $testData = [
//            'word' => 'coffee'
//        ];
//
//        $client = static::createClient();
//        $client->request('POST', '/api/play', [], [], [], json_encode($testData));
//
//        $this->assertResponseStatusCodeSame(200, 'OK');
//        $this->assertEquals(4, $client->getResponse()->getContent());
//    }
//
//    public function testPalindromePoints(): void
//    {
//        $testData = [
//            'word' => 'kayak'
//        ];
//
//        $client = static::createClient();
//        $client->request('POST', '/api/play', [], [], [], json_encode($testData));
//
//        $this->assertResponseStatusCodeSame(200, 'OK');
//        $this->assertEquals(6, $client->getResponse()->getContent());
//    }
//
//    public function testAlmostPalindromePoints(): void
//    {
//        $testData = [
//            'word' => 'test'
//        ];
//
//        $client = static::createClient();
//        $client->request('POST', '/api/play', [], [], [], json_encode($testData));
//
//        $this->assertResponseStatusCodeSame(200, 'OK');
//        $this->assertEquals(5, $client->getResponse()->getContent());
//    }
//
//    public function testNotEnglishWord(): void
//    {
//        $testData = [
//            'word' => 'notenglish'
//        ];
//
//        $client = static::createClient();
//        $client->request('POST', '/api/play', [], [], [], json_encode($testData));
//
//        $this->assertResponseStatusCodeSame(400);
//        $this->assertEquals('{"message":"Word is not an english word."}', $client->getResponse()->getContent());
//    }
//
//    public function testNotAWord(): void
//    {
//        $testData = [
//            'word' => 'coffee123'
//        ];
//
//        $client = static::createClient();
//        $client->request('POST', '/api/play', [], [], [], json_encode($testData));
//
//        $this->assertResponseStatusCodeSame(400);
//        $this->assertEquals('{"message":"The word must consist of letters only."}', $client->getResponse()->getContent());
//    }
//
//    public function testWordWithSymbol(): void
//    {
//        $testData = [
//            'word' => 'coffee@!'
//        ];
//
//        $client = static::createClient();
//        $client->request('POST', '/api/play', [], [], [], json_encode($testData));
//
//        $this->assertResponseStatusCodeSame(400);
//        $this->assertEquals('{"message":"The word must consist of letters only."}', $client->getResponse()->getContent());
//    }
//
//    public function testWordWithSpace(): void
//    {
//        $testData = [
//            'word' => 'cof fee'
//        ];
//
//        $client = static::createClient();
//        $client->request('POST', '/api/play', [], [], [], json_encode($testData));
//
//        $this->assertResponseStatusCodeSame(400);
//        $this->assertEquals('{"message":"The word must consist of letters only."}', $client->getResponse()->getContent());
//    }
//
//    public function testBodyInvalidKey(): void
//    {
//        $testData = [
//            'badKey' => 'test'
//        ];
//
//        $client = static::createClient();
//        $client->request('POST', '/api/play', [], [], [], json_encode($testData));
//
//        $this->assertResponseStatusCodeSame(400, 'Bad request');
//    }
//
//    public function testBodyMultipleValues(): void
//    {
//        $testData = [
//            'word' => 'coffee',
//            'otherKey' => 'someValue'
//        ];
//
//        $client = static::createClient();
//        $client->request('POST', '/api/play', [], [], [], json_encode($testData));
//
//        $this->assertResponseStatusCodeSame(200, 'OK');
//    }
//
//    public function testGETRequest(): void
//    {
//        $client = static::createClient();
//        $client->request('GET', '/api/play');
//
//        $this->assertResponseStatusCodeSame(405, 'Method Not Allowed');
//    }
//
//    public function testPUTRequest(): void
//    {
//        $client = static::createClient();
//        $client->request('PUT', '/api/play');
//
//        $this->assertResponseStatusCodeSame(405, 'Method Not Allowed');
//    }
//
//    public function testPATCHRequest(): void
//    {
//        $client = static::createClient();
//        $client->request('PATCH', '/api/play');
//
//        $this->assertResponseStatusCodeSame(405, 'Method Not Allowed');
//    }
//
    public function testDELETERequest(): void
    {
        $client = static::createClient();
        $client->request('DELETE', '/api/play');

        $this->assertResponseStatusCodeSame(405, 'Method Not Allowed');
    }
}
