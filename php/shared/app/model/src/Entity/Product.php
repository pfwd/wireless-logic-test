<?php

namespace App\Model\Entity;

use App\Model\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $heading = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $price = null;

    #[ORM\Column(nullable: true)]
    private ?int $priceInPence = null;

    #[ORM\Column(nullable: true)]
    private ?int $annualPrice = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $discount = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeading(): ?string
    {
        return $this->heading;
    }

    public function setHeading(?string $heading): self
    {
        $this->heading = $heading;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPriceInPence(): ?int
    {
        return $this->priceInPence;
    }

    public function setPriceInPence(?int $priceInPence): self
    {
        $this->priceInPence = $priceInPence;

        return $this;
    }

    public function getAnnualPrice(): ?int
    {
        return $this->annualPrice;
    }

    public function setAnnualPrice(?int $annualPrice): self
    {
        $this->annualPrice = $annualPrice;

        return $this;
    }

    public function getDiscount(): ?string
    {
        return $this->discount;
    }

    public function setDiscount(?string $discount): self
    {
        $this->discount = $discount;

        return $this;
    }
}
