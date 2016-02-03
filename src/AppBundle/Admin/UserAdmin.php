<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 02.02.2016
 * Time: 14:47
 */

namespace AppBundle\Admin;


use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use UserBundle\Entity\User;

class UserAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
//        $builder
//            ->add('username', TextType::class)
//            ->add('password', PasswordType::class)
//            ->add('fullName', TextType::class)
//            ->add('phone', TextType::class)
//            ->add('email', EmailType::class)
//            ->add('groups', EntityType::class, array(
//                'class' => 'UserBundle\Entity\Group',
//                'choice_label' => 'name',
//                'multiple' => true
//            ))
//        ;


        $formMapper
            ->add('username', 'text')
            ->add('password', 'password')
            ->add('fullName', 'text')
            ->add('phone', 'text')
            ->add('email', 'email')
//            ->add('groups', 'sonata_type_model', array('expanded' => true))
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('fullName')
            ->add('phone')
            ->add('email')
            ->add('groups.group.name')
            ->add('username')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {

    }

    public function toString($object)
    {
        return $object instanceof User
            ? $object->getFullName()
            : 'User';
    }
}