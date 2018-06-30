<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ModePaiementRepository")
 */
class ModePaiement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $modeDePaiement;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Depense", mappedBy="modePaiementDepense")
     */
    private $depenses;

    public function __construct()
    {
        $this->depenses = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getModeDePaiement(): ?string
    {
        return $this->modeDePaiement;
    }


    /**
     * @return Collection|Depense[]
     */
    public function getDepenses(): Collection
    {
        return $this->depenses;
    }

    public function addDepense(Depense $depense): self
    {
        if (!$this->depenses->contains($depense)) {
            $this->depenses[] = $depense;
            $depense->setModePaiementDepense($this);
        }

        return $this;
    }

    public function removeDepense(Depense $depense): self
    {
        if ($this->depenses->contains($depense)) {
            $this->depenses->removeElement($depense);
            // set the owning side to null (unless already changed)
            if ($depense->getModePaiementDepense() === $this) {
                $depense->setModePaiementDepense(null);
            }
        }

        return $this;
    }

    public function setModeDePaiement(string $modeDePaiement): self
    {
        $this->modeDePaiement = $modeDePaiement;

        return $this;
    }
}
