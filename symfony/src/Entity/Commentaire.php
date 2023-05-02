<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommentaireRepository;
use Symfony\Component\Validator\Constraints as Assert ;


/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire", indexes={@ORM\Index(name="IDX_67F068BC4B89032C", columns={"post_id"})})
 * @ORM\Entity(repositoryClass= CommentaireRepository::class)
 */ 


class Commentaire
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
     * @ORM\Column(name="nomuser", type="string", length=255, nullable=false)
     */
    private $nomuser;

    /**
     * @var string|null
     *
     * @ORM\Column(name="imagec", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $imagec = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionc", type="string", length=255, nullable=false)
     * @Assert\Length(min=3)    
     * @Assert\NotNull 
     */
    private $descriptionc;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datec", type="datetime", nullable=false, options={"default"="current_timestamp()"})
     */
    private $datec = null;

    

    /**
     * @var string|null
     *
     * @ORM\Column(name="analyse_co", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $analyseCo = 'NULL';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datec_ts", type="datetime", nullable=true, options={"default"="current_timestamp()"})
     */
    private $datecTs ;

    /**
     * @ORM\ManyToOne(targetEntity=Post::class, inversedBy="Commentaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $post;

    // /**
    //  * @var \Post
    //  *
    //  * @ORM\ManyToOne(targetEntity="Post")
    //  * @ORM\JoinColumns({
    //  *   @ORM\JoinColumn(name="post_id", referencedColumnName="id")
    //  * })
    //  */
    // private $post;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomuser(): ?string
    {
        return $this->nomuser;
    }

    public function setNomuser(string $nomuser): self
    {
        $this->nomuser = $nomuser;

        return $this;
    }

    public function getImagec(): ?string
    {
        return $this->imagec;
    }

    public function setImagec(?string $imagec): self
    {
        $this->imagec = $imagec;

        return $this;
    }

    public function getDescriptionc(): ?string
    {
        return $this->descriptionc;
    }

    public function setDescriptionc(string $descriptionc): self
    {
        $this->descriptionc = $descriptionc;

        return $this;
    }

    public function getDatec(): ?\DateTimeInterface
    {
        return $this->datec;
    }

    public function setDatec(\DateTimeInterface $datec): self
    {
        $this->datec = $datec;

        return $this;
    }


    public function getAnalyseCo(): ?string
    {
        return $this->analyseCo;
    }

    public function setAnalyseCo(?string $analyseCo): self
    {
        $this->analyseCo = $analyseCo;

        return $this;
    }

    public function getDatecTs(): ?\DateTimeInterface
    {
        return $this->datecTs;
    }

    public function setDatecTs(\DateTimeInterface $datecTs): self
    {
        $this->datecTs = $datecTs;

        return $this;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): self
    {
        $this->post = $post;

        return $this;
    }


}
