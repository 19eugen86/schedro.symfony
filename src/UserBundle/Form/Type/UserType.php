<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 20.01.2016
 * Time: 10:48
 */

namespace UserBundle\Form\Type;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class)
            ->add('password', PasswordType::class)
            ->add('fullName', TextType::class)
            ->add('phone', TextType::class)
            ->add('email', EmailType::class)
            ->add('groups', EntityType::class, array(
//                'mapped' => false,
                'class' => 'UserBundle\Entity\Group',
                'choice_label' => 'name',
                'multiple' => true
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\User'
        ));
    }
}