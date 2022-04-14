<?php

namespace App\Entity;

use App\Entity\Product;
use App\Entity\Commande;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommandeDetailsRepository;

#[ORM\Entity(repositoryClass: CommandeDetailsRepository::class)]
class CommandeDetails
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $product_quantity;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'commandeDetails')]
    #[ORM\JoinColumn(nullable: false)]
    private $id_product;

    #[ORM\ManyToOne(targetEntity: Commande::class, inversedBy: 'commandeDetails')]
    #[ORM\JoinColumn(nullable: false)]
    private $id_commande;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductQuantity(): ?int
    {
        return $this->product_quantity;
    }

    public function setProductQuantity(int $product_quantity): self
    {
        $this->product_quantity = $product_quantity;

        return $this;
    }

    public function getIdProduct(): ?Product
    {
        return $this->id_product;
    }

    public function setIdProduct(?Product $id_product): self
    {
        $this->id_product = $id_product;

        return $this;
    }

    public function getIdCommande(): ?Commande
    {
        return $this->id_commande;
    }

    public function setIdCommande(?Commande $id_commande): self
    {
        $this->id_commande = $id_commande;

        return $this;
    }
}
