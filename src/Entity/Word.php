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
    private ?string $word = null;

    #[ORM\Column(nullable: true)]
    private ?int $points = null;

    #[ORM\Column(nullable: true)]
    private ?bool $palindrome = null;

    #[ORM\Column(nullable: true)]
    private ?bool $almostPalindrome = null;

    #[ORM\ManyToOne(inversedBy: 'words')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWord(): ?string
    {
        return $this->word;
    }

    public function setWord(?string $word): self
    {
        $this->word = $word;

        return $this;
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

    public function getuser(): ?User
    {
        return $this->user;
    }

    public function setuser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
