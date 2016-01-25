<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 25.01.2016
 * Time: 10:25
 */

namespace AdminBundle\Form\Type;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WarehouseCellType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('area', TextType::class)
            ->add('productCategory', EntityType::class, array(
                'class' => 'AdminBundle\Entity\ProductCategory',
                'choice_label' => 'name'
            ))
            ->add('warehouse', TextType::class, array(
                'mapped' => false,
                'data' => $options['data']->getWarehouse()->getName(),
                'disabled' => true
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\WarehouseCell'
        ));
    }
}