<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeRecetteRepository")
 */
class TypeRecette
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
    private $typeDeRecette;

    public function getId()
    {
        return $this->id;
    }

    public function getTypeDeRecette(): ?string
    {
        return $this->typeDeRecette;
    }

    public function setTypeDeRecette(string $TypeDeRecette): self
    {
        $this->typeDeRecette = $TypeDeRecette;

        return $this;
    }
}
