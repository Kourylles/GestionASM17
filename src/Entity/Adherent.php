<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdherentRepository")
 */
class Adherent
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateModification;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $observation;

    /**
     * @ORM\Column(type="boolean")
     */
    private $actif;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeAdherent")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeAdherent;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Coordonnees")
     * @ORM\JoinColumn(nullable=false)
     */
    private $coordonnees;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Smith")
     */
    private $smithLie;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isSmith;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\LienParente")
     * @ORM\JoinColumn(nullable=false)
     */
    private $lienParente;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FonctionCa")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fonctionAuCa;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Recette", mappedBy="adherent")
     */
    private $recette;

    public function __construct()
    {
        $this->recette = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

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

    public function getDateModification(): ?\DateTimeInterface
    {
        return $this->dateModification;
    }

    public function setDateModification(\DateTimeInterface $dateModification): self
    {
        $this->dateModification = $dateModification;

        return $this;
    }

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(?string $observation): self
    {
        $this->observation = $observation;

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    public function getTypeAdherent(): ?TypeAdherent
    {
        return $this->typeAdherent;
    }

    public function setTypeAdherent(?TypeAdherent $typeAdherent): self
    {
        $this->typeAdherent = $typeAdherent;

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

    public function getSmithLie(): ?Smith
    {
        return $this->smithLie;
    }

    public function setSmithLie(?Smith $smithLie): self
    {
        $this->smithLie = $smithLie;

        return $this;
    }

    public function getIsSmith(): ?bool
    {
        return $this->isSmith;
    }

    public function setIsSmith(bool $isSmith): self
    {
        $this->isSmith = $isSmith;

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

    public function getFonctionAuCa(): ?FonctionCa
    {
        return $this->fonctionAuCa;
    }

    public function setFonctionAuCa(?FonctionCa $fonctionAuCa): self
    {
        $this->fonctionAuCa = $fonctionAuCa;

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
            $recette->setAdherent($this);
        }

        return $this;
    }

    public function removeRecette(Recette $recette): self
    {
        if ($this->recette->contains($recette)) {
            $this->recette->removeElement($recette);
            // set the owning side to null (unless already changed)
            if ($recette->getAdherent() === $this) {
                $recette->setAdherent(null);
            }
        }

        return $this;
    }

    public function getIdentifiant(): ?int
    {
        return $this->identifiant;
    }
}
