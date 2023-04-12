<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation", indexes={@ORM\Index(name="zadzad", columns={"id_user"}), @ORM\Index(name="ezadaz", columns={"reclamation_category_id"})})
 * @ORM\Entity
 */
class Reclamation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="reclamation_type", type="string", length=30, nullable=true, options={"default"="NULL"})
     */
    private $reclamationType = 'NULL';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="reclamation_Date", type="date", nullable=false)
     */
    private $reclamationDate;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="string", length=50, nullable=false)
     */
    private $contenu;

    /**
     * @var string|null
     *
     * @ORM\Column(name="objet", type="string", length=20, nullable=true, options={"default"="NULL"})
     */
    private $objet = 'NULL';

    /**
     * @var \ReclamationCategory
     *
     * @ORM\ManyToOne(targetEntity="ReclamationCategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reclamation_category_id", referencedColumnName="category_id")
     * })
     */
    private $reclamationCategory;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReclamationType(): ?string
    {
        return $this->reclamationType;
    }

    public function setReclamationType(?string $reclamationType): self
    {
        $this->reclamationType = $reclamationType;

        return $this;
    }

    public function getReclamationDate(): ?\DateTimeInterface
    {
        return $this->reclamationDate;
    }

    public function setReclamationDate(\DateTimeInterface $reclamationDate): self
    {
        $this->reclamationDate = $reclamationDate;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(?string $objet): self
    {
        $this->objet = $objet;

        return $this;
    }

    public function getReclamationCategory(): ?ReclamationCategory
    {
        return $this->reclamationCategory;
    }

    public function setReclamationCategory(?ReclamationCategory $reclamationCategory): self
    {
        $this->reclamationCategory = $reclamationCategory;

        return $this;
    }

    public function getIdUser(): ?Utilisateur
    {
        return $this->idUser;
    }

    public function setIdUser(?Utilisateur $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }


}
