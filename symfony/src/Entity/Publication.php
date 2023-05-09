<?php

namespace App\Entity;

use App\Repository\PublicationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
#[ORM\Entity(repositoryClass: PublicationRepository::class)]
#[Vich\Uploadable]
class Publication implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"content is required")]
    #[Assert\Length(
        min: 5,
        minMessage: 'content must be at least 5 caracters',
    )]
    private ?string $content = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message:"date is required")]
    private ?\DateTimeInterface $date = null;

    #[ORM\OneToMany(mappedBy: 'publication', targetEntity: Comment::class,orphanRemoval: true)]
    private Collection $Comment;

    #[ORM\Column(length: 255)]
    private ?string $Image = null;

      #[Vich\UploadableField(mapping:"publication_image", fileNameProperty:"image")]
      #[Assert\NotNull]
    private $imageFile;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id_user')]
    private ?User $user = null;

    public function __construct()
    {
        $this->Comment = new ArrayCollection();
    }

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
    /**
     * @return Collection<int, Comment>
     */
    public function getComment(): Collection
    {
        return $this->Comment;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->Comment->contains($comment)) {
            $this->Comment->add($comment);
            $comment->setPublication($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->Comment->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getPublication() === $this) {
                $comment->setPublication(null);
            }
        }

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
    public function __toString()
    {
        return $this->getContent();
    }

    public function jsonSerialize(): array
    {
        return array(
            'id' => $this->id,
            'user' => $this->user,
            'content' => $this->content,
            'date' => $this->date->format("d-m-Y"),
            'image' => $this->Image

        );
    }

    public function constructor($user, $content, $date, $image)
    {
        $this->user = $user;
        $this->content = $content;
        $this->date = $date;
        $this->Image = $image;

    }

}
