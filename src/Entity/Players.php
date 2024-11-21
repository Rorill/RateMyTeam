<?php

namespace App\Entity;

use App\Repository\PlayersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayersRepository::class)]
class Players
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 255)]
    private ?string $position = null;

    #[ORM\ManyToOne(inversedBy: 'players')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ligue1Teams $team = null;


    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateOfBirth = null;


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Nationality = null;

    #[ORM\Column]
    private ?int $ApiId = null;

    /**
     * @var Collection<int, PlayerRating>
     */
    #[ORM\OneToMany(targetEntity: PlayerRating::class, mappedBy: 'Player')]
    private Collection $playerRatings;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $FirstName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $LastName = null;

    /**
     * @var Collection<int, Lineup>
     */
    #[ORM\ManyToMany(targetEntity: Lineup::class, inversedBy: 'players')]
    private Collection $Lineups;

    public function __construct()
    {
        $this->playerRatings = new ArrayCollection();
        $this->Lineups = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }




    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): static
    {
        $this->position = $position;

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

    public function getApiId(): ?int
    {
        return $this->ApiId;
    }

    public function setApiId(?int $apiID): static
    {
        $this->ApiId = $apiID;

        return $this;
    }


    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->DateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $DateOfBirth): static
    {
        $this->DateOfBirth = $DateOfBirth;

        return $this;
    }



    public function getNationality(): ?string
    {
        return $this->Nationality;
    }

    public function setNationality(?string $Nationality): static
    {
        $this->Nationality = $Nationality;

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
            $playerRating->setPlayer($this);
        }

        return $this;
    }

    public function removePlayerRating(PlayerRating $playerRating): static
    {
        if ($this->playerRatings->removeElement($playerRating)) {
            // set the owning side to null (unless already changed)
            if ($playerRating->getPlayer() === $this) {
                $playerRating->setPlayer(null);
            }
        }

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(?string $FirstName): static
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(?string $LastName): static
    {
        $this->LastName = $LastName;

        return $this;
    }

    /**
     * @return Collection<int, Lineup>
     */
    public function getLineups(): Collection
    {
        return $this->Lineups;
    }

    public function addLineup(Lineup $lineup): static
    {
        if (!$this->Lineups->contains($lineup)) {
            $this->Lineups->add($lineup);
        }

        return $this;
    }

    public function removeLineup(Lineup $lineup): static
    {
        $this->Lineups->removeElement($lineup);

        return $this;
    }
}
