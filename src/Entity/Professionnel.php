<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Coordonnees")
     */
    private $coordonnees;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateModif;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Titre;

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

    public function getCoordonnees(): ?Coordonnees
    {
        return $this->coordonnees;
    }

    public function setCoordonnees(?Coordonnees $coordonnees): self
    {
        $this->coordonnees = $coordonnees;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDateModif(): ?\DateTimeInterface
    {
        return $this->dateModif;
    }

    public function setDateModif(\DateTimeInterface $dateModif): self
    {
        $this->dateModif = $dateModif;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(?string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }

}
