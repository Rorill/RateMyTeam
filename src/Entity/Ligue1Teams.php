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
    private ?string $DisplayName = null;

    #[ORM\Column(length: 255)]
    private ?string $Stadium = null;

    #[ORM\Column(length: 255)]
    private ?string $Coach = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'SelectedTeam')]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
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

    public function getDisplayName(): ?string
    {
        return $this->DisplayName;
    }

    public function setDisplayName(string $DisplayName): static
    {
        $this->DisplayName = $DisplayName;

        return $this;
    }

    public function getStadium(): ?string
    {
        return $this->Stadium;
    }

    public function setStadium(string $Stadium): static
    {
        $this->Stadium = $Stadium;

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
}
