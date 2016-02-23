<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 23.02.2016
 * Time: 14:42
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Department;
use AppBundle\Entity\ProductFactored;
use AppBundle\Form\Type\ProductFactoredReceiveType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("departments/factories")
 */
class ProductsFactoredController extends Controller
{
    /**
     * @Route(
     *      "/reminders/{pageParam}/{page}",
     *      name="show_factories_reminders",
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
    public function showReminders($page)
    {
        $factories = $this->getDoctrine()->getRepository('AppBundle:Department')->findByType(Department::FACTORY);
        $productsFactored = $this->getDoctrine()->getRepository('AppBundle:ProductFactored')->findByDepartment($factories);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($productsFactored, $page);

        return $this->render(':ProductsFactored:reminders.html.twig', array(
            'pagination' => $pagination
        ));
    }

    /**
     * @Route("/products/receive", name="receive_products_factored")
     */
    public function receiveAction(Request $request)
    {
        $productFactored = new ProductFactored();
        $productFactored->setUser($this->getUser());

        $form = $this->createForm(ProductFactoredReceiveType::class, $productFactored, array(
            'action' => $this->generateUrl("receive_products_factored"),
            'method' => "POST",
            'departments' => $this->getDoctrine()->getRepository('AppBundle:Department')->findByType(Department::FACTORY)
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($productFactored);
            $em->flush();

            $this->addFlash(
                'success',
                'Произведенная продукция успешно добавлен!'
            );

            return $this->redirectToRoute("show_factories_reminders");
        }

        return $this->render(':ProductsFactored:form_receive.html.twig', array(
            'form' => $form->createView()
        ));
    }
}