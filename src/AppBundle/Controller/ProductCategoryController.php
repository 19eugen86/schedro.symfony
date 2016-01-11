<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 04.01.2016
 * Time: 16:44
 */

namespace AppBundle\Controller;


use AppBundle\Entity\ProductCategory;
use AppBundle\Form\Type\ProductCategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/admin/product-categories")
 */
class ProductCategoryController extends Controller
{
    /**
     * @Route("/", name="show_all_product_categories")
     */
    public function indexAction()
    {
        $categories = $this->getDoctrine()->getRepository('AppBundle:ProductCategory')->findAll();
        return $this->render('admin/product_category/index.html.twig', array(
            'categories' => $categories,
            'section' => 'Продукция'
        ));
    }

    /**
     * @Route("/page/{page}", name="show_product_categories_by_page", defaults={"page": 1}, requirements={
     *      "page": "\d+"
     * })
     */
    public function showByPageAction($page)
    {
        $categories = $this->getDoctrine()->getRepository('AppBundle:ProductCategory')->findAll();
        return $this->render('admin/product_category/index.html.twig', array(
            'categories' => $categories,
            'section' => 'Продукция'
        ));
    }

    /**
     * @Route("/new", name="add_new_product_category")
     */
    public function newAction(Request $request)
    {
        $category = new ProductCategory();

        $form = $this->createForm(ProductCategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $this->addFlash(
                'success',
                'Товарная группа успешно добавлена!'
            );

            return $this->redirectToRoute("show_all_product_categories");
        }

        return $this->render('admin/product_category/new.html.twig', array(
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
        $category = $this->getDoctrine()->getRepository('AppBundle:ProductCategory')->find($id);
        if (!$category) {
            throw $this->createNotFoundException('Товарная группа не найдена');
        }

        $form = $this->createForm(ProductCategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $this->addFlash(
                'info',
                'Товарная группа изменена!'
            );

            return $this->redirectToRoute("show_all_product_categories");
        }

        return $this->render('admin/product_category/edit.html.twig', array(
            'form' => $form->createView(),
            'id' => $category->getId()
        ));
    }

    /**
     * @Route("/{id}/delete", name="delete_product_category", requirements={
     *      "id": "\d+"
     * })
     */
    public function deleteAction($id)
    {
        $category = $this->getDoctrine()->getRepository('AppBundle:ProductCategory')->find($id);
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

        return $this->redirectToRoute("show_all_product_categories");
    }
}