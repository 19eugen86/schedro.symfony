<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 15.01.2016
 * Time: 14:38
 */

namespace AdminBundle\Form\Type;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

class ProportionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', EntityType::class, array(
                'class' => 'AdminBundle\Entity\ProductCategory',
                'choice_label' => 'name',
                'mapped' => false
            ))
            ->add('product', EntityType::class, array(
                'class' => 'AdminBundle\Entity\Product',
                'choice_label' => 'name'
            ))
            ->add('unit1', EntityType::class, array(
                'class' => 'AdminBundle\Entity\Unit',
                'choice_label' => 'shortName'
            ))
            ->add('unit2', EntityType::class, array(
                'class' => 'AdminBundle\Entity\Unit',
                'choice_label' => 'shortName'
            ))
            ->add('ratio', NumberType::class)
        ;
    }
}