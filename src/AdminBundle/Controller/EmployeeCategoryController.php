<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 20.01.2016
 * Time: 10:56
 */

namespace AdminBundle\Controller;


use AdminBundle\Entity\EmployeeCategory;
use AdminBundle\Form\Type\EmployeeCategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin/employees/categories")
 */
class EmployeeCategoryController extends Controller
{
    /**
     * @Route("/", name="show_all_employee_categories")
     */
    public function indexAction()
    {
        $categories = $this->get('fos_user.group_manager')->findGroups();
        return $this->render('AdminBundle:EmployeeCategory:index.html.twig', array(
            'categories' => $categories,
            'section' => 'Сотрудники'
        ));
    }

    /**
     * TODO:
     * @Route("/page/{page}", name="show_employee_categories_by_page", defaults={"page": 1}, requirements={
     *      "page": "\d+"
     * })
     */
    public function showByPageAction($page)
    {
        $categories = $this->get('fos_user.group_manager')->findGroups();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($categories, $page, 5);

        return $this->render('AdminBundle:EmployeeCategory:index.html.twig', array(
            'pagination' => $pagination,
            'section' => 'Сотрудники',
        ));
    }

    /**
     * @Route("/new", name="add_new_employee_category")
     */
    public function newAction(Request $request)
    {
        $category = new EmployeeCategory();

        $form = $this->createForm(EmployeeCategoryType::class, $category, array(
            'action' => $this->generateUrl("add_new_employee_category"),
            'method' => "POST"
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $this->addFlash(
                'success',
                'Категория успешно добавлена!'
            );

            return $this->redirectToRoute("show_all_employee_categories");
        }

        return $this->render("AdminBundle:EmployeeCategory:form.html.twig", array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/edit", name="edit_employee_category", requirements={
     *      "id": "\d+"
     * })
     */
    public function editAction(Request $request, $id)
    {
        $category = $this->getDoctrine()->getRepository('AdminBundle:EmployeeCategory')->find($id);
        if (!$category) {
            throw $this->createNotFoundException('Категория не найдена');
        }

        $form = $this->createForm(EmployeeCategoryType::class, $category, array(
            'action' => $this->generateUrl("edit_employee_category", array(
                'id' => $category->getId()
            )),
            'method' => "POST"
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $this->addFlash(
                'info',
                'Категория изменена!'
            );

            return $this->redirectToRoute("show_all_employee_categories");
        }

        return $this->render("AdminBundle:EmployeeCategory:form.html.twig", array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/delete", name="delete_employee_category", requirements={
     *      "id": "\d+"
     * })
     */
    public function deleteAction($id)
    {
        $category = $this->getDoctrine()->getRepository('AdminBundle:EmployeeCategory')->find($id);
        if (!$category) {
            throw $this->createNotFoundException('Категория не найдена');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();

        $this->addFlash(
            'success',
            'Категория успешно удалена!'
        );

        return $this->redirectToRoute("show_all_employee_categories");
    }
}