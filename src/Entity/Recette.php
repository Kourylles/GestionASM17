<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecetteRepository")
 */
class Recette
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $DatePaiement;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\Column(type="integer")
     */
    private $anneeExercice;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $observation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numTitrePaiement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numRemise;

    /**
     * @ORM\Column(type="boolean")
     */
    private $etatRapprochement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numReleveCompte;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeDeRecette", inversedBy="recettes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeDeRecette;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Personne", inversedBy="recette")
     */
    private $personne;

    public function getId()
    {
        return $this->id;
    }

    public function getDatePaiement(): ?\DateTimeInterface
    {
        return $this->DatePaiement;
    }

    public function setDatePaiement(\DateTimeInterface $DatePaiement): self
    {
        $this->DatePaiement = $DatePaiement;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getAnneeExercice(): ?int
    {
        return $this->anneeExercice;
    }

    public function setAnneeExercice(int $anneeExercice): self
    {
        $this->anneeExercice = $anneeExercice;

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

    public function getNumTitrePaiement(): ?string
    {
        return $this->numTitrePaiement;
    }

    public function setNumTitrePaiement(string $numTitrePaiement): self
    {
        $this->numTitrePaiement = $numTitrePaiement;

        return $this;
    }

    public function getNumRemise(): ?string
    {
        return $this->numRemise;
    }

    public function setNumRemise(?string $numRemise): self
    {
        $this->numRemise = $numRemise;

        return $this;
    }

    public function getEtatRapprochement(): ?bool
    {
        return $this->etatRapprochement;
    }

    public function setEtatRapprochement(bool $etatRapprochement): self
    {
        $this->etatRapprochement = $etatRapprochement;

        return $this;
    }

    public function getNumReleveCompte(): ?string
    {
        return $this->numReleveCompte;
    }

    public function setNumReleveCompte(?string $numReleveCompte): self
    {
        $this->numReleveCompte = $numReleveCompte;

        return $this;
    }

    public function getTypeDeRecette(): ?TypeDeRecette
    {
        return $this->typeDeRecette;
    }

    public function setTypeDeRecette(?TypeDeRecette $typeDeRecette): self
    {
        $this->typeDeRecette = $typeDeRecette;

        return $this;
    }

    public function getPersonne(): ?Personne
    {
        return $this->personne;
    }

    public function setPersonne(?Personne $personne): self
    {
        $this->personne = $personne;

        return $this;
    }
}
