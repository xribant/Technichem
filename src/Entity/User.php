<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\OneToMany(targetEntity: Page::class, mappedBy: 'last_modified_by')]
    private Collection $pages;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $reset_token = null;

    #[ORM\OneToMany(targetEntity: Product::class, mappedBy: 'last_modified_by')]
    private Collection $products;

    #[ORM\OneToMany(targetEntity: ProductCategory::class, mappedBy: 'last_modified_by')]
    private Collection $productCategories;

    #[ORM\OneToMany(targetEntity: Label::class, mappedBy: 'last_modifed_by')]
    private Collection $labels;

    #[ORM\OneToMany(targetEntity: Support::class, mappedBy: 'last_modified_by')]
    private Collection $supports;

    #[ORM\OneToMany(targetEntity: Packaging::class, mappedBy: 'last_modified_by')]
    private Collection $packagings;

    public function __construct()
    {
        $this->created_at = new DateTimeImmutable();
        $this->updated_at = new DateTimeImmutable();
        $this->pages = new ArrayCollection();
        $this->products = new ArrayCollection();
        $this->productCategories = new ArrayCollection();
        $this->labels = new ArrayCollection();
        $this->supports = new ArrayCollection();
        $this->packagings = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getFullName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
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
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
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

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFullName(): ?string 
    {
        return $this->firstName.' '.$this->lastName; 
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return Collection<int, Page>
     */
    public function getPages(): Collection
    {
        return $this->pages;
    }

    public function addPage(Page $page): static
    {
        if (!$this->pages->contains($page)) {
            $this->pages->add($page);
            $page->setLastModifiedBy($this);
        }

        return $this;
    }

    public function removePage(Page $page): static
    {
        if ($this->pages->removeElement($page)) {
            // set the owning side to null (unless already changed)
            if ($page->getLastModifiedBy() === $this) {
                $page->setLastModifiedBy(null);
            }
        }

        return $this;
    }

    public function getResetToken(): ?string
    {
        return $this->reset_token;
    }

    public function setResetToken(?string $reset_token): static
    {
        $this->reset_token = $reset_token;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): static
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->setLastModifiedBy($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): static
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getLastModifiedBy() === $this) {
                $product->setLastModifiedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProductCategory>
     */
    public function getProductCategories(): Collection
    {
        return $this->productCategories;
    }

    public function addProductCategory(ProductCategory $productCategory): static
    {
        if (!$this->productCategories->contains($productCategory)) {
            $this->productCategories->add($productCategory);
            $productCategory->setLastModifiedBy($this);
        }

        return $this;
    }

    public function removeProductCategory(ProductCategory $productCategory): static
    {
        if ($this->productCategories->removeElement($productCategory)) {
            // set the owning side to null (unless already changed)
            if ($productCategory->getLastModifiedBy() === $this) {
                $productCategory->setLastModifiedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Label>
     */
    public function getLabels(): Collection
    {
        return $this->labels;
    }

    public function addLabel(Label $label): static
    {
        if (!$this->labels->contains($label)) {
            $this->labels->add($label);
            $label->setLastModifedBy($this);
        }

        return $this;
    }

    public function removeLabel(Label $label): static
    {
        if ($this->labels->removeElement($label)) {
            // set the owning side to null (unless already changed)
            if ($label->getLastModifedBy() === $this) {
                $label->setLastModifedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Support>
     */
    public function getSupports(): Collection
    {
        return $this->supports;
    }

    public function addSupport(Support $support): static
    {
        if (!$this->supports->contains($support)) {
            $this->supports->add($support);
            $support->setLastModifiedBy($this);
        }

        return $this;
    }

    public function removeSupport(Support $support): static
    {
        if ($this->supports->removeElement($support)) {
            // set the owning side to null (unless already changed)
            if ($support->getLastModifiedBy() === $this) {
                $support->setLastModifiedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Packaging>
     */
    public function getPackagings(): Collection
    {
        return $this->packagings;
    }

    public function addPackaging(Packaging $packaging): static
    {
        if (!$this->packagings->contains($packaging)) {
            $this->packagings->add($packaging);
            $packaging->setLastModifiedBy($this);
        }

        return $this;
    }

    public function removePackaging(Packaging $packaging): static
    {
        if ($this->packagings->removeElement($packaging)) {
            // set the owning side to null (unless already changed)
            if ($packaging->getLastModifiedBy() === $this) {
                $packaging->setLastModifiedBy(null);
            }
        }

        return $this;
    }
}
