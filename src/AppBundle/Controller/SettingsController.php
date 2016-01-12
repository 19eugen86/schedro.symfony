<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 12.01.2016
 * Time: 9:57
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/admin/settings")
 */
class SettingsController extends Controller
{
    /**
     * @Route("/", name="show_system_settings")
     */
    public function indexAction()
    {
        return $this->render('admin/settings/index.html.twig', array(
            'section' => 'Настройки'
        ));
    }
}