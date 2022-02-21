<?php

namespace App\Entity;

use App\Repository\TarifRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TarifRepository::class)]
class Tarif
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $prix_unitaire;

    #[ORM\Column(type: 'string', length: 50)]
    private $type_prix;

    #[ORM\ManyToOne(targetEntity: ProduitConditionnement::class, inversedBy: 'tarifs')]
    #[ORM\JoinColumn(nullable: false)]
    private $produit_conditionnement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixUnitaire(): ?int
    {
        return $this->prix_unitaire;
    }

    public function setPrixUnitaire(?int $prix_unitaire): self
    {
        $this->prix_unitaire = $prix_unitaire;

        return $this;
    }

    public function getTypePrix(): ?string
    {
        return $this->type_prix;
    }

    public function setTypePrix(string $type_prix): self
    {
        $this->type_prix = $type_prix;

        return $this;
    }

    public function getProduitConditionnement(): ?ProduitConditionnement
    {
        return $this->produit_conditionnement;
    }

    public function setProduitConditionnement(?ProduitConditionnement $produit_conditionnement): self
    {
        $this->produit_conditionnement = $produit_conditionnement;

        return $this;
    }
}
