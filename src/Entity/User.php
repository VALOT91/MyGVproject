<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @UniqueEntity(fields={"email"}, message="Il y a déja un compte avec cet email")
 */
#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;
    
    #[Assert\NotBlank(message:'Vous devez ajouter un email.')]
    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[Assert\NotBlank(message:'Vous devez ajouter un mot de passe.')]
    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'string', length: 255)]
    private $adresse;

    #[ORM\Column(type: 'integer')]
    private $code_postal;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $complement;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $prenom;

    #[ORM\Column(type: 'string', length: 255)]
    private $telephone;

    #[ORM\Column(type: 'string', length: 255)]
    private $ville;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $points_fidelite;

    #[ORM\Column(type: 'string', length: 4, nullable: true)]
    private $pays;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private $rang_fidelite;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $kbis;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: CommandShop::class)]
    private $commandShops;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tokenConfirmationEmail;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isConfirmed;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tokenPasswordLost;

    public function __construct()
    {
        $this->commandShops = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = '';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->code_postal;
    }

    public function setCodePostal(int $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getComplement(): ?string
    {
        return $this->complement;
    }

    public function setComplement(?string $complement): self
    {
        $this->complement = $complement;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPointsFidelite(): ?int
    {
        return $this->points_fidelite;
    }

    public function setPointsFidelite(?int $points_fidelite): self
    {
        $this->points_fidelite = $points_fidelite;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(?string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getRangFidelite(): ?string
    {
        return $this->rang_fidelite;
    }

    public function setRangFidelite(?string $rang_fidelite): self
    {
        $this->rang_fidelite = $rang_fidelite;

        return $this;
    }

    public function getKbis(): ?string
    {
        return $this->kbis;
    }

    public function setKbis(?string $kbis): self
    {
        $this->kbis = $kbis;

        return $this;
    }

    /**
     * @return Collection|CommandShop[]
     */
    public function getCommandShops(): Collection
    {
        return $this->commandShops;
    }

    public function addCommandShop(CommandShop $commandShop): self
    {
        if (!$this->commandShops->contains($commandShop)) {
            $this->commandShops[] = $commandShop;
            $commandShop->setUser($this);
        }

        return $this;
    }

    public function removeCommandShop(CommandShop $commandShop): self
    {
        if ($this->commandShops->removeElement($commandShop)) {
            // set the owning side to null (unless already changed)
            if ($commandShop->getUser() === $this) {
                $commandShop->setUser(null);
            }
        }

        return $this;
    }

    public function getTokenConfirmationEmail(): ?string
    {
        return $this->tokenConfirmationEmail;
    }

    public function setTokenConfirmationEmail(?string $tokenConfirmationEmail): self
    {
        $this->tokenConfirmationEmail = $tokenConfirmationEmail;

        return $this;
    }

    public function getIsConfirmed(): ?bool
    {
        return $this->isConfirmed;
    }

    public function setIsConfirmed(?bool $isConfirmed): self
    {
        $this->isConfirmed = $isConfirmed;

        return $this;
    }

    public function getTokenPasswordLost(): ?string
    {
        return $this->tokenPasswordLost;
    }

    public function setTokenPasswordLost(?string $tokenPasswordLost): self
    {
        $this->tokenPasswordLost = $tokenPasswordLost;

        return $this;
    }
}
