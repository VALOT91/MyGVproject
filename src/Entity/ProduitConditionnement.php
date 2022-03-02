<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\ProduitConditionnementRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @UniqueEntity(fields={"reference"}, message="Il y a déja une reference identique")
 */
#[ORM\Entity(repositoryClass: ProduitConditionnementRepository::class)]
class ProduitConditionnement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $reference;

    #[ORM\Column(type: 'string', length: 255)]
    private $image_path;

    #[ORM\ManyToOne(inversedBy: 'produit', targetEntity: Conditionnement::class)]
    #[ORM\JoinColumn(nullable: true)]
    private $conditionnement;

    // #[ORM\OneToOne(inversedBy: 'produitConditionnement', targetEntity: Product::class, cascade: ['remove'])]
    #[ORM\OneToOne(inversedBy: 'produitConditionnement', targetEntity: Product::class )]
    #[ORM\JoinColumn(nullable: false )]
    private $produit;

    #[ORM\OneToMany(mappedBy: 'produit_conditionnement', targetEntity: Tarif::class, cascade: ['remove'])]
    private $tarifs;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $quantiteStock;

  
    public function __construct()
    {
        $this->tarifs = new ArrayCollection();
        // $this->recettes = new ArrayCollection();
       
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getImagePath(): ?string
    {
        return $this->image_path;
    }

    public function setImagePath(?string $image_path): self
    {
        $this->image_path = $image_path;

        return $this;
    }

    public function getConditionnement(): ?Conditionnement
    {
        return $this->conditionnement;
    }

    public function setConditionnement(Conditionnement $conditionnement): self
    {
        $this->conditionnement = $conditionnement;

        return $this;
    }

    public function getProduit(): ?Product
    {
        return $this->produit;
    }

    public function setProduit(Product $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * @return Collection|Tarif[]
     */
    public function getTarifs(): Collection
    {
        return $this->tarifs;
    }

    public function addTarif(Tarif $tarif): self
    {
        if (!$this->tarifs->contains($tarif)) {
            $this->tarifs[] = $tarif;
            $tarif->setProduitConditionnement($this);
        }

        return $this;
    }

    public function removeTarif(Tarif $tarif): self
    {
        if ($this->tarifs->removeElement($tarif)) {
            // set the owning side to null (unless already changed)
            if ($tarif->getProduitConditionnement() === $this) {
                $tarif->setProduitConditionnement(null);
            }
        }

        return $this;
    }

    public function getQuantiteStock(): ?int
    {
        return $this->quantiteStock;
    }

    public function setQuantiteStock(?int $quantiteStock): self
    {
        $this->quantiteStock = $quantiteStock;

        return $this;
    }
 
    
    

    
}
