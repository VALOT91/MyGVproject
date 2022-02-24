<?php

namespace App\Entity;

use App\Repository\CommandShopRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandShopRepository::class)]
class CommandShop
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isPayed;

    #[ORM\Column(type: 'integer')]
    private $totalPrice;

    #[ORM\OneToOne(targetEntity: DeliveryAddress::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $deliveryAddress;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'commandShops')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\OneToMany(mappedBy: 'commandShop', targetEntity: CommandShopLine::class)]
    private $commandShopLines;

    public function __construct()
    {
        $this->commandShopLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getIsPayed(): ?bool
    {
        return $this->isPayed;
    }

    public function setIsPayed(?bool $isPayed): self
    {
        $this->isPayed = $isPayed;

        return $this;
    }

    public function getTotalPrice(): ?int
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(int $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function getDeliveryAddress(): ?DeliveryAddress
    {
        return $this->deliveryAddress;
    }

    public function setDeliveryAddress(DeliveryAddress $deliveryAddress): self
    {
        $this->deliveryAddress = $deliveryAddress;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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
            $commandShopLine->setCommandShop($this);
        }

        return $this;
    }

    public function removeCommandShopLine(CommandShopLine $commandShopLine): self
    {
        if ($this->commandShopLines->removeElement($commandShopLine)) {
            // set the owning side to null (unless already changed)
            if ($commandShopLine->getCommandShop() === $this) {
                $commandShopLine->setCommandShop(null);
            }
        }

        return $this;
    }
}
