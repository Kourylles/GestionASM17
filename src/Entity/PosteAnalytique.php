<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PosteAnalytiqueRepository")
 */
class PosteAnalytique
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
    private $posteAnalytique;

    public function getId()
    {
        return $this->id;
    }

    public function getPosteAnalytique(): ?string
    {
        return $this->posteAnalytique;
    }

    public function setPosteAnalytique(string $posteAnalytique): self
    {
        $this->posteAnalytique = $posteAnalytique;

        return $this;
    }
}
