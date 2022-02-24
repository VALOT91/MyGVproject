<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $designation;

    #[ORM\Column(type: 'string', length: 500)]
    private $description;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $accroche;

    #[ORM\Column(type: 'string', length: 500)]
    private $composition;

    #[ORM\Column(type: 'string', length: 255)]
    private $reco_dose;

    #[ORM\Column(type: 'string', length: 255)]
    private $reco_usage;

    #[ORM\Column(type: 'string', length: 255)]
    private $reco_duree;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $video_path;

    #[ORM\Column(type: 'boolean')]
    private $is_bio;

    #[ORM\Column(type: 'string', length: 50)]
    private $origine;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $role;

    #[ORM\Column(type: 'string', length: 500, nullable: true)]
    private $resume;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $parent;

    #[ORM\ManyToOne(targetEntity: Category::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $category;

    #[ORM\OneToOne(mappedBy: 'produit', targetEntity: ProduitConditionnement::class, cascade: ['persist', 'remove'])]
    private $produitConditionnement;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: Recette::class)]
    private $recette;

    #[ORM\Column(type: 'string', length: 255)]
    private $reco_Temp;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: CommandShopLine::class)]
    private $commandShopLines;

    public function __construct()
    {
        $this->recette = new ArrayCollection();
        $this->commandShopLines = new ArrayCollection();
    }

    // #[ORM\OneToMany(mappedBy: 'product', targetEntity: Recette::class)]
    // private $recettes;

    // public function __construct()
    // {
    //     $this->recettes = new ArrayCollection();
    // }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAccroche(): ?string
    {
        return $this->accroche;
    }

    public function setAccroche(?string $accroche): self
    {
        $this->accroche = $accroche;

        return $this;
    }

    public function getComposition(): ?string
    {
        return $this->composition;
    }

    public function setComposition(string $composition): self
    {
        $this->composition = $composition;

        return $this;
    }

    public function getRecoDose(): ?string
    {
        return $this->reco_dose;
    }

    public function setRecoDose(string $reco_dose): self
    {
        $this->reco_dose = $reco_dose;

        return $this;
    }

    public function getRecoUsage(): ?string
    {
        return $this->reco_usage;
    }

    public function setRecoUsage(string $reco_usage): self
    {
        $this->reco_usage = $reco_usage;

        return $this;
    }

    public function getRecoDuree(): ?string
    {
        return $this->reco_duree;
    }

    public function setRecoDuree(string $reco_duree): self
    {
        $this->reco_duree = $reco_duree;

        return $this;
    }

    public function getVideoPath(): ?string
    {
        return $this->video_path;
    }

    public function setVideoPath(?string $video_path): self
    {
        $this->video_path = $video_path;

        return $this;
    }

    public function getIsBio(): bool
    {
        return $this->is_bio;
    }

    public function setIsBio(bool $is_bio): self
    {
        $this->is_bio = $is_bio;

        return $this;
    }

    public function getOrigine(): ?string
    {
        return $this->origine;
    }

    public function setOrigine(string $origine): self
    {
        $this->origine = $origine;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(?string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    public function getParent(): ?bool
    {
        return $this->parent;
    }

    public function setParent(bool $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getProduitConditionnement(): ?ProduitConditionnement
    {
        return $this->produitConditionnement;
    }

    public function setProduitConditionnement(ProduitConditionnement $produitConditionnement): self
    {
        // set the owning side of the relation if necessary
        if ($produitConditionnement->getProduit() !== $this) {
            $produitConditionnement->setProduit($this);
        }

        $this->produitConditionnement = $produitConditionnement;

        return $this;
    }

   
    /**
     * @return Collection|Recette[]
     */
    public function getRecette(): Collection
    {
        return $this->recette;
    }

    public function addRecette(Recette $recette): self
    {
        if (!$this->recette->contains($recette)) {
            $this->recette[] = $recette;
            $recette->setProduct($this);
        }

        return $this;
    }

    public function removeRecette(Recette $recette): self
    {
        if ($this->recette->removeElement($recette)) {
            // set the owning side to null (unless already changed)
            if ($recette->getProduct() === $this) {
                $recette->setProduct(null);
            }
        }

        return $this;
    }

    public function getRecoTemp(): ?string
    {
        return $this->reco_Temp;
    }

    public function setRecoTemp(string $reco_Temp): self
    {
        $this->reco_Temp = $reco_Temp;

        return $this;
    }

    /**
     * @return Collection|CommandShopLine[]
     */
    public function getCommandShopLines(): Collection
    {
        return $this->commandShopLines;
    }

    public function addCommandShopLine(CommandShopLine $commandShopLine): self
    {
        if (!$this->commandShopLines->contains($commandShopLine)) {
            $this->commandShopLines[] = $commandShopLine;
            $commandShopLine->setProduit($this);
        }

        return $this;
    }

    public function removeCommandShopLine(CommandShopLine $commandShopLine): self
    {
        if ($this->commandShopLines->removeElement($commandShopLine)) {
            // set the owning side to null (unless already changed)
            if ($commandShopLine->getProduit() === $this) {
                $commandShopLine->setProduit(null);
            }
        }

        return $this;
    }

}
