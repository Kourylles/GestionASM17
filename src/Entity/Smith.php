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
     * @ORM\Column(type="text", nullable=true)
     */
    private $observationsSmith;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Membre", mappedBy="smithLie")
     */
    private $idMembre;

    public function __construct()
    {
        $this->idMembre = new ArrayCollection();
    }

   

//Ascesseurs et mutateurs
    public function getId()
    {
        return $this->id;
    }

    public function getPrenomSmith(): ?string
    {
        return $this->prenomSmith;
    }

    public function setPrenomSmith(string $PrenomSmith): self
    {
        $this->prenomSmith = $PrenomSmith;

        return $this;
    }

    public function getDateNaissanceSmith(): ?\DateTimeInterface
    {
        return $this->dateNaissanceSmith;
    }

    public function setDateNaissanceSmith(?\DateTimeInterface $DateNaissanceSmith): self
    {
        $this->dateNaissanceSmith = $DateNaissanceSmith;

        return $this;
    }

    public function getObservationsSmith(): ?string
    {
        return $this->observationsSmith;
    }

    public function setObservationsSmith(?string $ObservationsSmith): self
    {
        $this->observationsSmith = $ObservationsSmith;

        return $this;
    }

//Calcul de l'age d'un smith en fonction de sa date de naissance

    public function getAge()
    {
        $dateInterval = $this->dateNaissanceSmith->diff(new \DateTime());
 
        return $dateInterval->y;
    }

    /**
     * @return Collection|Membre[]
     */
    public function getIdMembre(): Collection
    {
        return $this->idMembre;
    }

    public function addIdMembre(Membre $idMembre): self
    {
        if (!$this->idMembre->contains($idMembre)) {
            $this->idMembre[] = $idMembre;
            $idMembre->setSmithLie($this);
        }

        return $this;
    }

    public function removeIdMembre(Membre $idMembre): self
    {
        if ($this->idMembre->contains($idMembre)) {
            $this->idMembre->removeElement($idMembre);
            // set the owning side to null (unless already changed)
            if ($idMembre->getSmithLie() === $this) {
                $idMembre->setSmithLie(null);
            }
        }

        return $this;
    }

    
}
