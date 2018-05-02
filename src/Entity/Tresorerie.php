<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TresorerieRepository")
 */
class Tresorerie
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
    private $compteDebite;

    public function getId()
    {
        return $this->id;
    }

    public function getCompteDebite(): ?string
    {
        return $this->compteDebite;
    }

    public function setCompteDebite(string $compteDebite): self
    {
        $this->compteDebite = $compteDebite;

        return $this;
    }
}
