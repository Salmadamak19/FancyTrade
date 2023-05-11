<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column (name: "id_message")]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false,name: 'from_user', referencedColumnName: 'id_user')]
    private ?User $from_user = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false,name: 'to_conv', referencedColumnName: 'id')]
    private ?Conv $to_conv = null;

    #[ORM\Column(length: 255)]
    private ?string $text = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_time = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFromUser(): ?User
    {
        return $this->from_user;
    }

    public function setFromUser(?User $from_user): self
    {
        $this->from_user = $from_user;

        return $this;
    }

    public function getToConv(): ?Conv
    {
        return $this->to_conv;
    }

    public function setToConv(?Conv $to_conv): self
    {
        $this->to_conv = $to_conv;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getDateTime(): ?\DateTimeInterface
    {
        return $this->date_time;
    }

    public function setDateTime(\DateTimeInterface $date_time): self
    {
        $this->date_time = $date_time;

        return $this;
    }
}
