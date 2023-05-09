<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"content is required")]
    private ?string $content = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message:"date is required")]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'Comment')]
    private ?Publication $publication = null;

    #[ORM\ManyToOne]
#[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id_user')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPublication(): ?Publication
    {
        return $this->publication;
    }

    public function setPublication(?Publication $publication): self
    {
        $this->publication = $publication;

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

    public function jsonSerialize(): array
    {
        return array(
            'id' => $this->id,
            'publication' => $this->publication,
            'user' => $this->user,
            'content' => $this->content,
            'date' => $this->date->format("d-m-Y")

        );
    }

    public function constructor($publication, $user, $content, $date)
    {
        $this->publication = $publication;
        $this->user = $user;
        $this->content = $content;
        $this->date = $date;

    }
}
