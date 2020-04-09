<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="idcategory", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcategory;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="categoryIdcategory")
     * @ORM\JoinTable(name="category_has_category",
     *   joinColumns={
     *     @ORM\JoinColumn(name="category_idcategory", referencedColumnName="idcategory")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="category_idcategory1", referencedColumnName="idcategory")
     *   }
     * )
     */
    private $categoryIdcategory1;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categoryIdcategory1 = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdcategory(): ?int
    {
        return $this->idcategory;
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

    /**
     * @return Collection|Category[]
     */
    public function getCategoryIdcategory1(): Collection
    {
        return $this->categoryIdcategory1;
    }

    public function addCategoryIdcategory1(string $categoryIdcategory1): self
    {
        if (!$this->categoryIdcategory1->contains($categoryIdcategory1)) {
            $this->categoryIdcategory1[] = $categoryIdcategory1;
        }

        return $this;
    }

    public function removeCategoryIdcategory1(Category $categoryIdcategory1): self
    {
        if ($this->categoryIdcategory1->contains($categoryIdcategory1)) {
            $this->categoryIdcategory1->removeElement($categoryIdcategory1);
        }

        return $this;
    }

}
