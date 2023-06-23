<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type_pet;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modify_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypePet(): ?string
    {
        return $this->type_pet;
    }

    public function setTypePet(string $type_pet): self
    {
        $this->type_pet = $type_pet;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getModifyAt(): ?\DateTimeInterface
    {
        return $this->modify_at;
    }

    public function setModifyAt(?\DateTimeInterface $modify_at): self
    {
        $this->modify_at = $modify_at; 

        return $this;
    }
}
