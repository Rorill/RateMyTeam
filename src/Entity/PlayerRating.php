<?php

namespace App\Entity;

use App\Repository\PlayerRatingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerRatingRepository::class)]
class PlayerRating
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'playerRatings')]
    private ?players $Player = null;

    #[ORM\Column]
    private ?int $rating = null;

    #[ORM\ManyToOne(inversedBy: 'playerRatings')]
    private ?Game $game = null;

    #[ORM\ManyToOne(inversedBy: 'playerRatings')]
    private ?User $User = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayer(): ?players
    {
        return $this->Player;
    }

    public function setPlayer(?players $Player): static
    {
        $this->Player = $Player;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): static
    {
        $this->game = $game;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): static
    {
        $this->User = $User;

        return $this;
    }
}
