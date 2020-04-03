<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Table(name="address", indexes={@ORM\Index(name="fk_address_customer1_idx", columns={"customer_idcustomer"})})
 * @ORM\Entity
 */
class Address
{
    /**
     * @var int
     *
     * @ORM\Column(name="idaddress", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idaddress;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=45, nullable=false, options={"default"="'livraison'"})
     */
    private $type = '\'livraison\'';

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=200, nullable=false)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=10, nullable=false)
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=70, nullable=false)
     */
    private $city;

    /**
     * @var bool
     *
     * @ORM\Column(name="indoors", type="boolean", nullable=false, options={"default"="1"})
     */
    private $indoors = '1';

    /**
     * @var string|null
     *
     * @ORM\Column(name="digicode", type="string", length=20, nullable=true, options={"default"="NULL"})
     */
    private $digicode = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="floor", type="string", length=5, nullable=true, options={"default"="NULL"})
     */
    private $floor = 'NULL';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="elevator", type="boolean", nullable=true)
     */
    private $elevator = '0';

    /**
     * @var \Customer
     *
     * @ORM\ManyToOne(targetEntity="Customer")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="customer_idcustomer", referencedColumnName="idcustomer")
     * })
     */
    private $customerIdcustomer;

    public function getIdaddress(): ?int
    {
        return $this->idaddress;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getIndoors(): ?bool
    {
        return $this->indoors;
    }

    public function setIndoors(bool $indoors): self
    {
        $this->indoors = $indoors;

        return $this;
    }

    public function getDigicode(): ?string
    {
        return $this->digicode;
    }

    public function setDigicode(?string $digicode): self
    {
        $this->digicode = $digicode;

        return $this;
    }

    public function getFloor(): ?string
    {
        return $this->floor;
    }

    public function setFloor(?string $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    public function getElevator(): ?bool
    {
        return $this->elevator;
    }

    public function setElevator(?bool $elevator): self
    {
        $this->elevator = $elevator;

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


}
