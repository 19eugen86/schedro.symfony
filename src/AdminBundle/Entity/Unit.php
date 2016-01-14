<?php

namespace AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Unit
 *
 * @ORM\Table(name="units")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\UnitRepository")
 */
class Unit
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
     * @ORM\Column(name="name", type="string", length=30, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="short_name", type="string", length=10, unique=true)
     */
    private $shortName;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_weight", type="boolean")
     */
    private $isWeight = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_area", type="boolean")
     */
    private $isArea = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_volume", type="boolean")
     */
    private $isVolume = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_modifiable", type="boolean")
     */
    private $isModifiable = true;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_visible", type="boolean")
     */
    private $isVisible = true;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Proportion", mappedBy="unit1")
     */
    protected $unit1Proportions;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Proportion", mappedBy="unit2")
     */
    protected $unit2Proportions;

    public function __construct()
    {
        $this->unit1Proportions = new ArrayCollection();
        $this->unit2Proportions = new ArrayCollection();
    }

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
     * @return Unit
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
     * Set shortName
     *
     * @param string $shortName
     *
     * @return Unit
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;

        return $this;
    }

    /**
     * Get shortName
     *
     * @return string
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * Set isWeight
     *
     * @param boolean $isWeight
     *
     * @return Unit
     */
    public function setIsWeight($isWeight)
    {
        $this->isWeight = $isWeight;

        return $this;
    }

    /**
     * Get isWeight
     *
     * @return bool
     */
    public function getIsWeight()
    {
        return $this->isWeight;
    }

    /**
     * Set isArea
     *
     * @param boolean $isArea
     *
     * @return Unit
     */
    public function setIsArea($isArea)
    {
        $this->isArea = $isArea;

        return $this;
    }

    /**
     * Get isArea
     *
     * @return bool
     */
    public function getIsArea()
    {
        return $this->isArea;
    }

    /**
     * Set isVolume
     *
     * @param boolean $isVolume
     *
     * @return Unit
     */
    public function setIsVolume($isVolume)
    {
        $this->isVolume = $isVolume;

        return $this;
    }

    /**
     * Get isVolume
     *
     * @return bool
     */
    public function getIsVolume()
    {
        return $this->isVolume;
    }

    /**
     * Set isModifiable
     *
     * @param boolean $isModifiable
     *
     * @return Unit
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

    /**
     * Set isVisible
     *
     * @param boolean $isVisible
     *
     * @return Unit
     */
    public function setIsVisible($isVisible)
    {
        $this->isVisible = $isVisible;

        return $this;
    }

    /**
     * Get isVisible
     *
     * @return bool
     */
    public function getIsVisible()
    {
        return $this->isVisible;
    }
}

