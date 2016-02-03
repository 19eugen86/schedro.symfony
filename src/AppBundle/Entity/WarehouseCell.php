<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * WarehouseCell
 *
 * @ORM\Table(name="warehouse_cells")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\WarehouseCellRepository")
 */
class WarehouseCell
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
     */
    private $name;

    /**
     * @var Warehouse
     *
     * @ORM\ManyToOne(targetEntity="Warehouse", inversedBy="cells")
     * @ORM\JoinColumn(name="warehouse_id", referencedColumnName="id")
     *
     * @Assert\Type(type="AppBundle\Entity\Warehouse")
     * @Assert\Valid()
     */
    private $warehouse;

    /**
     * @var ProductCategory
     *
     * @ORM\ManyToOne(targetEntity="ProductCategory", inversedBy="warehouseCells")
     * @ORM\JoinColumn(name="product_category_id", referencedColumnName="id")
     *
     * @Assert\Type(type="AppBundle\Entity\ProductCategory")
     * @Assert\Valid()
     */
    private $productCategory;

    /**
     * @var string
     *
     * @ORM\Column(name="area", type="decimal", precision=10, scale=2)
     */
    private $area;

    /**
     * @var string
     *
     * @ORM\Column(name="volume", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $volume;

    /**
     * @var string
     */
    private $usedArea;

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
     * @return WarehouseCell
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
     * Set warehouse
     *
     * @param Warehouse $warehouse
     *
     * @return WarehouseCell
     */
    public function setWarehouse(Warehouse $warehouse)
    {
        $this->warehouse = $warehouse;

        return $this;
    }

    /**
     * Get warehouse
     *
     * @return Warehouse
     */
    public function getWarehouse()
    {
        return $this->warehouse;
    }

    /**
     * Set productCategory
     *
     * @param ProductCategory $productCategory
     *
     * @return WarehouseCell
     */
    public function setProductCategory(ProductCategory $productCategory)
    {
        $this->productCategory = $productCategory;

        return $this;
    }

    /**
     * Get productCategory
     *
     * @return ProductCategory
     */
    public function getProductCategory()
    {
        return $this->productCategory;
    }

    /**
     * Set area
     *
     * @param string $area
     *
     * @return WarehouseCell
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return string
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set volume
     *
     * @param string $volume
     *
     * @return WarehouseCell
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;

        return $this;
    }

    /**
     * Get volume
     *
     * @return string
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * @return string
     */
    public function getUsedArea()
    {
        return $this->usedArea;
    }

    /**
     * @param string $usedArea
     * @return WarehouseCell
     */
    public function setUsedArea($usedArea)
    {
        $this->usedArea = $usedArea;

        return $this;
    }
}

