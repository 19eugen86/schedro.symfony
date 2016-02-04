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

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', 'text');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name');
    }

    public function toString($object)
    {
        return $object instanceof Country
            ? $object->getName()
            : 'Country';
    }
}