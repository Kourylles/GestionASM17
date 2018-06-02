<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExerciceComptableEnCoursRepository")
 */
class ExerciceComptableEnCours
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $exerciceEnCours;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDeModif;

    public function getId()
    {
        return $this->id;
    }

    public function getExerciceEnCours(): ?string
    {
        return $this->exerciceEnCours;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setExerciceEnCours(string $ExerciceEnCours): self
    {
        $this->exerciceEnCours = $ExerciceEnCours;

        return $this;
    }

    public function getDateDeModif(): ?\DateTimeInterface
    {
        return $this->dateDeModif;
    }

    public function setDateDeModif(\DateTimeInterface $dateDeModif): self
    {
        $this->dateDeModif = $dateDeModif;

        return $this;
    }
}
