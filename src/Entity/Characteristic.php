<?php

namespace App\Entity;

use App\Repository\CharacteristicRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CharacteristicRepository::class)
 */
class Characteristic
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $cendres;

    /**
     * @ORM\Column(type="integer")
     */
    private $eau;

    /**
     * @ORM\Column(type="integer")
     */
    private $fibre;

    /**
     * @ORM\Column(type="integer")
     */
    private $glucide;

    /**
     * @ORM\Column(type="integer")
     */
    private $lipide;

    /**
     * @ORM\Column(type="integer")
     */
    private $proteine;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCendres(): ?int
    {
        return $this->cendres;
    }

    public function setCendres(int $cendres): self
    {
        $this->cendres = $cendres;

        return $this;
    }

    public function getEau(): ?int
    {
        return $this->eau;
    }

    public function setEau(int $eau): self
    {
        $this->eau = $eau;

        return $this;
    }

    public function getFibre(): ?int
    {
        return $this->fibre;
    }

    public function setFibre(int $fibre): self
    {
        $this->fibre = $fibre;

        return $this;
    }

    public function getGlucide(): ?int
    {
        return $this->glucide;
    }

    public function setGlucide(int $glucide): self
    {
        $this->glucide = $glucide;

        return $this;
    }

    public function getLipide(): ?int
    {
        return $this->lipide;
    }

    public function setLipide(int $lipide): self
    {
        $this->lipide = $lipide;

        return $this;
    }

    public function getProteine(): ?int
    {
        return $this->proteine;
    }

    public function setProteine(int $proteine): self
    {
        $this->proteine = $proteine;

        return $this;
    }
}
