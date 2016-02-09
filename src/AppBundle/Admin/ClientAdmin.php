<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 03.02.2016
 * Time: 9:59
 */

namespace AppBundle\Admin;


use AppBundle\Entity\Client;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ClientAdmin extends Admin
{
    protected $baseRouteName = 'sonata_clients';
    protected $baseRoutePattern = 'clients';

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name')
            ->add('description')
            ->add('address')
            ->add('city.name')
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
            ->add('name', 'text')
            ->add('description', 'textarea')
            ->add('address', 'textarea')
            ->add('city', 'sonata_type_model', array(
                'class' => 'AppBundle\Entity\City',
                'property' => 'name'
            ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('city.name')
        ;
    }

    public function toString($object)
    {
        return $object instanceof Client
            ? $object->getName()
            : 'Client';
    }
}