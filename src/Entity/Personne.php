<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonneRepository")
 */
abstract class Personne
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $divers;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypePersonne", inversedBy="personnes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typePersonne;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Coordonnees", inversedBy="personnes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $coordonnees;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Parente")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeParente;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FonctionCA", inversedBy="personnes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fonctionCa;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Membre", mappedBy="personne", cascade={"persist", "remove"})
     */
    private $membre;

    // Getters et Setters

    public function getId()
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDivers(): ?string
    {
        return $this->divers;
    }

    public function setDivers(?string $divers): self
    {
        $this->divers = $divers;

        return $this;
    }

    public function getTypePersonne(): ?TypePersonne
    {
        return $this->typePersonne;
    }

    public function setTypePersonne(?TypePersonne $typePersonne): self
    {
        $this->typePersonne = $typePersonne;

        return $this;
    }

    public function getCoordonnees(): ?Coordonnees
    {
        return $this->coordonnees;
    }

    public function setCoordonnees(?Coordonnees $coordonnees): self
    {
        $this->coordonnees = $coordonnees;

        return $this;
    }

    public function getTypeParente(): ?Parente
    {
        return $this->typeParente;
    }

    public function setTypeParente(?Parente $typeParente): self
    {
        $this->typeParente = $typeParente;

        return $this;
    }

    public function getFonctionCa(): ?FonctionCA
    {
        return $this->fonctionCa;
    }

    public function setFonctionCa(?FonctionCA $fonctionCa): self
    {
        $this->fonctionCa = $fonctionCa;

        return $this;
    }

    public function getMembre(): ?Membre
    {
        return $this->membre;
    }

    public function setMembre(Membre $membre): self
    {
        $this->membre = $membre;

        // set the owning side of the relation if necessary
        if ($this !== $membre->getPersonne()) {
            $membre->setPersonne($this);
        }

        return $this;
    }
}
