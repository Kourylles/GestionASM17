<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExoComptPrecedentRepository")
 */
class ExoComptPrecedent
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
    private $exComptPrecedent;

    public function getId()
    {
        return $this->id;
    }

    public function getExComptPrecedent(): ?string
    {
        return $this->exComptPrecedent;
    }

    public function setExComptPrecedent(string $exComptPrecedent): self
    {
        $this->exComptPrecedent = $exComptPrecedent;

        return $this;
    }
}
