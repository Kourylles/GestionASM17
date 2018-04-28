<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ModePaiementRepository")
 */
class ModePaiement
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
    private $modeDePaiement;

    public function getId()
    {
        return $this->id;
    }

    public function getModeDePaiement(): ?string
    {
        return $this->modeDePaiement;
    }

    public function setModeDePaiement(string $ModeDePaiement): self
    {
        $this->modeDePaiement = $ModeDePaiement;

        return $this;
    }
}
