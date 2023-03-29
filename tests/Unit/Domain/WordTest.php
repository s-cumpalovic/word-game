<?php

namespace App\Test\Unit\Domain;

use App\Model\Word\Exception\NotAWordException;
use App\Model\Word\Word;
use PHPUnit\Framework\TestCase;

class WordTest extends TestCase
{
    /**
     * @throws NotAWordException
     */
    public function testCreateWordSuccess(): void
    {
        $data = [
            'input' => ['Test', 'HUGE', 'small', 'CoMbIneD', 'word'],
            'output' => ['test', 'huge', 'small', 'combined', 'word']
        ];

        for ($i = 0; $i < count($data['input']); $i++) {
            $word[$i] = new Word($data['input'][$i]);
            $this->assertEquals($data['output'][$i], $word[$i]->getWord());
        }
    }

    /**
     * @throws NotAWordException
     */
    public function testCreateWordFail(): void
    {
        $this->expectException(NotAWordException::class);

        $data = [
            'input' => ['Symbol@!@#', 'Number12321', 'S p a c e']
        ];

        for ($i = 0; $i < count($data['input']); $i++) {
            new Word($data['input'][$i]);
        }
    }

    /**
     * @throws NotAWordException
     */
    public function testUniqueLetters(): void
    {
        $data = [
            'input' => ['Test', 'Kayak', 'Window', 'Risky', 'Unique'],
            'output' => [3, 3, 5, 5, 5]
        ];

        for ($i = 0; $i < count($data['input']); $i++) {
            $word[$i] = new Word($data['input'][$i]);
            $this->assertSame($data['output'][$i], $word[$i]->uniqueLetters());
        }
    }

    /**
     * @throws NotAWordException
     */
    public function testPalindrome(): void
    {
        $data = [
            'input' => ['deified', 'kayak', 'rotator', 'repaper', 'deed', 'peep', 'noon', 'wow'],
        ];

        for ($i = 0; $i < count($data['input']); $i++) {
            $word[$i] = new Word($data['input'][$i]);
            $this->assertSame(true, $word[$i]->isPalindrome());
        }
    }

    /**
     * @throws NotAWordException
     */
    public function testNotPalindrome(): void
    {
        $data = [
            'input' => ['cube', 'triangle', 'circle', 'pyramid', 'square', 'cone'],
        ];

        for ($i = 0; $i < count($data['input']); $i++) {
            $word[$i] = new Word($data['input'][$i]);
            $this->assertSame(false, $word[$i]->isPalindrome());
        }
    }

    /**
     * @throws NotAWordException
     */
    public function testAlmostPalindrome(): void
    {
        $data = [
            'input' => ['test', 'detected', 'allay', 'array', 'add', 'odd', 'off'],
        ];

        for ($i = 0; $i < count($data['input']); $i++) {
            $word[$i] = new Word($data['input'][$i]);
            $this->assertSame(true, $word[$i]->isAlmostPalindrome());
        }
    }

    public function testNotAlmostPalindrome(): void
    {
        $data = [
            'input' => ['cube', 'triangle', 'circle', 'pyramid', 'square', 'cone'],
        ];

        for ($i = 0; $i < count($data['input']); $i++) {
            $word[$i] = new Word($data['input'][$i]);
            $this->assertSame(false, $word[$i]->isAlmostPalindrome());
        }
    }
}