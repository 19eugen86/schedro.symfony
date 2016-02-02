<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 27.01.2016
 * Time: 15:11
 */

namespace UserBundle\Entity;

use FOS\UserBundle\Model\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_group")
 */
class Group extends BaseGroup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct($name = '', $roles = array())
    {
        parent::__construct($name, $roles);
    }
}