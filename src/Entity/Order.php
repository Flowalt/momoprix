<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Order
 *
 * @ORM\Table(name="orders", indexes={@ORM\Index(name="fk_order_customer1_idx", columns={"customer_idcustomer"}), @ORM\Index(name="fk_order_address1_idx", columns={"address_idaddress"})})
 * @ORM\Entity
 */
class Order
{
    /**
     * @var int
     *
     * @ORM\Column(name="idorder", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idorder;

    /**
     * @var string
     *
     * @ORM\Column(name="libell", type="string", length=45, nullable=false)
     */
    private $libell;

    /**
     * @var string|null
     *
     * @ORM\Column(name="status", type="string", length=20, nullable=true, options={"default"="NULL"})
     */
    private $status = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_order", type="date", nullable=true, options={"default"="NULL"})
     */
    private $dateOrder = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="prixHT", type="decimal", precision=5, scale=2, nullable=true, options={"default"="NULL"})
     */
    private $prixht = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="prixTTC", type="decimal", precision=5, scale=2, nullable=true, options={"default"="NULL"})
     */
    private $prixttc = 'NULL';

    /**
     * @var \Address
     *
     * @ORM\ManyToOne(targetEntity="Address",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="address_idaddress", referencedColumnName="idaddress")
     * })
     */
    private $addressIdaddress;

    /**
     * @var \Customer
     *
     * @ORM\ManyToOne(targetEntity="Customer")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="customer_idcustomer", referencedColumnName="idcustomer")
     * })
     */
    private $customerIdcustomer;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="orderIdorder")
     */
    private $productIdproduct;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->productIdproduct = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdorder(): ?int
    {
        return $this->idorder;
    }

    public function getLibell(): ?string
    {
        return $this->libell;
    }

    public function setLibell(string $libell): self
    {
        $this->libell = $libell;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDateOrder(): ?\DateTimeInterface
    {
        return $this->dateOrder;
    }

    public function setDateOrder(?\DateTimeInterface $dateOrder): self
    {
        $this->dateOrder = $dateOrder;

        return $this;
    }

    public function getPrixht(): ?string
    {
        return $this->prixht;
    }

    public function setPrixht(?string $prixht): self
    {
        $this->prixht = $prixht;

        return $this;
    }

    public function getPrixttc(): ?string
    {
        return $this->prixttc;
    }

    public function setPrixttc(?string $prixttc): self
    {
        $this->prixttc = $prixttc;

        return $this;
    }

    public function getAddressIdaddress(): ?Address
    {
        return $this->addressIdaddress;
    }

    public function setAddressIdaddress(?Address $addressIdaddress): self
    {
        $this->addressIdaddress = $addressIdaddress;

        return $this;
    }

    public function getCustomerIdcustomer(): ?Customer
    {
        return $this->customerIdcustomer;
    }

    public function setCustomerIdcustomer(?Customer $customerIdcustomer): self
    {
        $this->customerIdcustomer = $customerIdcustomer;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProductIdproduct(): Collection
    {
        return $this->productIdproduct;
    }

    public function addProductIdproduct(Product $productIdproduct): self
    {
        if (!$this->productIdproduct->contains($productIdproduct)) {
            $this->productIdproduct[] = $productIdproduct;
            $productIdproduct->addOrderIdorder($this);
        }

        return $this;
    }

    public function removeProductIdproduct(Product $productIdproduct): self
    {
        if ($this->productIdproduct->contains($productIdproduct)) {
            $this->productIdproduct->removeElement($productIdproduct);
            $productIdproduct->removeOrderIdorder($this);
        }

        return $this;
    }

    public function __toString()
    {
        return (string) $this-> idorder;
    }

}
