<?php

namespace App\Tests\Unit\Application;

use App\Model\Dictionary\Dictionary;
use App\Model\Dictionary\Exception\NotEnglishWordException;
use App\Model\Word\Exception\NotAWordException;
use App\Service\GameplayService;
use PHPUnit\Framework\TestCase;

final class GameplayServiceTest extends TestCase
{
    private $dictionary;

    public function setUp(): void
    {
        $this->dictionary = $this->getMockBuilder(Dictionary::class)->getMock();
    }

    /**
     * @throws NotAWordException
     * @throws NotEnglishWordException
     */
    public function testPlaySuccess(): void
    {
        $this->dictionary->method('checkIfWordInDictionary')->willReturn(true);

        $data = [
            'input' => ['test', 'Glass', 'dOwN', 'LETTER'],
            'output' => [5, 4, 4, 4],
        ];

        $gameplayService = new GameplayService($this->dictionary);

        for ($i = 0; $i < count($data['input']); ++$i) {
            $this->assertSame($data['output'][$i], $gameplayService->play($data['input'][$i]));
        }
    }

    /**
     * @throws NotAWordException
     * @throws NotEnglishWordException
     */
    public function testPlayNotAWord(): void
    {
        $this->expectException(NotAWordException::class);

        $data = [
            'input' => ['symbol!@#$%', 'number98765', 's p a c e'],
        ];

        $gameplayService = new GameplayService($this->dictionary);

        for ($i = 0; $i < count($data['input']); ++$i) {
            $gameplayService->play($data['input'][$i]);
        }
    }

    /**
     * @throws NotAWordException
     * @throws NotEnglishWordException
     */
    public function testPlayNotEnglishWord(): void
    {
        $this->dictionary->method('checkIfWordInDictionary')->willReturn(false);
        $this->expectException(NotEnglishWordException::class);

        $data = [
            'input' => ['AllLetters', 'ButNot', 'ASingleWord', 'OfEnglishDictionary', 'qwerty'],
        ];

        $gameplayService = new GameplayService($this->dictionary);

        for ($i = 0; $i < count($data['input']); ++$i) {
            $gameplayService->play($data['input'][$i]);
        }
    }
}
