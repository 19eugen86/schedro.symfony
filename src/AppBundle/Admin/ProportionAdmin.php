<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 04.02.2016
 * Time: 16:01
 */

namespace AppBundle\Admin;


use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ProportionAdmin extends Admin
{
    protected $baseRouteName = 'sonata_proportions';
    protected $baseRoutePattern = 'settings/proportions';

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('unit1.shortName')
            ->add('product.name')
            ->addIdentifier('ratio')
            ->add('unit2.shortName')
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('category', 'sonata_type_model', array(
                'mapped' => false,
                'class' => 'AppBundle\Entity\ProductCategory',
                'property' => 'name'
            ))
            ->add('product', 'sonata_type_model', array(
                'class' => 'AppBundle\Entity\Product',
                'property' => 'name'
            ))
            ->add('unit1', 'sonata_type_model', array(
                'class' => 'AppBundle\Entity\Unit',
                'property' => 'shortName'
            ))
            ->add('ratio', 'number')
            ->add('unit2', 'sonata_type_model', array(
                'class' => 'AppBundle\Entity\Unit',
                'property' => 'shortName'
            ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('product.name')
        ;
    }
}