<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 04.02.2016
 * Time: 13:33
 */

namespace AppBundle\Admin;


use AppBundle\Entity\Product;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ProductAdmin extends Admin
{
    protected $baseRouteName = 'sonata_products';
    protected $baseRoutePattern = 'products';

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name')
            ->add('category.name')
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
            ->add('category', 'sonata_type_model', array(
                'class' => 'AppBundle\Entity\ProductCategory',
                'property' => 'name'
            ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('category.name')
        ;
    }

    public function toString($object)
    {
        return $object instanceof Product
            ? $object->getName()
            : 'Product';
    }
}