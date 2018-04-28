<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LienParenteRepository")
 */
class LienParente
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
    private $lienDeParente;

    public function getId()
    {
        return $this->id;
    }

    public function getLienDeParente(): ?string
    {
        return $this->lienDeParente;
    }

    public function setLienDeParente(string $LienDeParente): self
    {
        $this->lienDeParente = $LienDeParente;

        return $this;
    }
}
