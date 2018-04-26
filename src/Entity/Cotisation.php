<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CotisationRepository")
 */
class Cotisation
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
    private $exerciceComptable;

    /**
     * @ORM\Column(type="date")
     */
    private $datePaiement;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ValeurCotisation", inversedBy="cotisation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $montantCotisation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Membre", inversedBy="cotisation")
     */
    private $cotisation;

    public function getId()
    {
        return $this->id;
    }

    public function getExerciceComptable(): ?int
    {
        return $this->exerciceComptable;
    }

    public function setExerciceComptable(int $exerciceComptable): self
    {
        $this->exerciceComptable = $exerciceComptable;

        return $this;
    }

    public function getDatePaiement(): ?\DateTimeInterface
    {
        return $this->datePaiement;
    }

    public function setDatePaiement(\DateTimeInterface $datePaiement): self
    {
        $this->datePaiement = $datePaiement;

        return $this;
    }

    public function getMontantCotisation(): ?ValeurCotisation
    {
        return $this->montantCotisation;
    }

    public function setMontantCotisation(?ValeurCotisation $montantCotisation): self
    {
        $this->montantCotisation = $montantCotisation;

        return $this;
    }

    public function getCotisation(): ?Membre
    {
        return $this->cotisation;
    }

    public function setCotisation(?Membre $cotisation): self
    {
        $this->cotisation = $cotisation;

        return $this;
    }
}
