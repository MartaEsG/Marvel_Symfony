<?php

namespace App\Entity;

use App\Repository\WeaknessRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WeaknessRepository::class)]
class Weakness
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Characters::class, mappedBy: 'weaknesses')]
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
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Characters>
     */
    public function getWeaknesses(): Collection
    {
        return $this->weaknesses;
    }

    public function addWeakness(Characters $weakness): static
    {
        if (!$this->weaknesses->contains($weakness)) {
            $this->weaknesses->add($weakness);
            $weakness->addWeakness($this);
        }

        return $this;
    }

    public function removeWeakness(Characters $weakness): static
    {
        if ($this->weaknesses->removeElement($weakness)) {
            $weakness->removeWeakness($this);
        }

        return $this;
    }
}
