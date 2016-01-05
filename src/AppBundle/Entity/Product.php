<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Product
 *
 * @ORM\Table(name="products")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 */
class Product
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="ProductCategory", inversedBy="product_categories")
     * @ORM\JoinColumn(name="product_category_id", referencedColumnName="id")
     *
     * @Assert\Type(type="AppBundle\Entity\ProductCategory")
     * @Assert\Valid()
     */
    private $category;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param ProductCategory $productCategory
     * @return $this
     */
    public function setCategory(ProductCategory $productCategory)
    {
        $this->category = $productCategory;

        return $this;
    }

    /**
     * @return int
     */
    public function getCategory()
    {
        return $this->category;
    }
}

