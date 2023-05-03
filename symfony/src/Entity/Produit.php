<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['Produit', 'posts:read'])]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id_user')]
    private ?User $User = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Category is required")]
    #[Assert\Length(min: 3, minMessage: "Category can't be less than {{ limit }} characters",)]
    #[Groups(['Produit', 'posts:read'])]
    private ?string $Categorie = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"Valeur is required")]
    #[Assert\Positive]
    #[Groups(['Produit', 'posts:read'])]
    private ?int $Valeur = null;

    #[ORM\Column(length: 255)]
    #[Groups(['Produit', 'posts:read'])]
    private ?string $Image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->Categorie;
    }

    public function setCategorie(?string $Categorie): self
    {
        $this->Categorie = $Categorie;

        return $this;
    }

    public function getValeur(): ?int
    {
        return $this->Valeur;
    }

    public function setValeur(?int $Valeur): self
    {
        $this->Valeur = $Valeur;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }
}
