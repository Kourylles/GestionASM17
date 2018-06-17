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

   

    
}
