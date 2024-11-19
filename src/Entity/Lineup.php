<?php

namespace App\Entity;

use App\Repository\LineupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LineupRepository::class)]
class Lineup
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'lineups')]
    private ?Game $game = null;

    /**
     * @var Collection<int, Players>
     */
    #[ORM\ManyToMany(targetEntity: Players::class, inversedBy: 'lineups')]
    private Collection $players;

    #[ORM\ManyToOne(inversedBy: 'lineups')]
    private ?Ligue1Teams $team = null; // Renamed from Team to team

    #[ORM\Column]
    private ?bool $isStarter = null;

    public function __construct()
    {
        $this->players = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Players>
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Players $player): static
    {
        if (!$this->players->contains($player)) {
            $this->players->add($player);
        }

        return $this;
    }

    public function removePlayer(Players $player): static
    {
        $this->players->removeElement($player);

        return $this;
    }

    public function getTeam(): ?Ligue1Teams
    {
        return $this->team;
    }

    public function setTeam(?Ligue1Teams $team): static
    {
        $this->team = $team;

        return $this;
    }

    public function isStarter(): ?bool
    {
        return $this->isStarter;
    }

    public function setStarter(bool $isStarter): static
    {
        $this->isStarter = $isStarter;

        return $this;
    }
}
