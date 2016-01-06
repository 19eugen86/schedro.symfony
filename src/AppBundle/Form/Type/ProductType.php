<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 05.01.2016
 * Time: 16:11
 */

namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('label' => 'Product'))
            ->add('save', SubmitType::class, array('label' => 'Save product'))
        ;
    }
}