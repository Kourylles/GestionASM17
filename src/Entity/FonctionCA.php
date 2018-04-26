<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FonctionCARepository")
 */
class FonctionCA
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
    private $fonctionCa;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Personne", mappedBy="fonctionCa")
     */
    private $personnes;

    public function __construct()
    {
        $this->personnes = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFonctionCa(): ?string
    {
        return $this->fonctionCa;
    }

    public function setFonctionCa(string $fonctionCa): self
    {
        $this->fonctionCa = $fonctionCa;

        return $this;
    }

    /**
     * @return Collection|Personne[]
     */
    public function getPersonnes(): Collection
    {
        return $this->personnes;
    }

    public function addPersonne(Personne $personne): self
    {
        if (!$this->personnes->contains($personne)) {
            $this->personnes[] = $personne;
            $personne->setFonctionCa($this);
        }

        return $this;
    }

    public function removePersonne(Personne $personne): self
    {
        if ($this->personnes->contains($personne)) {
            $this->personnes->removeElement($personne);
            // set the owning side to null (unless already changed)
            if ($personne->getFonctionCa() === $this) {
                $personne->setFonctionCa(null);
            }
        }

        return $this;
    }
}
