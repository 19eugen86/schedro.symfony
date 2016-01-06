<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 05.01.2016
 * Time: 9:38
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Product;
use AppBundle\Form\Type\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * @Route("/admin/products", name="show_all_products")
     */
    public function showAllAction()
    {
        $products = $this->getDoctrine()->getRepository('AppBundle:Product')->findAll();
        return $this->render('product/index.html.twig', array(
            'products' => $products
        ));
    }

    /**
     * @Route("/admin/product-categories/{categoryName}/products", name="category_products")
     */
    public function indexAction($categoryName)
    {
        $category = $this->getDoctrine()->getRepository('AppBundle:ProductCategory')->findOneByName($categoryName);
        if (!$category) {
            throw $this->createNotFoundException(
                'No category found for name '.$categoryName
            );
        }

        $products = $this->getDoctrine()->getRepository('AppBundle:Product')->findByCategory($category);
        return new Response(
            $this->get('serializer')->serialize($products, 'json'),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/admin/product-categories/{categoryName}/products/new", name="add_new_product")
     */
    public function newAction(Request $request, $categoryName)
    {
        $category = $this->getDoctrine()->getRepository('AppBundle:ProductCategory')->findOneByName($categoryName);
        if (!$category) {
            throw $this->createNotFoundException(
                'No category found for name '.$categoryName
            );
        }

        $product = new Product();
        $product->setCategory($category);

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute("category_products", array(
                'categoryName' => $category->getName()
            ));
        }

        return $this->render('default/new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/product-categories/{categoryName}/products/{productName}", name="show_product")
     */
    public function showAction($categoryName, $productName)
    {
        $category = $this->getDoctrine()->getRepository('AppBundle:ProductCategory')->findOneByName($categoryName);
        if (!$category) {
            throw $this->createNotFoundException(
                'No category found for name '.$categoryName
            );
        }

        $product = $this->getDoctrine()->getRepository('AppBundle:Product')->findOneBy(array(
            'name' => $productName,
            'category' => $category
        ));

        return new Response(
            $this->get('serializer')->serialize($product, 'json'),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/admin/product-categories/{categoryName}/products/{productName}/edit", name="edit_product")
     */
    public function editAction(Request $request, $categoryName, $productName)
    {
        $category = $this->getDoctrine()->getRepository('AppBundle:ProductCategory')->findOneByName($categoryName);
        if (!$category) {
            throw $this->createNotFoundException(
                'No category found for name '.$categoryName
            );
        }

        $product = $this->getDoctrine()->getRepository('AppBundle:Product')->findOneByName($productName);
        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for name '.$productName
            );
        }

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            $em->refresh($product);

            return $this->redirectToRoute("show_product", array(
                'categoryName' => $category->getName(),
                'productName' => $product->getName()
            ));
        }

        return $this->render('default/new.html.twig', array(
            'form' => $form->createView()
        ));
    }
}