<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParenteRepository")
 */
class Parente
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
    private $typeParente;

    public function getId()
    {
        return $this->id;
    }

    public function getTypeParente(): ?string
    {
        return $this->typeParente;
    }

    public function setTypeParente(string $typeParente): self
    {
        $this->typeParente = $typeParente;

        return $this;
    }
}
