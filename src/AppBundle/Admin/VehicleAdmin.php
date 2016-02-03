<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 03.02.2016
 * Time: 12:22
 */

namespace AppBundle\Admin;


use AppBundle\Entity\Vehicle;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class VehicleAdmin extends Admin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('registrationNumber')
            ->add('brand')
            ->add('model')
            ->add('carrier.name')
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('brand', 'text')
            ->add('model', 'text')
            ->add('registrationNumber', 'text')
            ->add('carrier', 'sonata_type_model', array(
                'class' => 'AppBundle\Entity\Vehicle',
                'property' => 'name'
            ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('registrationNumber')
            ->add('brand')
            ->add('model')
            ->add('carrier.name')
        ;
    }

    public function toString($object)
    {
        return $object instanceof Vehicle
            ? $object->getBrand().' '.$object->getModel().' ['.$object->getRegistrationNumber().']'
            : 'Vehicle';
    }
}