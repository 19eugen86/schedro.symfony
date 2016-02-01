<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 30.12.2015
 * Time: 12:44
 */

namespace AdminBundle\Controller;


use AdminBundle\Entity\City;
use AdminBundle\Form\Type\CityType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin/cities")
 */
class CityController extends Controller
{
    /**
     * @Route(
     *      "/{pageParam}/{page}",
     *      name="show_cities",
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
        $cities = $this->getDoctrine()->getRepository('AdminBundle:City')->findAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($cities, $page);

        return $this->render('AdminBundle:City:index.html.twig', array(
            'pagination' => $pagination
        ));
    }

    /**
     * @Route("/new", name="add_new_city")
     */
    public function newAction(Request $request)
    {
        $city = new City();

        $form = $this->createForm(CityType::class, $city, array(
            'action' => $this->generateUrl("add_new_city"),
            'method' => "POST"
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($city);
            $em->flush();

            $this->addFlash(
                'success',
                'Город успешно добавлен!'
            );

            return $this->redirectToRoute("show_cities");
        }

        return $this->render('AdminBundle:City:form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/edit", name="edit_city", requirements={
     *      "id": "\d+"
     * })
     */
    public function editAction(Request $request, $id)
    {
        $city = $this->getDoctrine()->getRepository("AdminBundle:City")->find($id);
        if (!$city) {
            throw $this->createNotFoundException('Город не найден');
        }

        $form = $this->createForm(CityType::class, $city, array(
            'action' => $this->generateUrl("edit_city", array(
                'id' => $city->getId()
            )),
            'method' => "POST"
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($city);
            $em->flush();

            $this->addFlash(
                'info',
                'Город изменен!'
            );

            return $this->redirectToRoute("show_cities");
        }

        return $this->render('AdminBundle:City:form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/delete", name="delete_city", requirements={
     *      "id": "\d+"
     * })
     */
    public function deleteAction($id)
    {
        $city = $this->getDoctrine()->getRepository("AdminBundle:City")->find($id);
        if (!$city) {
            throw $this->createNotFoundException('Город не найден');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($city);
        $em->flush();

        $this->addFlash(
            'success',
            'Город успешно удален!'
        );

        return $this->redirectToRoute("show_cities");
    }
}