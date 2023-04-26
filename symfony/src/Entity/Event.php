<?php

namespace App\Entity;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Nullable;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
#[ORM\Entity(repositoryClass: EventRepository::class)]
#[Vich\Uploadable]
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

    #[ORM\ManyToOne(cascade: ['persist', 'remove'])]
    private ?EventPlace $Place = null;

    #[ORM\Column(length: 255)]
    private ?string $Image = null;

      #[Vich\UploadableField(mapping:"event_image", fileNameProperty:"image")]
      #[Assert\NotNull]
    private $imageFile;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\GreaterThan("now", 
    message:"The date must be after the current date and time")]
    private ?\DateTimeInterface $DateandTime = null;

    #[ORM\Column(length: 255, nullable: true )]
    private ?string $User = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Organiser is required.')]
    private ?string $Organiser = null;

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

    public function setImageFile(?File $imageFile): void
    {
        $this->imageFile = $imageFile;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
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

    public function getDateandTime(): ?\DateTimeInterface
    {
        return $this->DateandTime;
    }

    public function setDateandTime(\DateTimeInterface $DateandTime): self
    {
        $this->DateandTime = $DateandTime;

        return $this;
    }

    public function getUser(): ?string
    {
        return $this->User;
    }

    public function setUser(string $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getOrganiser(): ?string
    {
        return $this->Organiser;
    }

    public function setOrganiser(string $Organiser): self
    {
        $this->Organiser = $Organiser;

        return $this;
    }
}
