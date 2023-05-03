<?php

namespace App\Entity;

use App\Repository\EchangeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EchangeRepository::class)]
class Echange
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?Produit $produit = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id_user')]
    private ?User $user = null;

    #[ORM\Column(length: 255)]
    private ?string $Statut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateEchange = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: 'user_request_id', referencedColumnName: 'id_user')]
    private ?User $userRequest = null;

    #[ORM\ManyToOne]
    private ?produit $produitRequest = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

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

    public function getStatut(): ?string
    {
        return $this->Statut;
    }

    public function setStatut(string $Statut): self
    {
        $this->Statut = $Statut;

        return $this;
    }

    public function getDateEchange(): ?\DateTimeInterface
    {
        return $this->DateEchange;
    }

    public function setDateEchange(\DateTimeInterface $DateEchange): self
    {
        $this->DateEchange = $DateEchange;

        return $this;
    }

    public function getUserRequest(): ?User
    {
        return $this->userRequest;
    }

    public function setUserRequest(?User $userRequest): self
    {
        $this->userRequest = $userRequest;

        return $this;
    }

    public function getProduitRequest(): ?produit
    {
        return $this->produitRequest;
    }

    public function setProduitRequest(?produit $produitRequest): self
    {
        $this->produitRequest = $produitRequest;

        return $this;
    }
}
