<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ModeVersementRepository")
 */
class ModeVersement
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
    private $modeVersement;

    public function getId()
    {
        return $this->id;
    }

    public function getModeVersement(): ?string
    {
        return $this->modeVersement;
    }

    public function setModeVersement(string $modeVersement): self
    {
        $this->modeVersement = $modeVersement;

        return $this;
    }
}
