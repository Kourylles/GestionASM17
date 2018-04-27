<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExerciceComptableDeReferenceRepository")
 */
class ExerciceComptableDeReference
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $exerciceComptable;

    public function getId()
    {
        return $this->id;
    }

    public function getExerciceComptable(): ?string
    {
        return $this->exerciceComptable;
    }

    public function setExerciceComptable(string $exerciceComptable): self
    {
        $this->exerciceComptable = $exerciceComptable;

        return $this;
    }
}
