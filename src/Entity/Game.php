<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'HomeGames')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ligue1Teams $TeamHome = null;

    #[ORM\ManyToOne(inversedBy: 'AwayGames')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ligue1Teams $TeamAway = null;

    #[ORM\Column(nullable: true)]
    private ?int $ScoreHome = null;

    #[ORM\Column(nullable: true)]
    private ?int $ScoreAway = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getTeamHome(): ?Ligue1Teams
    {
        return $this->TeamHome;
    }

    public function setTeamHome(?Ligue1Teams $TeamHome): static
    {
        $this->TeamHome = $TeamHome;

        return $this;
    }

    public function getTeamAway(): ?Ligue1Teams
    {
        return $this->TeamAway;
    }

    public function setTeamAway(?Ligue1Teams $TeamAway): static
    {
        $this->TeamAway = $TeamAway;

        return $this;
    }

    public function getScoreHome(): ?int
    {
        return $this->ScoreHome;
    }

    public function setScoreHome(?int $ScoreHome): static
    {
        $this->ScoreHome = $ScoreHome;

        return $this;
    }

    public function getScoreAway(): ?int
    {
        return $this->ScoreAway;
    }

    public function setScoreAway(?int $ScoreAway): static
    {
        $this->ScoreAway = $ScoreAway;

        return $this;
    }


}
