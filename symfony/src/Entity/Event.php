<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Name is required.')]
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: 'Name must be at least {{ limit }} characters long.',
        maxMessage: 'Name cannot be longer than {{ limit }} characters.'
    )]
    private ?string $Name = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Description is required.')]
    #[Assert\Length(
        min: 10,
        max: 1000,
        minMessage: 'Description must be at least {{ limit }} characters long.',
        maxMessage: 'Description cannot be longer than {{ limit }} characters.'
    )]
    private ?string $Description = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?EventPlace $Place = null;

    #[ORM\Column(length: 255)]
    private ?string $Image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPlace(): ?EventPlace
    {
        return $this->Place;
    }

    public function setPlace(?EventPlace $Place): self
    {
        $this->Place = $Place;

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
