<?php

namespace App\Entity;

// Entité Conditionnement

use App\Repository\ConditionnementRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @UniqueEntity(fields={"reference"}, message="Il y a déja une reference identique")
 */

#[ORM\Entity(repositoryClass: ConditionnementRepository::class)]
class Conditionnement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $reference;

    #[ORM\Column(type: 'string', length: 50)]
    private $designation;

    #[ORM\Column(type: 'integer')]
    private $poids;

   
    #[ORM\OneToOne(mappedBy: 'conditionnement', targetEntity: ProduitConditionnement::class, cascade: ['persist', 'remove'])]
    private $produit;

    #[ORM\Column(type: 'string', length: 255)]
    private $imagePath;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(?string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(?string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getPoids(): ?int
    {
        return $this->poids;
    }

    public function setPoids(?int $poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    
    public function getProduit(): ?ProduitConditionnement
    {
        return $this->produit;
    }

    public function setProduit(ProduitConditionnement $produit): self
    {
        // set the owning side of the relation if necessary
        if ($produit->getConditionnement() !== $this) {
            $produit->setConditionnement($this);
        }

        $this->produit = $produit;

        return $this;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(?string $imagePath): self
    {
        $this->imagePath = $imagePath;

        return $this;
    }
}
