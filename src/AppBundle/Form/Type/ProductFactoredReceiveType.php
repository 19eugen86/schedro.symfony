<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 23.02.2016
 * Time: 16:45
 */

namespace AppBundle\Form\Type;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductFactoredReceiveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('department', EntityType::class, array(
                'class' => 'AppBundle:Department',
                'choices' => $options['departments'],
                'choice_label' => 'name'
            ))
            ->add('productCategory', EntityType::class, array(
                'mapped' => false,
                'class' => 'AppBundle:ProductCategory',
                'choice_label' => 'name'
            ))
            ->add('product', EntityType::class, array(
                'class' => 'AppBundle:Product',
                'choice_label' => 'name'
            ))
            ->add('quantity', NumberType::class)
            ->add('unit', EntityType::class, array(
                'class' => 'AppBundle:Unit',
                'choice_label' => 'name'
            ))
            ->add('consignment', TextType::class)
            ->add('date', DateTimeType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ProductFactored',
            'departments' => array()
        ));
    }
}