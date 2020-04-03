<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Delivery
 *
 * @ORM\Table(name="delivery", indexes={@ORM\Index(name="fk_delivery_order1_idx", columns={"order_idorder"}), @ORM\Index(name="fk_delivery_address1_idx", columns={"address_idaddress"})})
 * @ORM\Entity
 */
class Delivery
{
    /**
     * @var int
     *
     * @ORM\Column(name="iddelivery", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddelivery;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_delivery", type="date", nullable=false)
     */
    private $dateDelivery;

    /**
     * @var string
     *
     * @ORM\Column(name="schedule", type="string", length=15, nullable=false)
     */
    private $schedule;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="delivery", type="datetime", nullable=false)
     */
    private $delivery;

    /**
     * @var \Address
     *
     * @ORM\ManyToOne(targetEntity="Address")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="address_idaddress", referencedColumnName="idaddress")
     * })
     */
    private $addressIdaddress;

    /**
     * @var \Order
     *
     * @ORM\ManyToOne(targetEntity="Order")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="order_idorder", referencedColumnName="idorder")
     * })
     */
    private $orderIdorder;

    public function getIddelivery(): ?int
    {
        return $this->iddelivery;
    }

    public function getDateDelivery(): ?\DateTimeInterface
    {
        return $this->dateDelivery;
    }

    public function setDateDelivery(\DateTimeInterface $dateDelivery): self
    {
        $this->dateDelivery = $dateDelivery;

        return $this;
    }

    public function getSchedule(): ?string
    {
        return $this->schedule;
    }

    public function setSchedule(string $schedule): self
    {
        $this->schedule = $schedule;

        return $this;
    }

    public function getDelivery(): ?\DateTimeInterface
    {
        return $this->delivery;
    }

    public function setDelivery(\DateTimeInterface $delivery): self
    {
        $this->delivery = $delivery;

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

    public function getOrderIdorder(): ?Order
    {
        return $this->orderIdorder;
    }

    public function setOrderIdorder(?Order $orderIdorder): self
    {
        $this->orderIdorder = $orderIdorder;

        return $this;
    }


}
