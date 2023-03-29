<?php

namespace App\Tests\Unit\Domain;

use App\Model\Points\ThreeTwoOneWordPoints;
use App\Model\Word\Word;
use PHPUnit\Framework\TestCase;

class PointsTest extends TestCase
{
    private $word;

    public function setUp(): void
    {
        $this->word = $this->getMockBuilder(Word::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testUniquePoints(): void
    {
        $data = [
            'input' => ['window', 'glass', 'door', 'plate', 'picture'],
            'output' => [5, 4, 3, 4, 7]
        ];

        for ($i = 0; $i < count($data['input']); $i++) {
            $this->word->method('uniqueLetters')->willReturn($data['output'][$i]);
            $pointsManager = new ThreeTwoOneWordPoints($this->word);
            $this->assertSame($data['output'][$i], $pointsManager->uniqueLetterPoints());
        }


    }

    public function testPalindromePoints(): void
    {
        $this->word->method('isPalindrome')->willReturn(true);

        $pointsManager = new ThreeTwoOneWordPoints($this->word);

        $this->assertSame(3, $pointsManager->palindromePoints());
    }

    public function testAlmostPalindromePoints(): void
    {
        $this->word->method('isAlmostPalindrome')->willReturn(true);

        $pointsManager = new ThreeTwoOneWordPoints($this->word);

        $this->assertSame(2, $pointsManager->almostPalindromePoints());
    }

    public function testNotPalindromePoints(): void
    {
        $this->word->method('isPalindrome')->willReturn(false);

        $pointsManager = new ThreeTwoOneWordPoints($this->word);

        $this->assertSame(0, $pointsManager->palindromePoints());
    }


    public function testNotAlmostPalindromePoints(): void
    {
        $this->word->method('isAlmostPalindrome')->willReturn(false);

        $pointsManager = new ThreeTwoOneWordPoints($this->word);

        $this->assertSame(0, $pointsManager->almostPalindromePoints());
    }
}