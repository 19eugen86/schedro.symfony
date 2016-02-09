<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 02.02.2016
 * Time: 12:27
 */

namespace AppBundle\Admin;


use AppBundle\Entity\Country;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;


class CountryAdmin extends Admin
{
    protected $baseRouteName = 'sonata_countries';
    protected $baseRoutePattern = 'geography/countries';

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name')
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
        $formMapper->add('name', 'text');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    public function toString($object)
    {
        return $object instanceof Country
            ? $object->getName()
            : 'Country';
    }
}