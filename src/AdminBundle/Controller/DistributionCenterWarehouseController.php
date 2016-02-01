<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 22.01.2016
 * Time: 15:18
 */

namespace AdminBundle\Controller;


use AdminBundle\Entity\Department;
use AdminBundle\Entity\Warehouse;
use AdminBundle\Form\Type\WarehouseType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin/departments/distribution-centers/warehouses")
 */
class DistributionCenterWarehouseController extends Controller
{
    /**
     * @Route(
     *      "/{pageParam}/{page}",
     *      name="show_distribution_centers_warehouses",
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
        $distributionCenters = $this->getDoctrine()->getRepository('AdminBundle:Department')->findByType(Department::DISTRIBUTION_CENTER);
        $warehouses = $this->getDoctrine()->getRepository('AdminBundle:Warehouse')->findByDepartment($distributionCenters);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($warehouses, $page);

        return $this->render("AdminBundle:DistributionCenter/Warehouse:index.html.twig", array(
            'pagination' => $pagination
        ));
    }

    /**
     * @Route("/new", name="add_new_distribution_centers_warehouse")
     */
    public function newAction(Request $request)
    {
        $warehouse = new Warehouse();

        $form = $this->createForm(WarehouseType::class, $warehouse, array(
            'action' => $this->generateUrl("add_new_distribution_centers_warehouse"),
            'method' => "POST",
            'departments' => $this->getDoctrine()->getRepository('AdminBundle:Department')->findByType(Department::DISTRIBUTION_CENTER)
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($warehouse);
            $em->flush();

            $this->addFlash(
                'success',
                'Склад успешно добавлен!'
            );

            return $this->redirectToRoute("show_distribution_centers_warehouses");
        }

        return $this->render("AdminBundle:DistributionCenter/Warehouse:form.html.twig", array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/edit", name="edit_distribution_centers_warehouse", requirements={
     *      "id": "\d+"
     * })
     */
    public function editAction(Request $request, $id)
    {
        $warehouse = $this->getDoctrine()->getRepository('AdminBundle:Warehouse')->find($id);
        if (!$warehouse) {
            throw $this->createNotFoundException('Склад не найден');
        }

        $form = $this->createForm(WarehouseType::class, $warehouse, array(
            'action' => $this->generateUrl("edit_distribution_centers_warehouse", array(
                'id' => $warehouse->getId()
            )),
            'method' => "POST",
            'departments' => $this->getDoctrine()->getRepository('AdminBundle:Department')->findByType(Department::DISTRIBUTION_CENTER)
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($warehouse);
            $em->flush();

            $this->addFlash(
                'info',
                'Склад изменен!'
            );

            return $this->redirectToRoute("show_distribution_centers_warehouses");
        }

        return $this->render("AdminBundle:DistributionCenter/Warehouse:form.html.twig", array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/delete", name="delete_distribution_centers_warehouse", requirements={
     *      "id": "\d+"
     * })
     */
    public function deleteAction($id)
    {
        $warehouse = $this->getDoctrine()->getRepository('AdminBundle:Warehouse')->find($id);
        if (!$warehouse) {
            throw $this->createNotFoundException('Склад не найден');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($warehouse);
        $em->flush();

        $this->addFlash(
            'success',
            'Склад успешно удален!'
        );

        return $this->redirectToRoute("show_distribution_centers_warehouses");
    }
}