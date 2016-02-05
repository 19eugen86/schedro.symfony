<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 04.02.2016
 * Time: 15:17
 */

namespace AppBundle\Admin;


use AppBundle\Entity\Unit;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class UnitAdmin extends Admin
{
    protected $baseRouteName = "sonata_units";
    protected $baseRoutePattern = "settings/units";

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name', null, array(
                'route' => array('name' => 'show')
            ))
            ->add('shortName')
            ->add('type')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text')
            ->add('shortName', 'text')
            ->add('type', 'choice', array(
                'choices' => array(
                    'weight' => 'weight',
                    'area' => 'area',
                    'volume' => 'volume',
                ),
                'choices_as_values' => true,
                'expanded' => true,
                'multiple' => false,
            ))
        ;
    }

    public function toString($object)
    {
        return $object instanceof Unit
            ? $object->getName()
            : 'Unit';
    }
}