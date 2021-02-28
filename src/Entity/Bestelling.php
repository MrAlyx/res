<?php

namespace App\Entity;

use App\Repository\BestellingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BestellingRepository::class)
 */
class Bestelling
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Menuitem::class, inversedBy="bestellings")
     */
    private $menuitem_id;

    /**
     * @ORM\ManyToOne(targetEntity=Reservering::class, inversedBy="bestellings")
     */
    private $reservering_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $aantal;

    /**
     * @ORM\Column(type="boolean")
     */
    private $staat_klaar;

    /**
     * @ORM\ManyToOne(targetEntity=Bon::class, inversedBy="bestellings")
     */
    private $bon_id;

    /**
     * @ORM\ManyToOne(targetEntity=Gerecht::class, inversedBy="bestellings")
     */
    private $gerecht_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMenuitemId(): ?Menuitem
    {
        return $this->menuitem_id;
    }

    public function setMenuitemId(?Menuitem $menuitem_id): self
    {
        $this->menuitem_id = $menuitem_id;

        return $this;
    }

    public function getReserveringId(): ?Reservering
    {
        return $this->reservering_id;
    }

    public function setReserveringId(?Reservering $reservering_id): self
    {
        $this->reservering_id = $reservering_id;

        return $this;
    }

    public function getAantal(): ?int
    {
        return $this->aantal;
    }

    public function setAantal(int $aantal): self
    {
        $this->aantal = $aantal;

        return $this;
    }

    public function getStaatKlaar(): ?bool
    {
        return $this->staat_klaar;
    }

    public function setStaatKlaar(bool $staat_klaar): self
    {
        $this->staat_klaar = $staat_klaar;

        return $this;
    }

    public function getBonId(): ?Bon
    {
        return $this->bon_id;
    }

    public function setBonId(?Bon $bon_id): self
    {
        $this->bon_id = $bon_id;

        return $this;
    }

    public function getGerechtId(): ?Gerecht
    {
        return $this->gerecht_id;
    }

    public function setGerechtId(?Gerecht $gerecht_id): self
    {
        $this->gerecht_id = $gerecht_id;

        return $this;
    }
}
