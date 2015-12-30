<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 30.12.2015
 * Time: 12:44
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CityController extends Controller
{
    /**
     * @Route("/cities", name="all_cities")
     */
    public function showAllAction()
    {
        $cities = $this->getDoctrine()->getRepository('AppBundle:City')->findAll();

        return new Response(
            $this->get('serializer')->serialize($cities, 'json'),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/countries/{countryId}/cities", name="country_cities", requirements={
     *      "countryId": "\d+"
     * })
     */
    public function indexAction($countryId)
    {
        $countryCities = $this->getDoctrine()->getRepository('AppBundle:City')->findByCountryId($countryId);

        return new Response(
            $this->get('serializer')->serialize($countryCities, 'json'),
            200,
            array('Content-Type' => 'application/json')
        );
    }
}