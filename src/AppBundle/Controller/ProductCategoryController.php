<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 04.01.2016
 * Time: 16:44
 */

namespace AppBundle\Controller;


use AppBundle\Entity\ProductCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductCategoryController extends Controller
{
    /**
     * @Route("/admin/product-categories", name="all_product_categories")
     */
    public function indexAction()
    {
        $categories = $this->getDoctrine()->getRepository('AppBundle:ProductCategory')->findAll();
        return new Response(
            $this->get('serializer')->serialize($categories, 'json'),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/admin/product-categories/{name}", name="show_product_category")
     */
    public function showAction($name)
    {
        $category = $this->getDoctrine()->getRepository('AppBundle:ProductCategory')->findOneByName($name);
        if (!$category) {
            throw $this->createNotFoundException(
                'No product category found for name '.$name
            );
        }

        return new Response(
            $this->get('serializer')->serialize($category, 'json'),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/admin/product-categories/new", name="new_product_category")
     */
    public function newAction(Request $request)
    {
        $category = new ProductCategory();

        $form = $this->createFormBuilder($category)
            ->add('name', TextType::class, array('label' => 'Category'))
            ->add('save', SubmitType::class, array('label' => 'Save'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute("all_product_categories");
        }

        return $this->render('default/new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/product-categories/{name}/edit", name="edit_product_category")
     */
    public function editAction(Request $request, $name)
    {
        $category = $this->getDoctrine()->getRepository('AppBundle:ProductCategory')->findOneByName($name);
        if (!$category) {
            throw $this->createNotFoundException(
                'No product category found for name '.$name
            );
        }

        $form = $this->createFormBuilder($category)
            ->add('name', TextType::class, array('label' => 'Category'))
            ->add('save', SubmitType::class, array('label' => 'Save'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute("all_product_categories");
        }

        return $this->render('default/new.html.twig', array(
            'form' => $form->createView()
        ));
    }
}