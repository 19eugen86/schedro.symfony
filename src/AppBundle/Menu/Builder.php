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
        $menu->setChildrenAttribute('class', 'nav navbar-nav');

        // Factories menu
        $menu->addChild('Factories', array('route' => 'show_factories_reminders'))->setAttributes(array('icon' => 'glyphicon glyphicon-export'));

        // Distribution centers menu
        $menu
            ->addChild('Distribution Centers', array('uri' => '#'))
            ->setAttributes(array(
                'class' => 'dropdown',
                'icon' => 'glyphicon glyphicon-move'
            ))
            ->setLinkAttributes(array(
                'class' => 'dropdown-toggle',
                'data-toggle' => 'dropdown'
            ))
            ->setChildrenAttributes(array(
                'class' => 'dropdown-menu'
            ))
        ;
        $menu['Distribution Centers']->addChild('Reminders', array('uri' => '#'))->setAttribute('icon', 'glyphicon glyphicon-compressed');
        $menu['Distribution Centers']->addChild('Warehouses', array('uri' => '#'))->setAttribute('icon', 'glyphicon glyphicon-cloud');
        $menu['Distribution Centers']->addChild('Arrival', array('uri' => '#'))->setAttribute('icon', 'glyphicon glyphicon-cloud-upload');
        $menu['Distribution Centers']->addChild('Consumption', array('uri' => '#'))->setAttribute('icon', 'glyphicon glyphicon-cloud-download');

        // Branches menu
        $menu
            ->addChild('Branches', array('uri' => '#'))
            ->setAttributes(array(
                'class' => 'dropdown',
                'icon' => 'glyphicon glyphicon-home'
            ))
            ->setLinkAttributes(array(
                'class' => 'dropdown-toggle',
                'data-toggle' => 'dropdown'
            ))
            ->setChildrenAttributes(array(
                'class' => 'dropdown-menu'
            ))
        ;
        $menu['Branches']->addChild('Reminders', array('uri' => '#'))->setAttribute('icon', 'glyphicon glyphicon-compressed');
        $menu['Branches']->addChild('Warehouses', array('uri' => '#'))->setAttribute('icon', 'glyphicon glyphicon-cloud');
        $menu['Branches']->addChild('Arrival', array('uri' => '#'))->setAttribute('icon', 'glyphicon glyphicon-cloud-upload');
        $menu['Branches']->addChild('Consumption', array('uri' => '#'))->setAttribute('icon', 'glyphicon glyphicon-cloud-download');

        return $menu;

    }
}