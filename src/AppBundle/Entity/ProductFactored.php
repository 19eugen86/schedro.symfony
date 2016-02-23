<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ProductFactored
 *
 * @ORM\Table(name="products_factored")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductFactoredRepository")
 */
class ProductFactored
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="consignment", type="string", length=255)
     */
    private $consignment;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="productsFactored")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     *
     * @Assert\Type(type="AppBundle\Entity\Product")
     * @Assert\Valid()
     */
    private $product;

    /**
     * @var Unit
     *
     * @ORM\ManyToOne(targetEntity="Unit", inversedBy="productsFactored")
     * @ORM\JoinColumn(name="unit_id", referencedColumnName="id")
     *
     * @Assert\Type(type="AppBundle\Entity\Unit")
     * @Assert\Valid()
     */
    private $unit;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var Department
     *
     * @ORM\ManyToOne(targetEntity="Department", inversedBy="productsFactored")
     * @ORM\JoinColumn(name="department_id", referencedColumnName="id")
     *
     * @Assert\Type(type="AppBundle\Entity\Department")
     * @Assert\Valid()
     */
    private $department;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="\Application\Sonata\UserBundle\Entity\User", inversedBy="productsFactored")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     * @Assert\Type(type="\Application\Sonata\UserBundle\Entity\User")
     * @Assert\Valid()
     */
    private $user;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set consignment
     *
     * @param string $consignment
     *
     * @return ProductFactored
     */
    public function setConsignment($consignment)
    {
        $this->consignment = $consignment;

        return $this;
    }

    /**
     * Get consignment
     *
     * @return string
     */
    public function getConsignment()
    {
        return $this->consignment;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return ProductFactored
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set product
     *
     * @param Product $product
     *
     * @return ProductFactored
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set unit
     *
     * @param Unit $unit
     *
     * @return ProductFactored
     */
    public function setUnit(Unit $unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return Unit
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return ProductFactored
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set department
     *
     * @param Department $department
     *
     * @return ProductFactored
     */
    public function setDepartment(Department $department)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department
     *
     * @return Department
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Set user
     *
     * @param \Application\Sonata\UserBundle\Entity\User $user
     *
     * @return ProductFactored
     */
    public function setUser(\Application\Sonata\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}

