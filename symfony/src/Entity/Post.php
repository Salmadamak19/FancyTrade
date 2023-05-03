<?php
namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: "post")]
#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\Length(min: 3)]
    private string $sujet;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\Length(min: 10)]
    private string $description;

    #[ORM\Column(type: "integer")]
    private int $nbrJaime = 0;

    #[ORM\Column(type: "string", length: 255, nullable: true, options: ["default" => "NULL"])]
    private ?string $image = null;

    #[ORM\ManyToOne]
#[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id_user')]
private ?User $user = null;

    #[ORM\Column(type: "datetime", options: ["default" => "CURRENT_TIMESTAMP"])]
    private \DateTimeInterface $dateP;

    #[ORM\Column(type: "string", length: 255)]
    private string $communaute;

    #[ORM\Column(type: "string", length: 255, nullable: true, options: ["default" => "NULL"])]
    private ?string $analysePo = null;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $liked = 0;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $badlevel = 0;

    #[ORM\OneToMany(targetEntity: Commentaire::class, mappedBy: "post", orphanRemoval: true)]
    private Collection $Commentaires;

    public function __construct()
    {
        $this->Commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(string $sujet): self
    {
        $this->sujet = $sujet;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getNbrJaime(): ?int
    {
        return $this->nbrJaime;
    }

    public function setNbrJaime(int $nbrJaime): self
    {
        $this->nbrJaime = $nbrJaime;
        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;
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

    public function getDateP(): ?\DateTimeInterface
    {
        return $this->dateP;
    }

    public function setDateP(\DateTimeInterface $dateP): self
    {
        $this->dateP = $dateP;

        return $this;
    }

    public function getCommunaute(): ?string
    {
        return $this->communaute;
    }

    public function setCommunaute(string $communaute): self
    {
        $this->communaute = $communaute;

        return $this;
    }

    public function getAnalysePo(): ?string
    {
        return $this->analysePo;
    }

    public function setAnalysePo(?string $analysePo): self
    {
        $this->analysePo = $analysePo;

        return $this;
    }

    public function getLiked(): ?int
    {
        return $this->liked;
    }

    public function setLiked(?int $liked): self
    {
        $this->liked = $liked;

        return $this;
    }

    public function getBadlevel(): ?int
    {
        return $this->badlevel;
    }

    public function setBadlevel(?int $badlevel): self
    {
        $this->badlevel = $badlevel;

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaires(): Collection
    {
        return $this->Commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->Commentaires->contains($commentaire)) {
            $this->Commentaires[] = $commentaire;
            $commentaire->setPost($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->Commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getPost() === $this) {
                $commentaire->setPost(null);
            }
        }

        return $this;
    }


}
