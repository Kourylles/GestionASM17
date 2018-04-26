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
     * @ORM\OneToMany(targetEntity="App\Entity\Cotisation", mappedBy="cotisation")
     */
    private $cotisation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Smith", inversedBy="membreLie")
     */
    private $smithLie;

    public function __construct()
    {
        $this->cotisation = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
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
            $cotisation->setCotisation($this);
        }

        return $this;
    }

    public function removeCotisation(Cotisation $cotisation): self
    {
        if ($this->cotisation->contains($cotisation)) {
            $this->cotisation->removeElement($cotisation);
            // set the owning side to null (unless already changed)
            if ($cotisation->getCotisation() === $this) {
                $cotisation->setCotisation(null);
            }
        }

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
}
