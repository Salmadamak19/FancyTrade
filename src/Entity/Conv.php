<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Conv
 *
 * @ORM\Table(name="conv", indexes={@ORM\Index(name="fk_iduser1", columns={"idconv_user"}), @ORM\Index(name="fk_iduser2", columns={"idconv_user2"})})
 * @ORM\Entity
 */
class Conv
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
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idconv_user2", referencedColumnName="id")
     * })
     */
    private $idconvUser2;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idconv_user", referencedColumnName="id")
     * })
     */
    private $idconvUser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdconvUser2(): ?Utilisateur
    {
        return $this->idconvUser2;
    }

    public function setIdconvUser2(?Utilisateur $idconvUser2): self
    {
        $this->idconvUser2 = $idconvUser2;

        return $this;
    }

    public function getIdconvUser(): ?Utilisateur
    {
        return $this->idconvUser;
    }

    public function setIdconvUser(?Utilisateur $idconvUser): self
    {
        $this->idconvUser = $idconvUser;

        return $this;
    }


}
