<?php
/**
 * Created by PhpStorm.
 * User: EDLENKO
 * Date: 16.01.2016
 * Time: 13:57
 */

namespace AdminBundle\Form\Type;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehicleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('brand', TextType::class)
            ->add('model', TextType::class)
            ->add('registrationNumber', TextType::class)
            ->add('carrier', EntityType::class, array(
                'class' => 'AdminBundle\Entity\Carrier',
                'choice_label' => 'name'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\Vehicle'
        ));
    }
}