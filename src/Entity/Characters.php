<?php

namespace App\Entity;

use App\Repository\CharactersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CharactersRepository::class)]
class Characters
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $Name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Planet = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $SuperPower = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $BirthDate = null;

    #[ORM\ManyToMany(targetEntity: Weakness::class, inversedBy: 'weaknesses')]
    private Collection $weaknesses;



    public function __construct()
    {
        $this->weaknesses = new ArrayCollection();
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

    public function getPlanet(): ?string
    {
        return $this->Planet;
    }

    public function setPlanet(?string $Planet): static
    {
        $this->Planet = $Planet;

        return $this;
    }
    public function getSuperPower(): ?string
    {
        return $this->SuperPower;
    }

    public function setSuperPower(?string $SuperPower): static
    {
        $this->SuperPower = $SuperPower;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->BirthDate;
    }

    public function setBirthDate(?\DateTimeInterface $BirthDate): static
    {
        $this->BirthDate = $BirthDate;

        return $this;
    }

    /**
     * @return Collection<int, Weakness>
     */
    public function getWeaknesses(): Collection
    {
        return $this->weaknesses;
    }

    public function addWeakness(Weakness $weakness): static
    {
        if (!$this->weaknesses->contains($weakness)) {
            $this->weaknesses->add($weakness);
        }

        return $this;
    }

    public function removeWeakness(Weakness $weakness): static
    {
        $this->weaknesses->removeElement($weakness);

        return $this;
    }

    
}
