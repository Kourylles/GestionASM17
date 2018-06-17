<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CoordonneesRepository")
 */
class Coordonnees
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ligneAdr1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ligneAdr2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ligneAdr3;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pays;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $telephone1;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $telephone2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email2;


    public function getId()
    {
        return $this->id;
    }

    public function getLigneAdr1(): ?string
    {
        return $this->ligneAdr1;
    }

    public function setLigneAdr1(?string $LigneAdr1): self
    {
        $this->ligneAdr1 = $LigneAdr1;

        return $this;
    }

    public function getLigneAdr2(): ?string
    {
        return $this->ligneAdr2;
    }

    public function setLigneAdr2(?string $LigneAdr2): self
    {
        $this->ligneAdr2 = $LigneAdr2;

        return $this;
    }

    public function getLigneAdr3(): ?string
    {
        return $this->ligneAdr3;
    }

    public function setLigneAdr3(?string $LigneAdr3): self
    {
        $this->ligneAdr3 = $LigneAdr3;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $CodePostal): self
    {
        $this->CodePostal = $CodePostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $Ville): self
    {
        $this->ville = $Ville;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(?string $Pays): self
    {
        $this->pays = $Pays;

        return $this;
    }

    public function getTelephone1(): ?string
    {
        return $this->telephone1;
    }

    public function setTelephone1(?string $Telephone1): self
    {
        $this->telephone1 = $Telephone1;

        return $this;
    }

    public function getTelephone2(): ?string
    {
        return $this->telephone2;
    }

    public function setTelephone2(?string $Telephone2): self
    {
        $this->telephone2 = $Telephone2;

        return $this;
    }

    public function getEmail1(): ?string
    {
        return $this->email1;
    }

    public function setEmail1(?string $Email1): self
    {
        $this->email1 = $Email1;

        return $this;
    }

    public function getEmail2(): ?string
    {
        return $this->email2;
    }

    public function setEmail2(?string $Email2): self
    {
        $this->email2 = $Email2;

        return $this;
    }

   
}
