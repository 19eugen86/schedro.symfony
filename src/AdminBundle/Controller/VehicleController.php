<?php
/**
 * Created by PhpStorm.
 * User: EDLENKO
 * Date: 16.01.2016
 * Time: 14:01
 */

namespace AdminBundle\Controller;


use AdminBundle\Entity\Vehicle;
use AdminBundle\Form\Type\VehicleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin/transport/vehicles")
 */
class VehicleController extends Controller
{
    /**
     * @Route("/", name="show_all_vehicles")
     */
    public function indexAction()
    {
        $vehicles = $this->getDoctrine()->getRepository('AdminBundle:Vehicle')->findAll();
        return $this->render('AdminBundle:Vehicle:index.html.twig', array(
            'vehicles' => $vehicles,
            'section' => 'Транспорт'
        ));
    }

    /**
     * @Route("/page/{page}", name="show_vehicles_by_page", defaults={"page": 1}, requirements={
     *      "page": "\d+"
     * })
     */
    public function showByPageAction($page)
    {
        $vehicles = $this->getDoctrine()->getRepository('AdminBundle:Vehicle')->findAll();
        return $this->render('AdminBundle:Vehicle:index.html.twig', array(
            'vehicles' => $vehicles,
            'section' => 'Транспорт'
        ));
    }

    /**
     * @Route("/new", name="add_new_vehicle")
     */
    public function newAction(Request $request)
    {
        $vehicle = new Vehicle();

        $form = $this->createForm(VehicleType::class, $vehicle, array(
            'action' => $this->generateUrl("add_new_vehicle"),
            'method' => "POST"
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($vehicle);
            $em->flush();

            $this->addFlash(
                'success',
                'Автомобиль успешно добавлен!'
            );

            return $this->redirectToRoute("show_all_vehicles");
        }

        return $this->render('AdminBundle:Vehicle:form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/edit", name="edit_vehicle", requirements={
     *      "id": "\d+"
     * })
     */
    public function editAction(Request $request, $id)
    {
        $vehicle = $this->getDoctrine()->getRepository('AdminBundle:Vehicle')->find($id);
        if (!$vehicle) {
            throw $this->createNotFoundException('Автомобиль не найден');
        }

        $form = $this->createForm(VehicleType::class, $vehicle, array(
            'action' => $this->generateUrl("edit_vehicle", array(
                'id' => $vehicle->getId()
            )),
            'method' => "POST"
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($vehicle);
            $em->flush();

            $this->addFlash(
                'info',
                'Автомобиль успешно изменен!'
            );

            return $this->redirectToRoute("show_all_vehicles");
        }

        return $this->render('AdminBundle:Vehicle:form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/delete", name="delete_vehicle", requirements={
     *      "id": "\d+"
     * })
     */
    public function deleteAction($id)
    {
        $vehicle = $this->getDoctrine()->getRepository('AdminBundle:Vehicle')->find($id);
        if (!$vehicle) {
            throw $this->createNotFoundException('Автомобиль не найден');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($vehicle);
        $em->flush();

        $this->addFlash(
            'info',
            'Автомобиль успешно удален!'
        );

        return $this->redirectToRoute("show_all_vehicles");
    }
}