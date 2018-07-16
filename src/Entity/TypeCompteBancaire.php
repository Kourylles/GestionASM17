<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeCompteBancaireRepository")
 */
class TypeCompteBancaire
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
    private $typeDeCompte;

    public function getId()
    {
        return $this->id;
    }

    public function getTypeDeCompte(): ?string
    {
        return $this->typeDeCompte;
    }

    public function setTypeDeCompte(string $typeDeCompte): self
    {
        $this->typeDeCompte = $typeDeCompte;

        return $this;
    }
}
