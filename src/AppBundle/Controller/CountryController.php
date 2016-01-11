<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 29.12.2015
 * Time: 16:12
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Country;
use AppBundle\Form\Type\CountryType;
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
     * @Route("/", name="show_all_countries")
     */
    public function indexAction()
    {
        $countries = $this->getDoctrine()->getRepository('AppBundle:Country')->findAll();
        return $this->render('admin/country/index.html.twig', array(
            'countries' => $countries
        ));
    }

    /**
     * @Route("/page/{page}", name="show_countries_by_page", defaults={"page": 1}, requirements={
     *      "page": "\d+"
     * })
     */
    public function showByPageAction($page)
    {
        $countries = $this->getDoctrine()->getRepository('AppBundle:Country')->findAll();
        return $this->render('admin/country/index.html.twig', array(
            'countries' => $countries
        ));
    }

    /**
     * @Route("/new", name="add_new_country")
     */
    public function newAction(Request $request)
    {
        $country = new Country();

        $form = $this->createForm(CountryType::class, $country);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($country);
            $em->flush();

            $this->addFlash(
                'success',
                'Страна успешно добавлена!'
            );

            return $this->redirectToRoute("show_all_countries");
        }

        return $this->render('admin/country/new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/edit", name="edit_country", requirements={
     *      "id": "\d+"
     * })
     */
    public function editAction(Request $request, $id)
    {
        $country = $this->getDoctrine()->getRepository('AppBundle:Country')->find($id);

        $form = $this->createForm(CountryType::class, $country);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($country);
            $em->flush();

            $this->addFlash(
                'info',
                'Страна изменена!'
            );

            return $this->redirectToRoute("show_all_countries");
        }

        return $this->render('admin/country/edit.html.twig', array(
            'form' => $form->createView(),
            'id' => $country->getId()
        ));
    }

    /**
     * @Route("/{id}/delete", name="delete_country", requirements={
     *      "id": "\d+"
     * })
     */
    public function deleteAction($id)
    {
        $country = $this->getDoctrine()->getRepository('AppBundle:Country')->find($id);
        if (!$country) {
            throw $this->createNotFoundException('Страна не найдена');
        }

        $em = $this->getDoctrine()->getManager();
//        $em->remove($country);
//        $em->flush();

        $this->addFlash(
            'success',
            'Страна успешно удалена!'
        );

        return $this->redirectToRoute("show_all_countries");
    }
}