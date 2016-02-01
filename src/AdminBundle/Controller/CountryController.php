<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 29.12.2015
 * Time: 16:12
 */

namespace AdminBundle\Controller;


use AdminBundle\Entity\Country;
use AdminBundle\Form\Type\CountryType;
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
     * @Route(
     *      "/{pageParam}/{page}",
     *      name="show_countries",
     *      defaults={
     *          "pageParam": "page",
     *          "page": 1
     *      },
     *      requirements={
     *          "pageParam": "page",
     *          "page": "\d+"
     *      }
     * )
     */
    public function indexAction($page)
    {
        $countries = $this->getDoctrine()->getRepository('AdminBundle:Country')->findAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($countries, $page);

        return $this->render('AdminBundle:Country:index.html.twig', array(
            'pagination' => $pagination
        ));
    }

    /**
     * @Route("/new", name="add_new_country")
     */
    public function newAction(Request $request)
    {
        $country = new Country();

        $form = $this->createForm(CountryType::class, $country, array(
                'action' => $this->generateUrl("add_new_country"),
                'method' => "POST"
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($country);
            $em->flush();

            $this->addFlash(
                'success',
                'Страна успешно добавлена!'
            );

            return $this->redirectToRoute("show_countries");
        }

        return $this->render('AdminBundle:Country:form.html.twig', array(
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
        $country = $this->getDoctrine()->getRepository('AdminBundle:Country')->find($id);

        $form = $this->createForm(CountryType::class, $country, array(
            'action' => $this->generateUrl("edit_country", array(
                'id' => $country->getId()
            )),
            'method' => "POST"
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($country);
            $em->flush();

            $this->addFlash(
                'info',
                'Страна изменена!'
            );

            return $this->redirectToRoute("show_countries");
        }

        return $this->render('AdminBundle:Country:form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/delete", name="delete_country", requirements={
     *      "id": "\d+"
     * })
     */
    public function deleteAction($id)
    {
        $country = $this->getDoctrine()->getRepository('AdminBundle:Country')->find($id);
        if (!$country) {
            throw $this->createNotFoundException('Страна не найдена');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($country);
        $em->flush();

        $this->addFlash(
            'success',
            'Страна успешно удалена!'
        );

        return $this->redirectToRoute("show_countries");
    }
}