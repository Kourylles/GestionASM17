<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MontantCotisationRepository")
 */
class MontantCotisation
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
    private $montantCotisation;

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
}
