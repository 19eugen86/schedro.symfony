<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 12.02.2016
 * Time: 12:23
 */

namespace AppBundle\Admin;


use AppBundle\Entity\Warehouse;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

abstract class WarehouseAdmin extends Admin
{
    protected $label;
    protected $departmentType;
    protected $departmentAdminCode;
    protected $warehouseCellsAdminCode;

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name', null, array(
                'route' => array('name' => 'show')
            ))
            ->add('department.name', null, array(
                'label' => $this->getLabel()
            ))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ));
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text')
            ->add('department', 'entity',
                array(
                    'class' => 'AppBundle\Entity\Department',
                    'property' => 'name',
                    'label' => $this->getLabel(),
                    'query_builder' => function (EntityRepository $er) {
                        $qb = $er->createQueryBuilder('department');
                        $qb
                            ->where('department.type = :type')
                            ->setParameter('type', $this->getDepartmentType());

                        return $qb;
                    }
                ),
                array(
                    'admin_code' => $this->getDepartmentAdminCode()
                )
            );
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('department.name', null, array(
                'label' => $this->getLabel(),
                'admin_code' => $this->getDepartmentAdminCode()
            ));
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('name')
            ->add('department.name', null, array(
                'label' => $this->getLabel(),
            ))
            ->add('cells', null, array(
                'template' => 'AppBundle:Admin:Warehouse_Cells.html.twig',
                'admin_code' => $this->getWarehouseCellsAdminCode()
            ));
    }

    public function toString($object)
    {
        return $object instanceof Warehouse
            ? $object->getName()
            : 'Warehouse';
    }

    public function createQuery($context = 'list')
    {
        $query = $this->getModelManager()->createQuery('AppBundle\Entity\Department');
        $query->andWhere(
            $query->expr()->eq($query->getRootAliases()[0] . '.type', ':type')
        );
        $query->setParameter(':type', $this->getDepartmentType());

        $departments = $query->execute();

        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAliases()[0] . '.department', ':department')
        );
        $query->setParameter(':department', $departments[0]);

        for ($i = 1; $i < count($departments); $i++) {
            $query->orWhere(
                $query->expr()->eq($query->getRootAliases()[0] . '.department', ':department' . $i)
            );
            $query->setParameter(':department' . $i, $departments[$i]);
        }

        return $query;
    }

    /**
     * @return mixed
     */
    public function getWarehouseCellsAdminCode()
    {
        return $this->warehouseCellsAdminCode;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return mixed
     */
    public function getDepartmentType()
    {
        return $this->departmentType;
    }

    /**
     * @return mixed
     */
    public function getDepartmentAdminCode()
    {
        return $this->departmentAdminCode;
    }


}