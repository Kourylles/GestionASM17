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
     * @ORM\Column(type="integer")
     */
    private $exerciceComptableRecette;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionRecette;

    /**
     * @ORM\Column(type="date")
     */
    private $datePaiementRecette;

    /**
     * @ORM\Column(type="float")
     */
    private $montantRecette;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numTitrePaiementRecette;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numRemiseDeChequeRecette;

    /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $etatRapprochementRecette;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numReleveCompteRecette;

    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeRecette")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeRecette;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ModePaiement")
     * @ORM\JoinColumn(nullable=false)
     */
    private $modePaiement;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Adherent", inversedBy="recette",cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $adherent;

    /**
     * @ORM\Column(type="boolean")
     */
    private $recetteActive;

    public function __construct()
    {
        $this->recetteActive = True;
    }

    public function getId()
    {
        return $this->id;
    }


    public function getExerciceComptableRecette(): ?string
    {
        return $this->exerciceComptableRecette;
    }

    public function setExerciceComptableRecette(string $ExerciceComptableRecette): self
    {
        $this->exerciceComptableRecette = $ExerciceComptableRecette;

        return $this;
    }

    public function getDescriptionRecette(): ?string
    {
        return $this->descriptionRecette;
    }

    public function setDescriptionRecette(?string $DescriptionRecette): self
    {
        $this->descriptionRecette = $DescriptionRecette;

        return $this;
    }

    public function getDatePaiementRecette(): ?\DateTimeInterface
    {
        return $this->datePaiementRecette;
    }

    public function setDatePaiementRecette(\DateTimeInterface $DatePaiementRecette): self
    {
        $this->datePaiementRecette = $DatePaiementRecette;

        return $this;
    }

    public function getMontantRecette(): ?float
    {
        return $this->montantRecette;
    }

    public function setMontantRecette(float $MontantRecette): self
    {
        $this->montantRecette = $MontantRecette;

        return $this;
    }

    public function getNumTitrePaiementRecette(): ?string
    {
        return $this->numTitrePaiementRecette;
    }

    public function setNumTitrePaiementRecette(string $NumTitrePaiementRecette): self
    {
        $this->numTitrePaiementRecette = $NumTitrePaiementRecette;

        return $this;
    }

    public function getNumRemiseDeChequeRecette(): ?string
    {
        return $this->numRemiseDeChequeRecette;
    }

    public function setNumRemiseDeChequeRecette(?string $NumRemiseDeChequeRecette): self
    {
        $this->numRemiseDeChequeRecette = $NumRemiseDeChequeRecette;

        return $this;
    }

    public function getEtatRapprochementRecette(): ?bool
    {
        return $this->etatRapprochementRecette;
    }

    public function setEtatRapprochementRecette(bool $EtatRapprochementRecette): self
    {
        $this->etatRapprochementRecette = $EtatRapprochementRecette;

        return $this;
    }

    public function getNumReleveCompteRecette(): ?string
    {
        return $this->numReleveCompteRecette;
    }

    public function setNumReleveCompteRecette(?string $NumReleveCompteRecette): self
    {
        $this->numReleveCompteRecette = $NumReleveCompteRecette;

        return $this;
    }

    public function getTypeRecette(): ?TypeRecette
    {
        return $this->typeRecette;
    }

    public function setTypeRecette(?TypeRecette $typeRecette): self
    {
        $this->typeRecette = $typeRecette;

        return $this;
    }

    public function getModePaiement(): ?ModePaiement
    {
        return $this->modePaiement;
    }

    public function setModePaiement(?ModePaiement $modePaiement): self
    {
        $this->modePaiement = $modePaiement;

        return $this;
    }

    public function getAdherent(): ?Adherent
    {
        return $this->adherent;
    }

    public function setAdherent(?Adherent $adherent): self
    {
        $this->adherent = $adherent;

        return $this;
    }

    public function getRecetteActive(): ?bool
    {
        return $this->recetteActive;
    }

    public function setRecetteActive(bool $recetteActive): self
    {
        $this->recetteActive = $recetteActive;

        return $this;
    }

}
