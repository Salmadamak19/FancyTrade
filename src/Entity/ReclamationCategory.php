<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReclamationCategory
 *
 * @ORM\Table(name="reclamation_category")
 * @ORM\Entity
 */
class ReclamationCategory
{
    /**
     * @var int
     *
     * @ORM\Column(name="category_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $categoryId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=25, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description_cat", type="string", length=50, nullable=false)
     */
    private $descriptionCat;

    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescriptionCat(): ?string
    {
        return $this->descriptionCat;
    }

    public function setDescriptionCat(string $descriptionCat): self
    {
        $this->descriptionCat = $descriptionCat;

        return $this;
    }


}
