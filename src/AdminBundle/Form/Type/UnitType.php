<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 14.01.2016
 * Time: 14:35
 */

namespace AdminBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class UnitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('shortName', TextType::class)
            ->add('type', ChoiceType::class, array(
                'mapped' => false,
                'choices' => array(
                    'веса' => 'weight',
                    'площади' => 'area',
                    'объема' => 'volume',
                ),

                'choices_as_values' => true,
                'expanded' => true,
                'multiple' => false
            ))
            ->add('isWeight', HiddenType::class)
            ->add('isArea', HiddenType::class)
            ->add('isVolume', HiddenType::class)
        ;
    }
}