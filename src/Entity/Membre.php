<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MembreRepository")
 */
class Membre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomMembre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomMembre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $observationsMembre;

    public function getId()
    {
        return $this->id;
    }

    public function getNomMembre(): ?string
    {
        return $this->nomMembre;
    }

    public function setNomMembre(string $NomMembre): self
    {
        $this->nomMembre = $NomMembre;

        return $this;
    }

    public function getPrenomMembre(): ?string
    {
        return $this->prenomMembre;
    }

    public function setPrenomMembre(string $PrenomMembre): self
    {
        $this->prenomMembre = $prenomMembre;

        return $this;
    }

    public function getObservationsMembre(): ?string
    {
        return $this->observationsMembre;
    }

    public function setObservationsMembre(?string $ObservationsMembre): self
    {
        $this->observationsMembre = $ObservationsMembre;

        return $this;
    }
}
