<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\Column]
    private ?int $matchday = null;

    #[ORM\Column(length: 255)]
    private ?string $stage = null;

    #[ORM\Column]
    private ?int $apiMatchId = null;

    /**
     * @var Collection<int, PlayerRating>
     */
    #[ORM\OneToMany(targetEntity: PlayerRating::class, mappedBy: 'game')]
    private Collection $playerRatings;

    public function __construct()
    {
        $this->playerRatings = new ArrayCollection();
    }


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

    public function getMatchday(): ?int
    {
        return $this->matchday;
    }

    public function setMatchday(int $matchday): static
    {
        $this->matchday = $matchday;

        return $this;
    }

    public function getStage(): ?string
    {
        return $this->stage;
    }

    public function setStage(string $stage): static
    {
        $this->stage = $stage;

        return $this;
    }

    public function getApiMatchId(): ?int
    {
        return $this->apiMatchId;
    }

    public function setApiMatchId(int $apiMatchId): static
    {
        $this->apiMatchId = $apiMatchId;

        return $this;
    }

    /**
     * @return Collection<int, PlayerRating>
     */
    public function getPlayerRatings(): Collection
    {
        return $this->playerRatings;
    }

    public function addPlayerRating(PlayerRating $playerRating): static
    {
        if (!$this->playerRatings->contains($playerRating)) {
            $this->playerRatings->add($playerRating);
            $playerRating->setGame($this);
        }

        return $this;
    }

    public function removePlayerRating(PlayerRating $playerRating): static
    {
        if ($this->playerRatings->removeElement($playerRating)) {
            // set the owning side to null (unless already changed)
            if ($playerRating->getGame() === $this) {
                $playerRating->setGame(null);
            }
        }

        return $this;
    }



}
