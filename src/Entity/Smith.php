<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SmithRepository")
 */
class Smith
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
    private $prenomSmith;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateNaissanceSmith;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Membre", mappedBy="smithLie")
     */
    private $membreLie;

    public function __construct()
    {
        $this->membreLie = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPrenomSmith(): ?string
    {
        return $this->prenomSmith;
    }

    public function setPrenomSmith(string $prenomSmith): self
    {
        $this->prenomSmith = $prenomSmith;

        return $this;
    }

    public function getDateNaissanceSmith(): ?\DateTimeInterface
    {
        return $this->dateNaissanceSmith;
    }

    public function setDateNaissanceSmith(?\DateTimeInterface $dateNaissanceSmith): self
    {
        $this->dateNaissanceSmith = $dateNaissanceSmith;

        return $this;
    }

    /**
     * @return Collection|Membre[]
     */
    public function getMembreLie(): Collection
    {
        return $this->membreLie;
    }

    public function addMembreLie(Membre $membreLie): self
    {
        if (!$this->membreLie->contains($membreLie)) {
            $this->membreLie[] = $membreLie;
            $membreLie->setSmithLie($this);
        }

        return $this;
    }

    public function removeMembreLie(Membre $membreLie): self
    {
        if ($this->membreLie->contains($membreLie)) {
            $this->membreLie->removeElement($membreLie);
            // set the owning side to null (unless already changed)
            if ($membreLie->getSmithLie() === $this) {
                $membreLie->setSmithLie(null);
            }
        }

        return $this;
    }
}
