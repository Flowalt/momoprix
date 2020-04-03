<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product", indexes={@ORM\Index(name="fk_product_category_idx", columns={"category_idcategory"})})
 * @ORM\Entity
 */
class Product
{
    /**
     * @var int
     *
     * @ORM\Column(name="idproduct", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idproduct;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=60, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="bar_code", type="string", length=60, nullable=false)
     */
    private $barCode;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=5, scale=2, nullable=false)
     */
    private $price;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_of_entry", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $dateOfEntry = 'NULL';

    /**
     * @var int
     *
     * @ORM\Column(name="stock", type="integer", nullable=false, options={"default"="100"})
     */
    private $stock = '100';

    /**
     * @var string|null
     *
     * @ORM\Column(name="url", type="string", length=95, nullable=true, options={"default"="NULL"})
     */
    private $url = 'NULL';

    /**
     * @var \Category
     *
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_idcategory", referencedColumnName="idcategory")
     * })
     */
    private $categoryIdcategory;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Customer", mappedBy="productIdproduct")
     */
    private $customerIdcustomer;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Order", inversedBy="productIdproduct")
     * @ORM\JoinTable(name="product_has_order",
     *   joinColumns={
     *     @ORM\JoinColumn(name="product_idproduct", referencedColumnName="idproduct")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="order_idorder", referencedColumnName="idorder")
     *   }
     * )
     */
    private $orderIdorder;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->customerIdcustomer = new \Doctrine\Common\Collections\ArrayCollection();
        $this->orderIdorder = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdproduct(): ?int
    {
        return $this->idproduct;
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

    public function getBarCode(): ?string
    {
        return $this->barCode;
    }

    public function setBarCode(string $barCode): self
    {
        $this->barCode = $barCode;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDateOfEntry(): ?\DateTimeInterface
    {
        return $this->dateOfEntry;
    }

    public function setDateOfEntry(?\DateTimeInterface $dateOfEntry): self
    {
        $this->dateOfEntry = $dateOfEntry;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getCategoryIdcategory(): ?Category
    {
        return $this->categoryIdcategory;
    }

    public function setCategoryIdcategory(?Category $categoryIdcategory): self
    {
        $this->categoryIdcategory = $categoryIdcategory;

        return $this;
    }

    /**
     * @return Collection|Customer[]
     */
    public function getCustomerIdcustomer(): Collection
    {
        return $this->customerIdcustomer;
    }

    public function addCustomerIdcustomer(Customer $customerIdcustomer): self
    {
        if (!$this->customerIdcustomer->contains($customerIdcustomer)) {
            $this->customerIdcustomer[] = $customerIdcustomer;
            $customerIdcustomer->addProductIdproduct($this);
        }

        return $this;
    }

    public function removeCustomerIdcustomer(Customer $customerIdcustomer): self
    {
        if ($this->customerIdcustomer->contains($customerIdcustomer)) {
            $this->customerIdcustomer->removeElement($customerIdcustomer);
            $customerIdcustomer->removeProductIdproduct($this);
        }

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getOrderIdorder(): Collection
    {
        return $this->orderIdorder;
    }

    public function addOrderIdorder(Order $orderIdorder): self
    {
        if (!$this->orderIdorder->contains($orderIdorder)) {
            $this->orderIdorder[] = $orderIdorder;
        }

        return $this;
    }

    public function removeOrderIdorder(Order $orderIdorder): self
    {
        if ($this->orderIdorder->contains($orderIdorder)) {
            $this->orderIdorder->removeElement($orderIdorder);
        }

        return $this;
    }

}
