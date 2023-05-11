<?php

namespace App\Entity;

use App\Repository\ConversationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConversationRepository::class)]
class Conv
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false,name: 'idconv_user', referencedColumnName: 'id_user')]
    private ?User $idconv_user = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false,name: 'idconv_user2', referencedColumnName: 'id_user')]
    private ?User $idconv_user2 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdconvUser(): ?User
    {
        return $this->idconv_user;
    }

    public function setIdconvUser(?User $idconv_user): self
    {
        $this->idconv_user = $idconv_user;

        return $this;
    }

    public function getIdconvUser2(): ?User
    {
        return $this->idconv_user2;
    }

    public function setIdconvUser2(?User $idconv_user2): self
    {
        $this->idconv_user2 = $idconv_user2;

        return $this;
    }
}
