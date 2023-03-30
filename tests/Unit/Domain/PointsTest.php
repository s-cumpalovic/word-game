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
            'input' => 'plate',
            'output' => 5,
        ];
        $this->word->method('uniqueLetters')->willReturn($data['output']);

        $pointsCalculator = new ThreeTwoOneWordPoints($this->word);

        $this->assertSame($data['output'], $pointsCalculator->uniqueLetterPoints());
    }

    public function testPalindromePoints(): void
    {
        $this->word->method('isPalindrome')->willReturn(true);

        $pointsCalculator = new ThreeTwoOneWordPoints($this->word);

        $this->assertSame(3, $pointsCalculator->palindromePoints());
    }

    public function testAlmostPalindromePoints(): void
    {
        $this->word->method('isAlmostPalindrome')->willReturn(true);

        $pointsCalculator = new ThreeTwoOneWordPoints($this->word);

        $this->assertSame(2, $pointsCalculator->almostPalindromePoints());
    }

    public function testNotPalindromePoints(): void
    {
        $this->word->method('isPalindrome')->willReturn(false);

        $pointsCalculator = new ThreeTwoOneWordPoints($this->word);

        $this->assertSame(0, $pointsCalculator->palindromePoints());
    }

    public function testNotAlmostPalindromePoints(): void
    {
        $this->word->method('isAlmostPalindrome')->willReturn(false);

        $pointsCalculator = new ThreeTwoOneWordPoints($this->word);

        $this->assertSame(0, $pointsCalculator->almostPalindromePoints());
    }
}
