<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 02.02.2016
 * Time: 13:35
 */

namespace AppBundle\Admin;


use AppBundle\Entity\City;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CityAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
//            ->tab('Post')
//                ->with('Content')
                    ->add('name', 'text')
//                ->end()
//            ->end()

//            ->tab('Publish Options')
//                ->with('Meta data')
                    ->add('country', 'sonata_type_model', array(
                        'class' => 'AdminBundle\Entity\Country',
                        'property' => 'name'
                    ))
//                ->end()
//            ->end()
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('country.name')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('country.name')
        ;
    }

    public function toString($object)
    {
        return $object instanceof City
            ? $object->getName()
            : 'City';
    }
}