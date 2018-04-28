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
}
