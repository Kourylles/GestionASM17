<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExerciceComptableEnCoursRepository")
 */
class ExerciceComptableEnCours
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
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
