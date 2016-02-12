<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 12.02.2016
 * Time: 12:02
 */

namespace AppBundle\Admin;


use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

abstract class WarehouseCellAdmin extends Admin
{
    protected $warehouseAdminCode;

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name')
            ->add('area')
            ->add('productCategory.name')
            ->add('warehouse.name')
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
            ->add('warehouse', 'entity',
                array(
                    'class' => 'AppBundle\Entity\Warehouse',
                    'property' => 'name',
                    'disabled' => true,
                    'label' => 'Warehouse',
                    'query_builder' => function (EntityRepository $er) {
                        $qb = $er->createQueryBuilder('warehouse');
                        $qb
                            ->where('warehouse.id = :id')
                            ->setParameter('id', $this->getRequest()->get('warehouseId'))
                        ;
                        return $qb;
                    }
                ),
                array(
                    'admin_code' => $this->getWarehouseAdminCode()
                )
            )
            ->add('productCategory', 'sonata_type_model', array(
                'class' => 'AppBundle\Entity\ProductCategory',
                'property' => 'name'
            ))
            ->add('area', 'number')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('area')
            ->add('productCategory.name')
            ->add('warehouse.name')
        ;
    }

    public function getPersistentParameters()
    {
        if (!$this->getRequest()) {
            return array();
        }

        return array(
            'warehouseId' => $this->getRequest()->get('warehouseId'),
            'id'  => $this->getRequest()->get('id'),
        );
    }

    /**
     * @return mixed
     */
    public function getWarehouseAdminCode()
    {
        return $this->warehouseAdminCode;
    }


}