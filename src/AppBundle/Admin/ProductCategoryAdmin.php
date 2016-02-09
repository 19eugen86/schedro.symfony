<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 04.02.2016
 * Time: 13:29
 */

namespace AppBundle\Admin;


use AppBundle\Entity\ProductCategory;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ProductCategoryAdmin extends Admin
{
    protected $baseRouteName = 'sonata_products_categories';
    protected $baseRoutePattern = 'products/categories';

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
        $formMapper
            ->add('name', 'text')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
        ;
    }

    public function toString($object)
    {
        return $object instanceof ProductCategory
            ? $object->getName()
            : 'Category';
    }
}