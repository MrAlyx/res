<?php

namespace App\Entity;

use App\Repository\ReserveringRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReserveringRepository::class)
 */
class Reservering
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Klant::class, inversedBy="reserverings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $klant_id;

    /**
     * @ORM\ManyToOne(targetEntity=Tafel::class, inversedBy="reserverings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tafel_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $aantal_personen;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datum;

    /**
     * @ORM\OneToOne(targetEntity=Bon::class, mappedBy="reservering_id", cascade={"persist", "remove"})
     */
    private $bon;

    /**
     * @ORM\OneToMany(targetEntity=Bestelling::class, mappedBy="reservering_id")
     */
    private $bestellings;

    public function __construct()
    {
        $this->bestellings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKlantId(): ?Klant
    {
        return $this->klant_id;
    }

    public function setKlantId(?Klant $klant_id): self
    {
        $this->klant_id = $klant_id;

        return $this;
    }

    public function getTafelId(): ?Tafel
    {
        return $this->tafel_id;
    }

    public function setTafelId(?Tafel $tafel_id): self
    {
        $this->tafel_id = $tafel_id;

        return $this;
    }

    public function getAantalPersonen(): ?int
    {
        return $this->aantal_personen;
    }

    public function setAantalPersonen(int $aantal_personen): self
    {
        $this->aantal_personen = $aantal_personen;

        return $this;
    }

    public function getDatum(): ?\DateTimeInterface
    {
        return $this->datum;
    }

    public function setDatum(\DateTimeInterface $datum): self
    {
        $this->datum = $datum;

        return $this;
    }

    public function getBon(): ?Bon
    {
        return $this->bon;
    }

    public function setBon(?Bon $bon): self
    {
        // unset the owning side of the relation if necessary
        if ($bon === null && $this->bon !== null) {
            $this->bon->setReserveringId(null);
        }

        // set the owning side of the relation if necessary
        if ($bon !== null && $bon->getReserveringId() !== $this) {
            $bon->setReserveringId($this);
        }

        $this->bon = $bon;

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
            $bestelling->setReserveringId($this);
        }

        return $this;
    }

    public function removeBestelling(Bestelling $bestelling): self
    {
        if ($this->bestellings->removeElement($bestelling)) {
            // set the owning side to null (unless already changed)
            if ($bestelling->getReserveringId() === $this) {
                $bestelling->setReserveringId(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getKlantId();
    }
}
