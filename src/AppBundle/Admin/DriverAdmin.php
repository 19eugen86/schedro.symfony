<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 03.02.2016
 * Time: 12:15
 */

namespace AppBundle\Admin;


use AppBundle\Entity\Driver;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class DriverAdmin extends Admin
{
    protected $baseRouteName = 'sonata_drivers';
    protected $baseRoutePattern = 'carriers/drivers';

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('fullName')
            ->add('phoneNumber')
            ->add('carrier.name')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('fullName', 'text')
            ->add('phoneNumber', 'text')
            ->add('carrier', 'sonata_type_model', array(
                'class' => 'AppBundle\Entity\Carrier',
                'property' => 'name'
            ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('fullName')
            ->add('carrier.name')
        ;
    }

    public function toString($object)
    {
        return $object instanceof Driver
            ? $object->getFullName()
            : 'Driver';
    }
}