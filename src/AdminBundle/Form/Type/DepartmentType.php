<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 06.01.2016
 * Time: 14:47
 */

namespace AdminBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DepartmentType extends AbstractType
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
            ->add('type', HiddenType::class, array(
                'data' => $options['data']->getType()
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\Department'
        ));
    }
}