<?php

namespace App\Entity;

use App\Repository\WordRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WordRepository::class)]
class Word
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $points = null;

    #[ORM\Column(nullable: true)]
    private ?bool $palindrome = null;

    #[ORM\Column(nullable: true)]
    private ?bool $almostPalindrome = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(?int $points): self
    {
        $this->points = $points;

        return $this;
    }

    public function isPalindrome(): ?bool
    {
        return $this->palindrome;
    }

    public function setPalindrome(?bool $palindrome): self
    {
        $this->palindrome = $palindrome;

        return $this;
    }

    public function isAlmostPalindrome(): ?bool
    {
        return $this->almostPalindrome;
    }

    public function setAlmostPalindrome(?bool $almostPalindrome): self
    {
        $this->almostPalindrome = $almostPalindrome;

        return $this;
    }
}
