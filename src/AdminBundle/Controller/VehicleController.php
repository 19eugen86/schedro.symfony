<?php
/**
 * Created by PhpStorm.
 * User: EDLENKO
 * Date: 16.01.2016
 * Time: 14:01
 */

namespace AdminBundle\Controller;


use AdminBundle\Entity\Vehicle;
use AdminBundle\Form\Type\VehicleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin/transport/vehicles")
 */
class VehicleController extends Controller
{
    /**
     * @Route(
     *      "/{pageParam}/{page}",
     *      name="show_vehicles",
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
        $vehicles = $this->getDoctrine()->getRepository('AdminBundle:Vehicle')->findAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($vehicles, $page);

        return $this->render('AdminBundle:Vehicle:index.html.twig', array(
            'pagination' => $pagination
        ));
    }

    /**
     * @Route("/new", name="add_new_vehicle")
     */
    public function newAction(Request $request)
    {
        $vehicle = new Vehicle();

        $form = $this->createForm(VehicleType::class, $vehicle, array(
            'action' => $this->generateUrl("add_new_vehicle"),
            'method' => "POST"
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($vehicle);
            $em->flush();

            $this->addFlash(
                'success',
                'Автомобиль успешно добавлен!'
            );

            return $this->redirectToRoute("show_vehicles");
        }

        return $this->render('AdminBundle:Vehicle:form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/edit", name="edit_vehicle", requirements={
     *      "id": "\d+"
     * })
     */
    public function editAction(Request $request, $id)
    {
        $vehicle = $this->getDoctrine()->getRepository('AdminBundle:Vehicle')->find($id);
        if (!$vehicle) {
            throw $this->createNotFoundException('Автомобиль не найден');
        }

        $form = $this->createForm(VehicleType::class, $vehicle, array(
            'action' => $this->generateUrl("edit_vehicle", array(
                'id' => $vehicle->getId()
            )),
            'method' => "POST"
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($vehicle);
            $em->flush();

            $this->addFlash(
                'info',
                'Автомобиль успешно изменен!'
            );

            return $this->redirectToRoute("show_vehicles");
        }

        return $this->render('AdminBundle:Vehicle:form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/delete", name="delete_vehicle", requirements={
     *      "id": "\d+"
     * })
     */
    public function deleteAction($id)
    {
        $vehicle = $this->getDoctrine()->getRepository('AdminBundle:Vehicle')->find($id);
        if (!$vehicle) {
            throw $this->createNotFoundException('Автомобиль не найден');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($vehicle);
        $em->flush();

        $this->addFlash(
            'info',
            'Автомобиль успешно удален!'
        );

        return $this->redirectToRoute("show_vehicles");
    }
}