<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Proportion
 *
 * @ORM\Table(name="units_proportions")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\ProportionRepository")
 */
class Proportion
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
     * @var bool
     *
     * @ORM\Column(name="is_modifiable", type="boolean")
     */
    private $isModifiable;

    /**
     * @var string
     *
     * @ORM\Column(name="ratio", type="decimal", precision=10, scale=2)
     */
    private $ratio;

    /**
     * @ORM\ManyToOne(targetEntity="Unit", inversedBy="unit1Proportions")
     * @ORM\JoinColumn(name="unit_1_id", referencedColumnName="id")
     *
     * @Assert\Type(type="AdminBundle\Entity\Unit")
     * @Assert\Valid()
     */
    protected $unit1;

    /**
     * @ORM\ManyToOne(targetEntity="Unit", inversedBy="unit2Proportions")
     * @ORM\JoinColumn(name="unit_2_id", referencedColumnName="id")
     *
     * @Assert\Type(type="AdminBundle\Entity\Unit")
     * @Assert\Valid()
     */
    protected $unit2;

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="proportions")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     *
     * @Assert\Type(type="AdminBundle\Entity\Product")
     * @Assert\Valid()
     */
    protected $product;

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
     * Set unit1
     *
     * @param Unit $unit
     *
     * @return Proportion
     */
    public function setUnit1(Unit $unit)
    {
        $this->unit1 = $unit;

        return $this;
    }

    /**
     * Get unit1
     *
     * @return Unit
     */
    public function getUnit1()
    {
        return $this->unit1;
    }

    /**
     * Set unit2
     *
     * @param Unit $unit
     *
     * @return Proportion
     */
    public function setUnit2(Unit $unit)
    {
        $this->unit2 = $unit;

        return $this;
    }

    /**
     * Get unit2
     *
     * @return Unit
     */
    public function getUnit2()
    {
        return $this->unit2;
    }

    /**
     * Set ratio
     *
     * @param string $ratio
     *
     * @return Proportion
     */
    public function setRatio($ratio)
    {
        $this->ratio = $ratio;

        return $this;
    }

    /**
     * Get ratio
     *
     * @return string
     */
    public function getRatio()
    {
        return $this->ratio;
    }

    /**
     * @param Product $product
     * @return Proportion
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
     * Set isModifiable
     *
     * @param boolean $isModifiable
     *
     * @return Proportion
     */
    public function setIsModifiable($isModifiable)
    {
        $this->isModifiable = $isModifiable;

        return $this;
    }

    /**
     * Get isModifiable
     *
     * @return bool
     */
    public function getIsModifiable()
    {
        return $this->isModifiable;
    }
}

