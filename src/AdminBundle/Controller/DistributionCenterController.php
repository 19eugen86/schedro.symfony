<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 20.01.2016
 * Time: 16:10
 */

namespace AdminBundle\Controller;


use AdminBundle\Entity\Department;
use AdminBundle\Form\Type\DepartmentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin/departments/distribution-centers")
 */
class DistributionCenterController extends Controller
{
    /**
     * @Route(
     *      "/{pageParam}/{page}",
     *      name="show_distribution_centers",
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

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($distributionCenters, $page);

        return $this->render('AdminBundle:DistributionCenter:index.html.twig', array(
            'pagination' => $pagination
        ));
    }

    /**
     * @Route("/new", name="add_new_distribution_center")
     */
    public function newAction(Request $request)
    {
        $distributionCenter = new Department(Department::DISTRIBUTION_CENTER);

        $form = $this->createForm(DepartmentType::class, $distributionCenter, array(
            'action' => $this->generateUrl("add_new_distribution_center"),
            'method' => "POST"
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($distributionCenter);
            $em->flush();

            $this->addFlash(
                'success',
                'РЦ успешно добавлен!'
            );

            return $this->redirectToRoute("show_distribution_centers");
        }

        return $this->render("AdminBundle:DistributionCenter:form.html.twig", array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/edit", name="edit_distribution_center", requirements={
     *      "id": "\d+"
     * })
     */
    public function editAction(Request $request, $id)
    {
        $distributionCenter = $this->getDoctrine()->getRepository('AdminBundle:Department')->find($id);
        if (!$distributionCenter) {
            throw $this->createNotFoundException('РЦ не найден');
        }

        $form = $this->createForm(DepartmentType::class, $distributionCenter, array(
            'action' => $this->generateUrl("edit_distribution_center", array(
                'id' => $distributionCenter->getId()
            )),
            'method' => "POST"
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($distributionCenter);
            $em->flush();

            $this->addFlash(
                'info',
                'РЦ изменен!'
            );

            return $this->redirectToRoute("show_distribution_centers");
        }

        return $this->render("AdminBundle:DistributionCenter:form.html.twig", array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/delete", name="delete_distribution_center", requirements={
     *      "id": "\d+"
     * })
     */
    public function deleteAction(Request $request, $id)
    {
        $distributionCenter = $this->getDoctrine()->getRepository('AdminBundle:Department')->find($id);
        if (!$distributionCenter) {
            throw $this->createNotFoundException('РЦ не найден');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($distributionCenter);
        $em->flush();

        $this->addFlash(
            'success',
            'РЦ успешно удален!'
        );

        return $this->redirectToRoute("show_distribution_centers");
    }
}