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
     * @var string
     *
     * @ORM\Column(name="type", type="string", columnDefinition="ENUM('weight', 'area', 'volume')")
     */
    private $type;

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
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Unit
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
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

