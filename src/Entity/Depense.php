<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DepenseRepository")
 */
class Depense
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
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDepense;

    /**
     * @ORM\Column(type="float")
     */
    private $montantDepense;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $debiteur;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $numTitrePaiementDepence;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $numReleveBancaireDepense;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $rapprochee;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $anneeDepense;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ModePaiement", inversedBy="depenses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $modePaiementDepense;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PosteAnalytique")
     * @ORM\JoinColumn(nullable=false)
     */
    private $posteAnalytique;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tresorerie")
     * @ORM\JoinColumn(nullable=false)
     */
    private $compteDebite;

    /**
     * @ORM\Column(type="boolean")
     */
    private $depenseActive;

    public function getId()
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateDepense(): ?\DateTimeInterface
    {
        return $this->dateDepense;
    }

    public function setDateDepense(\DateTimeInterface $dateDepense): self
    {
        $this->dateDepense = $dateDepense;

        return $this;
    }

    public function getMontantDepense(): ?float
    {
        return $this->montantDepense;
    }

    public function setMontantDepense(float $montantDepense): self
    {
        $this->montantDepense = $montantDepense;

        return $this;
    }

    public function getDebiteur(): ?string
    {
        return $this->debiteur;
    }

    public function setDebiteur(string $debiteur): self
    {
        $this->debiteur = $debiteur;

        return $this;
    }

    public function getNumTitrePaiementDepence(): ?string
    {
        return $this->numTitrePaiementDepence;
    }

    public function setNumTitrePaiementDepence(string $numTitrePaiementDepence): self
    {
        $this->numTitrePaiementDepence = $numTitrePaiementDepence;

        return $this;
    }

    public function getNumReleveBancaireDepense(): ?string
    {
        return $this->numReleveBancaireDepense;
    }

    public function setNumReleveBancaireDepense(?string $numReleveBancaireDepense): self
    {
        $this->numReleveBancaireDepense = $numReleveBancaireDepense;

        return $this;
    }

    public function getRapprochee(): ?bool
    {
        return $this->rapprochee;
    }

    public function setRapprochee(?bool $rapprochee): self
    {
        $this->rapprochee = $rapprochee;

        return $this;
    }

    public function getAnneeDepense(): ?string
    {
        return $this->anneeDepense;
    }

    public function setAnneeDepense(string $anneeDepense): self
    {
        $this->anneeDepense = $anneeDepense;

        return $this;
    }

    public function getModePaiementDepense(): ?ModePaiement
    {
        return $this->modePaiementDepense;
    }

    public function setModePaiementDepense(?ModePaiement $modePaiementDepense): self
    {
        $this->modePaiementDepense = $modePaiementDepense;

        return $this;
    }

    public function getPosteAnalytique(): ?PosteAnalytique
    {
        return $this->posteAnalytique;
    }

    public function setPosteAnalytique(?PosteAnalytique $posteAnalytique): self
    {
        $this->posteAnalytique = $posteAnalytique;

        return $this;
    }

    public function getCompteDebite(): ?Tresorerie
    {
        return $this->compteDebite;
    }

    public function setCompteDebite(?Tresorerie $compteDebite): self
    {
        $this->compteDebite = $compteDebite;

        return $this;
    }

    public function getDepenseActive(): ?bool
    {
        return $this->depenseActive;
    }

    public function setDepenseActive(bool $depenseActive): self
    {
        $this->depenseActive = $depenseActive;

        return $this;
    }
}
