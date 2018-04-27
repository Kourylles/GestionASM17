<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeDeRecetteRepository")
 */
class TypeDeRecette
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
    private $typeDeRecette;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Recette", mappedBy="typeDeRecette")
     */
    private $recettes;

    public function __construct()
    {
        $this->recettes = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTypeDeRecette(): ?string
    {
        return $this->typeDeRecette;
    }

    public function setTypeDeRecette(string $typeDeRecette): self
    {
        $this->typeDeRecette = $typeDeRecette;

        return $this;
    }

    /**
     * @return Collection|Recette[]
     */
    public function getRecettes(): Collection
    {
        return $this->recettes;
    }

    public function addRecette(Recette $recette): self
    {
        if (!$this->recettes->contains($recette)) {
            $this->recettes[] = $recette;
            $recette->setTypeDeRecette($this);
        }

        return $this;
    }

    public function removeRecette(Recette $recette): self
    {
        if ($this->recettes->contains($recette)) {
            $this->recettes->removeElement($recette);
            // set the owning side to null (unless already changed)
            if ($recette->getTypeDeRecette() === $this) {
                $recette->setTypeDeRecette(null);
            }
        }

        return $this;
    }
}
