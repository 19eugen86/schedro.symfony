<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 29.12.2015
 * Time: 16:12
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Country;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/admin/countries")
 */
class CountryController extends Controller
{
    /**
     * @Route("/", name="all_countries")
     */
    public function indexAction()
    {
        $countries = $this->getDoctrine()->getRepository('AppBundle:Country')->findAll();

        return new Response(
            $this->get('serializer')->serialize($countries, 'json'),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/new", name="new_country")
     */
    public function newAction(Request $request)
    {
        $country = new Country();

        $form = $this->createFormBuilder($country)
            ->add('name', TextType::class, array('label' => 'Country'))
            ->add('save', SubmitType::class, array('label' => 'Save'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($country);
            $em->flush();

            return $this->redirectToRoute("all_countries");
        }

        return $this->render('default/new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{name}", name="show_country")
     */
    public function showAction($name)
    {
        $country = $this->getDoctrine()->getRepository('AppBundle:Country')->findOneByName($name);
        if (!$country) {
            throw $this->createNotFoundException(
                'No country found for name '.$name
            );
        }

        return new Response(
            $this->get('serializer')->serialize($country, 'json'),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/{name}/edit", name="edit_country")
     */
    public function editAction(Request $request, $name)
    {
        $country = $this->getDoctrine()->getRepository('AppBundle:Country')->findOneByName($name);

        $form = $this->createFormBuilder($country)
            ->add('name', TextType::class, array('label' => 'Country'))
            ->add('save', SubmitType::class, array('label' => 'Save'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($country);
            $em->flush();

            return $this->redirectToRoute("show_country", array(
                'name' => $country->getName()
            ));
        }

        return $this->render('default/new.html.twig', array(
            'form' => $form->createView()
        ));
    }
}