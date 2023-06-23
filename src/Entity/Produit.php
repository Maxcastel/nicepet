<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $urlimage;

    /**
     * @ORM\Column(type="boolean")
     */
    private $validate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sterilise;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $product_id;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getUrlimage(): ?string
    {
        return $this->urlimage;
    }

    public function setUrlimage(?string $urlimage): self
    {
        $this->urlimage = $urlimage;

        return $this;
    }

    public function isValidate(): ?bool
    {
        return $this->validate;
    }

    public function setValidate(bool $validate): self
    {
        $this->validate = $validate;

        return $this;
    }

    public function isSterilise(): ?bool
    {
        return $this->sterilise;
    }

    public function setSterilise(bool $sterilise): self
    {
        $this->sterilise = $sterilise;

        return $this;
    }

    public function getProductId(): ?string
    {
        return $this->product_id;
    }

    public function setProductId(?string $product_id): self
    {
        $this->product_id = $product_id;

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
