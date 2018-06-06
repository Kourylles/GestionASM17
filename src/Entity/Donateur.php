<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Coordonnees")
     * @ORM\JoinColumn(nullable=false)
     */
    private $coordonnees;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Recette", mappedBy="idDonateur")
     */
    private $idRecette;

    /**
     * @ORM\Column(type="boolean")
     */
    private $donOK;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateModif;

    public function __construct()
    {
        $this->idRecette = new ArrayCollection();
    }

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

    public function getCoordonnees(): ?Coordonnees
    {
        return $this->coordonnees;
    }

    public function setCoordonnees(?Coordonnees $coordonnees): self
    {
        $this->coordonnees = $coordonnees;

        return $this;
    }

    /**
     * @return Collection|Recette[]
     */
    public function getIdRecette(): Collection
    {
        return $this->idRecette;
    }

    public function addIdRecette(Recette $idRecette): self
    {
        if (!$this->idRecette->contains($idRecette)) {
            $this->idRecette[] = $idRecette;
            $idRecette->setIdDonateur($this);
        }

        return $this;
    }

    public function removeIdRecette(Recette $idRecette): self
    {
        if ($this->idRecette->contains($idRecette)) {
            $this->idRecette->removeElement($idRecette);
            // set the owning side to null (unless already changed)
            if ($idRecette->getIdDonateur() === $this) {
                $idRecette->setIdDonateur(null);
            }
        }

        return $this;
    }

    public function getDonOK(): ?bool
    {
        return $this->donOK;
    }

    public function setDonOK(bool $donOK): self
    {
        $this->donOK = $donOK;

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
}
