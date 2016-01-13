<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 05.01.2016
 * Time: 9:38
 */

namespace AdminBundle\Controller;


use AdminBundle\Entity\Product;
use AdminBundle\Form\Type\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/admin/products")
 */
class ProductController extends Controller
{
    /**
     * @Route("/", name="show_all_products")
     */
    public function indexAction()
    {
        $products = $this->getDoctrine()->getRepository('AdminBundle:Product')->findAll();
        return $this->render('AdminBundle:Product:index.html.twig', array(
            'products' => $products,
            'section' => 'Продукция'
        ));
    }

    /**
     * @Route("/page/{page}", name="show_products_by_page", defaults={"page": 1}, requirements={
     *      "page": "\d+"
     * })
     */
    public function showByPageAction($page)
    {
        $products = $this->getDoctrine()->getRepository('AdminBundle:Product')->findAll();
        return $this->render('AdminBundle:Product:index.html.twig', array(
            'products' => $products,
            'section' => 'Продукция'
        ));
    }

    /**
     * @Route("/new", name="add_new_product")
     */
    public function newAction(Request $request)
    {
        $product = new Product();

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            $this->addFlash(
                'success',
                'Продукт успешно добавлен!'
            );

            return $this->redirectToRoute("show_all_products");
        }

        return $this->render('AdminBundle:Product:new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/edit", name="edit_product", requirements={
     *      "id": "\d+"
     * })
     */
    public function editAction(Request $request, $id)
    {
        $product = $this->getDoctrine()->getRepository('AdminBundle:Product')->find($id);
        if (!$product) {
            throw $this->createNotFoundException('Продукт не найден');
        }

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            $this->addFlash(
                'info',
                'Продукт изменен!'
            );

            return $this->redirectToRoute("show_all_products");
        }

        return $this->render('AdminBundle:Product:edit.html.twig', array(
            'form' => $form->createView(),
            'id' => $product->getId()
        ));
    }

    /**
     * @Route("/{id}/delete", name="delete_product", requirements={
     *      "id": "\d+"
     * })
     */
    public function deleteAction($id)
    {
        $product = $this->getDoctrine()->getRepository('AdminBundle:Product')->find($id);
        if (!$product) {
            throw $this->createNotFoundException('Продукт не найден');
        }

        $em = $this->getDoctrine()->getManager();
//        $em->remove($product);
//        $em->flush();

        $this->addFlash(
            'success',
            'Продукт успешно удален!'
        );

        return $this->redirectToRoute("show_all_products");
    }
}