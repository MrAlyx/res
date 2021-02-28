<?php

namespace App\Entity;

use App\Repository\GerechtRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GerechtRepository::class)
 */
class Gerecht
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gerecht;

    /**
     * @ORM\OneToMany(targetEntity=Subgerecht::class, mappedBy="gerecht_id")
     */
    private $subgerechts;

    /**
     * @ORM\OneToMany(targetEntity=Bestelling::class, mappedBy="gerecht_id")
     */
    private $bestellings;

    public function __construct()
    {
        $this->subgerechts = new ArrayCollection();
        $this->bestellings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGerecht(): ?string
    {
        return $this->gerecht;
    }

    public function setGerecht(string $gerecht): self
    {
        $this->gerecht = $gerecht;

        return $this;
    }

    /**
     * @return Collection|Subgerecht[]
     */
    public function getSubgerechts(): Collection
    {
        return $this->subgerechts;
    }

    public function addSubgerecht(Subgerecht $subgerecht): self
    {
        if (!$this->subgerechts->contains($subgerecht)) {
            $this->subgerechts[] = $subgerecht;
            $subgerecht->setGerechtId($this);
        }

        return $this;
    }

    public function removeSubgerecht(Subgerecht $subgerecht): self
    {
        if ($this->subgerechts->removeElement($subgerecht)) {
            // set the owning side to null (unless already changed)
            if ($subgerecht->getGerechtId() === $this) {
                $subgerecht->setGerechtId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Bestelling[]
     */
    public function getBestellings(): Collection
    {
        return $this->bestellings;
    }

    public function addBestelling(Bestelling $bestelling): self
    {
        if (!$this->bestellings->contains($bestelling)) {
            $this->bestellings[] = $bestelling;
            $bestelling->setGerechtId($this);
        }

        return $this;
    }

    public function removeBestelling(Bestelling $bestelling): self
    {
        if ($this->bestellings->removeElement($bestelling)) {
            // set the owning side to null (unless already changed)
            if ($bestelling->getGerechtId() === $this) {
                $bestelling->setGerechtId(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getGerecht();
    }
}
