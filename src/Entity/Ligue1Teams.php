<?php

namespace App\Entity;

use App\Repository\TeamsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamsRepository::class)]
class Ligue1Teams
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;



    #[ORM\Column(length: 255)]
    private ?string $Coach = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'SelectedTeam')]
    private Collection $users;

    /**
     * @var Collection<int, Game>
     */
    #[ORM\OneToMany(targetEntity: Game::class, mappedBy: 'TeamHome')]
    private Collection $HomeGames;

    /**
     * @var Collection<int, Game>
     */
    #[ORM\OneToMany(targetEntity: Game::class, mappedBy: 'TeamAway')]
    private Collection $AwayGames;

    /**
     * @var Collection<int, Players>
     */
    #[ORM\OneToMany(targetEntity: Players::class, mappedBy: 'team')]
    private Collection $players;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ShortName = null;

    #[ORM\Column(length: 5, nullable: true)]
    private ?string $TLA = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Address = null;

    #[ORM\Column(nullable: true)]
    private ?int $Founded = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Venue = null;

    #[ORM\Column(length: 255)]
    private ?string $ApiId = null;




    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->HomeGames = new ArrayCollection();
        $this->AwayGames = new ArrayCollection();
        $this->players = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }



    public function getCoach(): ?string
    {
        return $this->Coach;
    }

    public function setCoach(string $Coach): static
    {
        $this->Coach = $Coach;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setSelectedTeam($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getSelectedTeam() === $this) {
                $user->setSelectedTeam(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getHomeGames(): Collection
    {
        return $this->HomeGames;
    }

    public function addGame(Game $game): static
    {
        if (!$this->HomeGames->contains($game)) {
            $this->HomeGames->add($game);
            $game->setTeamHome($this);
        }

        return $this;
    }

    public function removeGame(Game $game): static
    {
        if ($this->HomeGames->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getTeamHome() === $this) {
                $game->setTeamHome(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getAwayGames(): Collection
    {
        return $this->AwayGames;
    }

    public function addAwayGame(Game $awayGame): static
    {
        if (!$this->AwayGames->contains($awayGame)) {
            $this->AwayGames->add($awayGame);
            $awayGame->setTeamAway($this);
        }

        return $this;
    }

    public function removeAwayGame(Game $awayGame): static
    {
        if ($this->AwayGames->removeElement($awayGame)) {
            // set the owning side to null (unless already changed)
            if ($awayGame->getTeamAway() === $this) {
                $awayGame->setTeamAway(null);
            }
        }

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
            $player->setTeam($this);
        }

        return $this;
    }

    public function removePlayer(Players $player): static
    {
        if ($this->players->removeElement($player)) {
            // set the owning side to null (unless already changed)
            if ($player->getTeam() === $this) {
                $player->setTeam(null);
            }
        }

        return $this;
    }



    public function getShortName(): ?string
    {
        return $this->ShortName;
    }

    public function setShortName(?string $ShortName): static
    {
        $this->ShortName = $ShortName;

        return $this;
    }

    public function getTLA(): ?string
    {
        return $this->TLA;
    }

    public function setTLA(?string $TLA): static
    {
        $this->TLA = $TLA;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(?string $Address): static
    {
        $this->Address = $Address;

        return $this;
    }

    public function getFounded(): ?int
    {
        return $this->Founded;
    }

    public function setFounded(?int $Founded): static
    {
        $this->Founded = $Founded;

        return $this;
    }

    public function getVenue(): ?string
    {
        return $this->Venue;
    }

    public function setVenue(?string $Venue): static
    {
        $this->Venue = $Venue;

        return $this;
    }

    public function getApiId(): ?string
    {
        return $this->ApiId;
    }

    public function setApiId(string $ApiId): static
    {
        $this->ApiId = $ApiId;

        return $this;
    }
}
