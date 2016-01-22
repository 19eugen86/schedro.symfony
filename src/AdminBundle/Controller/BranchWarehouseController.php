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
 * @Route("/admin/departments/branches/warehouses")
 */
class BranchWarehouseController extends Controller
{
    /**
     * @Route("/", name="show_all_branches_warehouses")
     */
    public function indexAction()
    {
        $branches = $this->getDoctrine()->getRepository('AdminBundle:Department')->findByType(Department::BRANCH);
        $warehouses = $this->getDoctrine()->getRepository('AdminBundle:Warehouse')->findByDepartment($branches);

        return $this->render("AdminBundle:Branch/Warehouse:index.html.twig", array(
            'warehouses' => $warehouses,
            'section' => 'Филиалы'
        ));
    }

    /**
     * @Route("/pages/{page}", name="show_branches_warehouses_by_page", defaults={"page": 1}, requirements={
     *      "page": "\d+"
     * })
     */
    public function showByPageAction($page)
    {
        $branches = $this->getDoctrine()->getRepository('AdminBundle:Department')->findByType(Department::BRANCH);
        $warehouses = $this->getDoctrine()->getRepository('AdminBundle:Warehouse')->findByDepartment($branches);

        return $this->render("AdminBundle:Branch/Warehouse:index.html.twig", array(
            'warehouses' => $warehouses,
            'section' => 'Филиалы'
        ));
    }

    /**
     * @Route("/new", name="add_new_branches_warehouse")
     */
    public function newAction(Request $request)
    {
        $warehouse = new Warehouse();

        $form = $this->createForm(WarehouseType::class, $warehouse, array(
            'action' => $this->generateUrl("add_new_branches_warehouse"),
            'method' => "POST",
            'departments' => $this->getDoctrine()->getRepository('AdminBundle:Department')->findByType(Department::BRANCH)
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

            return $this->redirectToRoute("show_all_branches_warehouses");
        }

        return $this->render("AdminBundle:Branch/Warehouse:form.html.twig", array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/edit", name="edit_branches_warehouse", requirements={
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
            'action' => $this->generateUrl("edit_branches_warehouse", array(
                'id' => $warehouse->getId()
            )),
            'method' => "POST",
            'departments' => $this->getDoctrine()->getRepository('AdminBundle:Department')->findByType(Department::BRANCH)
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

            return $this->redirectToRoute("show_all_branches_warehouses");
        }

        return $this->render("AdminBundle:Branch/Warehouse:form.html.twig", array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/delete", name="delete_branches_warehouse", requirements={
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

        return $this->redirectToRoute("show_all_branches_warehouses");
    }
}