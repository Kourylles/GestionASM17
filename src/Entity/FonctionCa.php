<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FonctionCaRepository")
 */
class FonctionCa
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
    private $fonctionDansLeCa;

    public function getId()
    {
        return $this->id;
    }

    public function getFonctionDansLeCa(): ?string
    {
        return $this->fonctionDansLeCa;
    }

    public function setFonctionDansLeCa(string $FonctionDansLeCa): self
    {
        $this->fonctionDansLeCa = $FonctionDansLeCa;

        return $this;
    }
}
