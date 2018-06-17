<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeAdherentRepository")
 */
class TypeAdherent
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
    private $typeAdherent;

    public function getId()
    {
        return $this->id;
    }

    public function getTypeAdherent(): ?string
    {
        return $this->typeAdherent;
    }

    public function setTypeAdherent(string $typeAdherent): self
    {
        $this->typeAdherent = $typeAdherent;

        return $this;
    }
}
