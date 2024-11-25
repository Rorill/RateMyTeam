<?php

namespace App\Entity;

use App\Repository\PlayersRatingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayersRatingRepository::class)]
class PlayersRating
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'playersRatings')]
    private ?Players $player = null;

    #[ORM\ManyToOne(inversedBy: 'game')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'playersRatings')]
    private ?Game $relation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayer(): ?Players
    {
        return $this->player;
    }

    public function setPlayer(?Players $player): static
    {
        $this->player = $player;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getRelation(): ?Game
    {
        return $this->relation;
    }

    public function setRelation(?Game $relation): static
    {
        $this->relation = $relation;

        return $this;
    }
}
