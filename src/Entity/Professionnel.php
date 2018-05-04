<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProfessionnelRepository")
 */
class Professionnel
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
    private $nomProfessionnel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomProfessionnel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fonctionProfessionnel;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $observationsProfessionnel;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $titreProfessionnel;

    public function getId()
    {
        return $this->id;
    }

    public function getNomProfessionnel(): ?string
    {
        return $this->nomProfessionnel;
    }

    public function setNomProfessionnel(string $NomProfessionnel): self
    {
        $this->nomProfessionnel = $NomProfessionnel;

        return $this;
    }

    public function getPrenomProfessionnel(): ?string
    {
        return $this->prenomProfessionnel;
    }

    public function setPrenomProfessionnel(string $PrenomProfessionnel): self
    {
        $this->prenomProfessionnel = $PrenomProfessionnel;

        return $this;
    }

    public function getFonctionProfessionnel(): ?string
    {
        return $this->fonctionProfessionnel;
    }

    public function setFonctionProfessionnel(?string $FonctionProfessionnel): self
    {
        $this->fonctionProfessionnel = $FonctionProfessionnel;

        return $this;
    }

    public function getObservationsProfessionnel(): ?string
    {
        return $this->observationsProfessionnel;
    }

    public function setObservationsProfessionnel(?string $ObservationsProfessionnel): self
    {
        $this->observationsProfessionnel = $ObservationsProfessionnel;

        return $this;
    }

    public function getTitreProfessionnel(): ?string
    {
        return $this->titreProfessionnel;
    }

    public function setTitreProfessionnel(?string $TitreProfessionnel): self
    {
        $this->titreProfessionnel = $TitreProfessionnel;

        return $this;
    }
}