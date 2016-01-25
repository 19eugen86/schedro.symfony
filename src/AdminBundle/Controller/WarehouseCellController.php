<?php
/**
 * Created by PhpStorm.
 * User: EDLENKO
 * Date: 23.01.2016
 * Time: 11:44
 */

namespace AdminBundle\Controller;


use AdminBundle\Entity\WarehouseCell;
use AdminBundle\Form\Type\WarehouseCellType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin/warehouses")
 */
class WarehouseCellController extends Controller
{
    /**
     * @Route("/{warehouseId}/cells", name="show_all_cells_of_warehouse", requirements={
     *      "warehouseId": "\d+"
     * })
     */
    public function indexAction($warehouseId)
    {
        $warehouse = $this->getDoctrine()->getRepository('AdminBundle:Warehouse')->find($warehouseId);
        $cells = $this->getDoctrine()->getRepository('AdminBundle:WarehouseCell')->findByWarehouse($warehouse);

        // TODO: Used area calculation
        foreach ($cells as $key => $cell) {
            $cells[$key]->setUsedArea(rand(5, 100));
        }

        return $this->render('AdminBundle:WarehouseCell:index.html.twig', array(
            'cells' => $cells,
            'warehouse' => $warehouse
        ));
    }

    /**
     * @Route("/{warehouseId}/cells/new", name="add_new_warehouses_cell", requirements={
     *      "warehouseId": "\d+"
     * })
     */
    public function newAction(Request $request, $warehouseId)
    {
        $warehouse = $this->getDoctrine()->getRepository('AdminBundle:Warehouse')->find($warehouseId);
        if (!$warehouse) {
            throw $this->createNotFoundException('Склад не найден');
        }

        $cell = new WarehouseCell();
        $cell->setWarehouse($warehouse);

        $form = $this->createForm(WarehouseCellType::class, $cell, array(
            'action' => $this->generateUrl("add_new_warehouses_cell", array(
                'warehouseId' => $warehouse->getId()
            )),
            'method' => "POST"
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cell);
            $em->flush();

            $this->addFlash(
                'success',
                'Камера успешно добавлена!'
            );

            // TODO:
            return $this->redirectToRoute("show_all_branches_warehouses");
        }

        return $this->render('AdminBundle:WarehouseCell:form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{warehouseId}/cells/{id}/edit", name="edit_warehouses_cell", requirements={
     *      "id": "\d+"
     * })
     */
    public function editAction(Request $request, $warehouseId, $id)
    {
        $warehouse = $this->getDoctrine()->getRepository('AdminBundle:Warehouse')->find($warehouseId);
        if (!$warehouse) {
            throw $this->createNotFoundException('Склад не найден');
        }

        $cell = $this->getDoctrine()->getRepository('AdminBundle:WarehouseCell')->find($id);
        if (!$cell) {
            throw $this->createNotFoundException('Камера не найдена');
        }

        $form = $this->createForm(WarehouseCellType::class, $cell, array(
            'action' => $this->generateUrl("edit_warehouses_cell", array(
                'id' => $cell->getId(),
                'warehouseId' => $warehouse->getId()
            )),
            'method' => "POST"
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cell);
            $em->flush();

            $this->addFlash(
                'info',
                'Камера изменена!'
            );

            // TODO:
            return $this->redirectToRoute("show_all_branches_warehouses");
        }

        return $this->render('AdminBundle:WarehouseCell:form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{warehouseId}/cells/{id}/delete", name="delete_warehouses_cell", requirements={
     *      "id": "\d+"
     * })
     */
    public function deleteAction($warehouseId, $id)
    {
        $warehouse = $this->getDoctrine()->getRepository('AdminBundle:Warehouse')->find($warehouseId);
        if (!$warehouse) {
            throw $this->createNotFoundException('Склад не найден');
        }

        $cell = $this->getDoctrine()->getRepository('AdminBundle:WarehouseCell')->find($id);
        if (!$cell) {
            throw $this->createNotFoundException('Камера не найдена');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($cell);
        $em->flush();

        $this->addFlash(
            'success',
            'Камера успешно удалена!'
        );

        // TODO:
        return $this->redirectToRoute("show_all_branches_warehouses");
    }
}