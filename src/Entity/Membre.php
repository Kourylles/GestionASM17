<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Coordonnees")
     * @ORM\JoinColumn(nullable=false)
     */
    private $coordonnees;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Recette", mappedBy="idMembre")
     */
    private $recette;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\LienParente")
     */
    private $lienParente;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FonctionCa")
     */
    private $fonctionCa;

    /**
     * @ORM\Column(type="boolean")
     */
    private $CotiOK;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Smith", inversedBy="idMembre")
     */
    private $smithLie;

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
        $this->recette = new ArrayCollection();
    }

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
    public function getRecette(): Collection
    {
        return $this->recette;
    }

    public function addRecette(Recette $recette): self
    {
        if (!$this->recette->contains($recette)) {
            $this->recette[] = $recette;
            $recette->setIdMembre($this);
        }

        return $this;
    }

    public function removeRecette(Recette $recette): self
    {
        if ($this->recette->contains($recette)) {
            $this->recette->removeElement($recette);
            // set the owning side to null (unless already changed)
            if ($recette->getIdMembre() === $this) {
                $recette->setIdMembre(null);
            }
        }

        return $this;
    }

    public function getLienParente(): ?LienParente
    {
        return $this->lienParente;
    }

    public function setLienParente(?LienParente $lienParente): self
    {
        $this->lienParente = $lienParente;

        return $this;
    }

    public function getFonctionCa(): ?FonctionCa
    {
        return $this->fonctionCa;
    }

    public function setFonctionCa(?FonctionCa $fonctionCa): self
    {
        $this->fonctionCa = $fonctionCa;

        return $this;
    }

    public function getCotiOK(): ?bool
    {
        return $this->CotiOK;
    }

    public function setCotiOK(bool $CotiOK): self
    {
        $this->CotiOK = $CotiOK;

        return $this;
    }

    public function getSmithLie(): ?Smith
    {
        return $this->smithLie;
    }

    public function setSmithLie(?Smith $smithLie): self
    {
        $this->smithLie = $smithLie;

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
