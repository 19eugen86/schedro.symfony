<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 22.01.2016
 * Time: 15:03
 */

namespace AdminBundle\Form\Type;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WarehouseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('department', EntityType::class, array(
                'class' => 'AdminBundle:Department',
                'choices' => $options['departments'],
                'choice_label' => 'name'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\Warehouse',
            'departments' => array()
        ));
    }
}