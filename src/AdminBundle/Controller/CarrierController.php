<?php
/**
 * Created by PhpStorm.
 * User: EDLENKO
 * Date: 16.01.2016
 * Time: 14:01
 */

namespace AdminBundle\Controller;


use AdminBundle\Entity\Carrier;
use AdminBundle\Form\Type\CarrierType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin/transport/carriers")
 */
class CarrierController extends Controller
{
    /**
     * @Route("/", name="show_all_carriers")
     */
    public function indexAction()
    {
        $carriers = $this->getDoctrine()->getRepository('AdminBundle:Carrier')->findAll();
        return $this->render('AdminBundle:Carrier:index.html.twig', array(
            'carriers' => $carriers,
            'section' => 'Транспорт'
        ));
    }

    /**
     * TODO:
     * @Route("/pages/{page}", name="show_carriers_by_page", defaults={"page": 1}, requirements={
     *      "page": "\d+"
     * })
     */
    public function showByPageAction($page)
    {
        $carriers = $this->getDoctrine()->getRepository('AdminBundle:Carrier')->findAll();
        return $this->render('AdminBundle:Carrier:index.html.twig', array(
            'carriers' => $carriers,
            'section' => 'Транспорт'
        ));
    }

    /**
     * @Route("/new", name="add_new_carrier")
     */
    public function newAction(Request $request)
    {
        $carrier = new Carrier();

        $form = $this->createForm(CarrierType::class, $carrier, array(
            'action' => $this->generateUrl("add_new_carrier"),
            'method' => 'POST'
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($carrier);
            $em->flush();

            $this->addFlash(
                'success',
                'Перевозчик успешно добавлен!'
            );

            return $this->redirectToRoute("show_all_carriers");
        }

        return $this->render('AdminBundle:Carrier:form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/edit", name="edit_carrier", requirements={
     *      "id": "\d+"
     * })
     */
    public function editAction(Request $request, $id)
    {
        $carrier = $this->getDoctrine()->getRepository('AdminBundle:Carrier')->find($id);
        if (!$carrier) {
            throw $this->createNotFoundException('Перевозчик не найден');
        }

        $form = $this->createForm(CarrierType::class, $carrier, array(
            'action' => $this->generateUrl("edit_carrier", array(
                'id' => $carrier->getId()
            )),
            'method' => 'POST'
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($carrier);
            $em->flush();

            $this->addFlash(
                'info',
                'Перевозчик изменен!'
            );

            return $this->redirectToRoute("show_all_carriers");
        }

        return $this->render('AdminBundle:Carrier:form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/delete", name="delete_carrier", requirements={
     *      "id": "\d+"
     * })
     */
    public function deleteAction($id)
    {
        $carrier = $this->getDoctrine()->getRepository('AdminBundle:Carrier')->find($id);
        if (!$carrier) {
            throw $this->createNotFoundException('Перевозчик не найден');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($carrier);
        $em->flush();

        $this->addFlash(
            'success',
            'Перевозчик успешно удален!'
        );

        return $this->redirectToRoute("show_all_carriers");
    }
}