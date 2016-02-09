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
        $menu
            ->addChild('Factories', array('uri' => '#'))
            ->setAttributes(array(
                'class' => 'dropdown',
                'icon' => 'glyphicon glyphicon-export'
            ))
            ->setLinkAttributes(array(
                'class' => 'dropdown-toggle',
                'data-toggle' => 'dropdown'
            ))
            ->setChildrenAttributes(array(
                'class' => 'dropdown-menu'
            ))
        ;
        $menu['Factories']->addChild('Reminders', array('uri' => '#'))->setAttribute('icon', 'glyphicon glyphicon-compressed');
        $menu['Factories']->addChild('Arrival', array('uri' => '#'))->setAttribute('icon', 'glyphicon glyphicon-save');
        $menu['Factories']->addChild('Consumption', array('uri' => '#'))->setAttribute('icon', 'glyphicon glyphicon-open');

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

    public function logoutMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav navbar-right');

        $menu->addChild('Logout', array('route' => 'fos_user_security_logout'))->setAttribute('icon', 'glyphicon glyphicon-log-out');

        return $menu;
    }
}