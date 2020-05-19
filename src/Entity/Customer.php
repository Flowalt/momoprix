<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * Customer
 *
 * @ORM\Table(name="customer")
 * @ORM\Entity
 */
class Customer implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="idcustomer", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcustomer;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=60, nullable=false)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=60, nullable=false)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=70, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=254, nullable=false)
     */
    private $password;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_of_birth", type="date", nullable=true, options={"default"="NULL"})
     */
    private $dateOfBirth ;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true, options={"default"="current_timestamp()"})
     */
    private $created;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true, options={"default"="current_timestamp()"})
     */
    private $updated;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Product", inversedBy="customerIdcustomer")
     * @ORM\JoinTable(name="favoris",
     *   joinColumns={
     *     @ORM\JoinColumn(name="customer_idcustomer", referencedColumnName="idcustomer")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="product_idproduct", referencedColumnName="idproduct")
     *   }
     * )
     */
    private $productIdproduct;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->productIdproduct = new \Doctrine\Common\Collections\ArrayCollection();
        $this->created= new \DateTime();
    }

    public function getIdcustomer(): ?int
    {
        return $this->idcustomer;
    }

    public function setIdcustomer(int $id): self
    {
        $this->idcustomer = $id;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(?\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created= new \DateTime();
    }

    public function setCreated(?\DateTimeInterface $created): self
    {
        $this->created = $created=new \DateTime() ;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(?\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

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
        }

        return $this;
    }

    public function removeProductIdproduct(Product $productIdproduct): self
    {
        if ($this->productIdproduct->contains($productIdproduct)) {
            $this->productIdproduct->removeElement($productIdproduct);
        }

        return $this;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

   
    public function getSalt()
    {
        // leaving blank - I don't need/have a password!
    }
    public function eraseCredentials()
    {
        // leaving blank - I don't need/have a password!
    }

}
