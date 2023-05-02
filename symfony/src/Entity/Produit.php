<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit", indexes={@ORM\Index(name="fk_Iduser", columns={"ID_user"})})
 * @ORM\Entity
 */
class Produit
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_produit", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProduit;

    /**
     * @var int
     *
     * @ORM\Column(name="ID_user", type="integer", nullable=false)
     */
    private $idUser;

    /**
     * @var string
     *
     * @ORM\Column(name="Categorie", type="string", length=255, nullable=false)
     */
    private $categorie;

    /**
     * @var int
     *
     * @ORM\Column(name="Valeur", type="integer", nullable=false)
     */
    private $valeur;

    public function getIdProduit(): ?int
    {
        return $this->idProduit;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(int $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getValeur(): ?int
    {
        return $this->valeur;
    }

    public function setValeur(int $valeur): self
    {
        $this->valeur = $valeur;

        return $this;
    }


}
