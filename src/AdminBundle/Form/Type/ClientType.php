<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 06.01.2016
 * Time: 9:43
 */

namespace AdminBundle\Form\Type;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ClientType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('address', TextareaType::class)
            ->add('city', EntityType::class, array(
                'class' => 'AdminBundle:City',
                'choice_label' => 'name'
            ))
        ;
    }
}