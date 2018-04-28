<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DonateurRepository")
 */
class Donateur
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
    private $nomDonateur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomDonateur;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $observationsDonateur;

    public function getId()
    {
        return $this->id;
    }

    public function getNomDonateur(): ?string
    {
        return $this->nomDonateur;
    }

    public function setNomDonateur(string $NomDonateur): self
    {
        $this->nomDonateur = $NomDonateur;

        return $this;
    }

    public function getPrenomDonateur(): ?string
    {
        return $this->prenomDonateur;
    }

    public function setPrenomDonateur(string $PrenomDonateur): self
    {
        $this->prenomDonateur = $PrenomDonateur;

        return $this;
    }

    public function getObservationsDonateur(): ?string
    {
        return $this->observationsDonateur;
    }

    public function setObservationsDonateur(?string $ObservationsDonateur): self
    {
        $this->observationsDonateur = $ObservationsDonateur;

        return $this;
    }
}
