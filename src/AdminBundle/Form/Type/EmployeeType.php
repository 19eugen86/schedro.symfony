<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 20.01.2016
 * Time: 10:48
 */

namespace AdminBundle\Form\Type;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class)
            ->add('password', PasswordType::class)
            ->add('fullname', TextType::class)
            ->add('phone', TextType::class)
            ->add('email', EmailType::class)
            ->add('category', EntityType::class, array(
                'class' => 'AdminBundle\Entity\EmployeeCategory',
                'choice_label' => 'name'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\Employee'
        ));
    }
}