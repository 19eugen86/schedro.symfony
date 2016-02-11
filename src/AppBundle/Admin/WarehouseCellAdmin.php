<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 11.02.2016
 * Time: 17:18
 */

namespace AppBundle\Admin;


use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;

class WarehouseCellAdmin extends Admin
{
    protected $baseRouteName = 'sonata_warehouses_cells';
    protected $baseRoutePattern = 'warehouses/cells';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text')
            ->add('warehouse', 'sonata_type_model',
                array(
                    'class' => 'AppBundle\Entity\Warehouse',
                    'property' => 'name'
                ),
                array(
                    'admin_code' => 'admin.branch_warehouse'
                )
            )
            ->add('productCategory', 'sonata_type_model', array(
                'class' => 'AppBundle\Entity\ProductCategory',
                'property' => 'name'
            ))
            ->add('area', 'number')
        ;
    }
}