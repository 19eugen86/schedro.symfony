<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 03.02.2016
 * Time: 10:29
 */

namespace AppBundle\Admin;


use AppBundle\Entity\Department;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class FactoryAdmin extends Admin
{
    protected $baseRouteName = 'sonata_factories';
    protected $baseRoutePattern = 'departments/factories';

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('description')
            ->add('address')
            ->add('city.name')
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

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAliases()[0].'.type', ':type')
        );
        $query->setParameter('type', Department::FACTORY);

        return $query;
    }

    public function toString($object)
    {
        return $object instanceof Department
            ? $object->getName()
            : 'Factory';
    }

    public function getNewInstance()
    {
        $instance = parent::getNewInstance();
        $instance->setType(Department::FACTORY);

        return $instance;
    }
}