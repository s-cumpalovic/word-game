<?php

namespace App\Model;

use App\Model\Traits\WordTrait;

class Word
{
    use WordTrait;

    private string $word;
    private int $uniqueLetters;
    private bool $isPalindrome;
    private bool $isAlmostPalindrome;

    public function __construct($word)
    {
        $this->word = $word;
        $this->setUniqueLetters();
        $this->setIsPalindrome();
        $this->setIsAlmostPalindrome();
    }

    public function getWordLowercase(): string
    {
        return $this->toLowercase($this->word);
    }

    public function getIsPalindrome(): bool
    {
        return $this->isPalindrome;
    }

    public function getIsAlmostPalindrome(): bool
    {
        return $this->isAlmostPalindrome;
    }

    public function getUniqueLetters(): int
    {
        return $this->uniqueLetters;
    }

    private function setWord(string $word): void
    {
        $this->word = $word;
    }

    private function setUniqueLetters(): void
    {
        $this->uniqueLetters = $this->uniqueLetterPoints($this->toLowercase($this->word));
    }

    private function setIsPalindrome(): void
    {
        $this->isPalindrome = $this->checkIfPalindrome($this->toLowercase($this->word));
    }

    private function setIsAlmostPalindrome(): void
    {
        $this->isAlmostPalindrome = $this->checkIfAlmostPalindrome($this->toLowercase($this->word));
    }
}