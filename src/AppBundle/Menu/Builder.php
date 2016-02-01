<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 01.02.2016
 * Time: 12:28
 */

namespace AppBundle\Menu;


use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Home', array('route' => 'homepage', 'label' => 'Homepage'));
        $menu->addChild('About', array('route' => 'homepage'));
        $menu->addChild('Contacts', array('route' => 'homepage'));
        $menu->addChild('Not a link');

        $menu['Home']->setAttributes(array(
            'id' => 'back_to_homepage',
            'class' => 'active'
        ));

        return $menu;
    }
}