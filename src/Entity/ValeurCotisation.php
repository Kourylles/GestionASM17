<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ValeurCotisationRepository")
 */
class ValeurCotisation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $montantCotisation;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cotisation", mappedBy="montantCotisation")
     */
    private $cotisation;

    public function __construct()
    {
        $this->cotisation = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getMontantCotisation(): ?int
    {
        return $this->montantCotisation;
    }

    public function setMontantCotisation(int $montantCotisation): self
    {
        $this->montantCotisation = $montantCotisation;

        return $this;
    }

    /**
     * @return Collection|Cotisation[]
     */
    public function getCotisation(): Collection
    {
        return $this->cotisation;
    }

    public function addCotisation(Cotisation $cotisation): self
    {
        if (!$this->cotisation->contains($cotisation)) {
            $this->cotisation[] = $cotisation;
            $cotisation->setMontantCotisation($this);
        }

        return $this;
    }

    public function removeCotisation(Cotisation $cotisation): self
    {
        if ($this->cotisation->contains($cotisation)) {
            $this->cotisation->removeElement($cotisation);
            // set the owning side to null (unless already changed)
            if ($cotisation->getMontantCotisation() === $this) {
                $cotisation->setMontantCotisation(null);
            }
        }

        return $this;
    }
}
