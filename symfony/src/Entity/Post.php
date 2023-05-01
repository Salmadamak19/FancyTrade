<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PostRepository;
use Symfony\Component\Validator\Constraints as Assert ;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass= PostRepository::class)
 */
class Post
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
     * @var string
     *
     * @ORM\Column(name="sujet", type="string", length=255, nullable=false)
     * @Assert\Length(min=3)
     */
    private $sujet;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     * @Assert\Length(min=10)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="nbr_jaime", type="integer", nullable=false)
     */
    private $nbrJaime= 0;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $image ;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_user", type="string", length=255, nullable=false)
     */
    private $nomUser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_p", type="datetime", nullable=false, options={"default"="current_timestamp()"})
     */
    private $dateP ;

    /**
     * @var string
     *
     * @ORM\Column(name="communaute", type="string", length=255, nullable=false)
     */
    private $communaute;

    /**
     * @var string|null
     *
     * @ORM\Column(name="analyse_po", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $analysePo = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="liked", type="integer", nullable=true)
     */
    private $liked = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="badlevel", type="integer", nullable=true)
     */
    private $badlevel = '0';

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="post", orphanRemoval=true)
     */
    private $Commentaires;

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

    public function getNomUser(): ?string
    {
        return $this->nomUser;
    }

    public function setNomUser(string $nomUser): self
    {
        $this->nomUser = $nomUser;

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
