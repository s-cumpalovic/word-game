<?php

namespace App\Model;

use App\Entity\Traits\WordTrait;

class Word
{
    use WordTrait;

    private string $word;
    public bool $isPalindrome;
    public bool $isAlmostPalindrome;

    public function __construct($word)
    {
        $this->word = $word;
        $this->setIsPalindrome();
        $this->setIsAlmostPalindrome();
    }

    public function getWord(): string
    {
        return $this->word;
    }

    public function toLowercase(): Word
    {
        $this->word = trim(strtolower($this->word));
        return $this;
    }

    private function setIsPalindrome(): bool
    {
        return $this->isPalindrome = $this->toLowercase()->checkIfPalindrome($this->word);
    }

    private function setIsAlmostPalindrome(): bool
    {
        return $this->isAlmostPalindrome = $this->toLowercase()->checkIfAlmostPalindrome($this->word);
    }
}