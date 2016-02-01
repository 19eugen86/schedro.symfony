<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 04.01.2016
 * Time: 16:44
 */

namespace AdminBundle\Controller;


use AdminBundle\Entity\ProductCategory;
use AdminBundle\Form\Type\ProductCategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin/products/categories")
 */
class ProductCategoryController extends Controller
{
    /**
     * @Route(
     *      "/{pageParam}/{page}",
     *      name="show_products_categories",
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
        $categories = $this->getDoctrine()->getRepository('AdminBundle:ProductCategory')->findAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($categories, $page);

        return $this->render('AdminBundle:ProductCategory:index.html.twig', array(
            'pagination' => $pagination
        ));
    }

    /**
     * @Route("/new", name="add_new_product_category")
     */
    public function newAction(Request $request)
    {
        $category = new ProductCategory();

        $form = $this->createForm(ProductCategoryType::class, $category, array(
            'action' => $this->generateUrl("add_new_product_category"),
            'method' => "POST"
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $this->addFlash(
                'success',
                'Товарная группа успешно добавлена!'
            );

            return $this->redirectToRoute("show_products_categories");
        }

        return $this->render('AdminBundle:ProductCategory:form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/edit", name="edit_product_category", requirements={
     *      "id": "\d+"
     * })
     */
    public function editAction(Request $request, $id)
    {
        $category = $this->getDoctrine()->getRepository('AdminBundle:ProductCategory')->find($id);
        if (!$category) {
            throw $this->createNotFoundException('Товарная группа не найдена');
        }

        $form = $this->createForm(ProductCategoryType::class, $category, array(
            'action' => $this->generateUrl("edit_product_category", array(
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
                'Товарная группа изменена!'
            );

            return $this->redirectToRoute("show_products_categories");
        }

        return $this->render('AdminBundle:ProductCategory:form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/delete", name="delete_product_category", requirements={
     *      "id": "\d+"
     * })
     */
    public function deleteAction($id)
    {
        $category = $this->getDoctrine()->getRepository('AdminBundle:ProductCategory')->find($id);
        if (!$category) {
            throw $this->createNotFoundException('Товарная группа не найдена');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();

        $this->addFlash(
            'success',
            'Товарная группа успешно удалена!'
        );

        return $this->redirectToRoute("show_products_categories");
    }
}