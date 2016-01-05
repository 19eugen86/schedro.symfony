<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 30.12.2015
 * Time: 12:44
 */

namespace AppBundle\Controller;


use AppBundle\Entity\City;
use AppBundle\Form\Type\CityType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CityController extends Controller
{
    /**
     * @Route("/admin/cities", name="all_cities")
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
     * @Route("/admin/countries/{countryName}/cities", name="country_cities")
     */
    public function indexAction($countryName)
    {
        $country = $this->getDoctrine()->getRepository('AppBundle:Country')->findOneByName($countryName);
        if (!$country) {
            throw $this->createNotFoundException(
                'No country found for name '.$countryName
            );
        }

        $cities = $this->getDoctrine()->getRepository('AppBundle:City')->findByCountry($country);

        return new Response(
            $this->get('serializer')->serialize($cities, 'json'),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/admin/countries/{countryName}/cities/new", name="new_city")
     */
    public function newAction(Request $request, $countryName)
    {
        $country = $this->getDoctrine()->getRepository('AppBundle:Country')->findOneByName($countryName);
        if (!$country) {
            throw $this->createNotFoundException(
                'No country found for name '.$countryName
            );
        }

        $city = new City();
        $city->setCountry($country);

        $form = $this->createForm(CityType::class, $city);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($city);
            $em->flush();

            return $this->redirectToRoute("country_cities", array(
                'countryName' => $country->getName()
            ));
        }

        return $this->render('default/new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/countries/{countryName}/cities/{cityName}", name="show_city")
     */
    public function showAction($countryName, $cityName)
    {
        $country = $this->getDoctrine()->getRepository('AppBundle:Country')->findOneByName($countryName);
        if (!$country) {
            throw $this->createNotFoundException(
                'No country found for name '.$countryName
            );
        }

        $city = $this->getDoctrine()->getRepository('AppBundle:City')->findOneBy(array(
            'name' => $cityName,
            'country' => $country
        ));

        return new Response(
            $this->get('serializer')->serialize($city, 'json'),
            200,
            array('Content-Type' => 'application/json')
        );
    }
}