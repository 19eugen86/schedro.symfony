<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 05.02.2016
 * Time: 12:25
 */

namespace AppBundle\Admin;


use AppBundle\Entity\Department;
use AppBundle\Entity\Warehouse;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class DistributionCenterWarehouseAdmin extends Admin
{
    protected $baseRouteName = 'sonata_distributions_centers_warehouses';
    protected $baseRoutePattern = 'departments/distribution_centers/warehouses';

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name', null, array(
                'route' => array('name' => 'show')
            ))
            ->add('department.name', null, array(
                'label' => 'Distribution Center'
            ))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
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
            ->add('department', 'sonata_type_model',
                array(
                    'class' => 'AppBundle\Entity\Department',
                    'property' => 'name',
                    'label' => 'Branch',
                    'query_builder' => function (EntityRepository $er) {
                        $qb = $er->createQueryBuilder('department');
                        $qb
                            ->where('department.type = :type')
                            ->setParameter('type', Department::DISTRIBUTION_CENTER)
                        ;
                        return $qb;
                    }
                ),
                array(
                    'admin_code' => 'admin.distribution_center'
                )
            )
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('department.name', null, array(
                'label' => 'Distribution Center'
            ))
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('name')
            ->add('department.name', null, array(
                'label' => 'Distribution Center',
            ))
            ->add('cells')
        ;
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
            $query->expr()->eq($query->getRootAliases()[0].'.type', ':type')
        );
        $query->setParameter(':type', Department::DISTRIBUTION_CENTER);

        $departments = $query->execute();

        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAliases()[0].'.department', ':department')
        );
        $query->setParameter(':department', $departments[0]);

        for ($i = 1; $i < count($departments); $i++) {
            $query->orWhere(
                $query->expr()->eq($query->getRootAliases()[0].'.department', ':department'.$i)
            );
            $query->setParameter(':department'.$i, $departments[$i]);
        }

        return $query;
    }
}