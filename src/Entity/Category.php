<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @UniqueEntity(fields={"nom"}, message="Il y a déja une catégorie identique")
 */

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    private $products;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\Column(type: 'string', length: 255)]
    private $image_path_1;

    #[ORM\Column(type: 'string', length: 255)]
    private $image_path_2;

    #[ORM\Column(type: 'string', length: 255)]
    private $image_path_3;

    #[ORM\Column(type: 'string', length: 2)]
    private $gamme;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImagePath1(): ?string
    {
        return $this->image_path_1;
    }

    public function setImagePath1(?string $image_path_1): self
    {
        $this->image_path_1 = $image_path_1;

        return $this;
    }

    public function getImagePath2(): ?string
    {
        return $this->image_path_2;
    }

    public function setImagePath2(?string $image_path_2): self
    {
        $this->image_path_2 = $image_path_2;

        return $this;
    }

    public function getImagePath3(): ?string
    {
        return $this->image_path_3;
    }

    public function setImagePath3(?string $image_path_3): self
    {
        $this->image_path_3 = $image_path_3;

        return $this;
    }

    // public function getImagePath(): ?string
    // {
    //     return $this->image_path_3;
    // }

    // public function setImagePath(?string $image_path_3): self
    // {
    //     $this->image_path_3 = $image_path_3;

    //     return $this;
    // }

    public function getGamme(): ?string
    {
        return $this->gamme;
    }

    public function setGamme(string $gamme): self
    {
        $this->gamme = $gamme;

        return $this;
    }


}
