<?php
/**
 * Created by PhpStorm.
 * User: EDLENKO
 * Date: 16.01.2016
 * Time: 14:01
 */

namespace AdminBundle\Controller;


use AdminBundle\Entity\Driver;
use AdminBundle\Form\Type\DriverType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin/transport/drivers")
 */
class DriverController extends Controller
{
    /**
     * @Route("/", name="show_all_drivers")
     */
    public function indexAction()
    {
        $drivers = $this->getDoctrine()->getRepository('AdminBundle:Driver')->findAll();
        return $this->render('AdminBundle:Driver:index.html.twig', array(
            'drivers' => $drivers,
            'section' => 'Транспорт'
        ));
    }

    /**
     * @Route("/page/{page}", name="show_drivers_by_page", defaults={"page": 1}, requirements={
     *      "page": "\d+"
     * })
     */
    public function showByPageAction($page)
    {
        $drivers = $this->getDoctrine()->getRepository('AdminBundle:Driver')->findAll();
        return $this->render('AdminBundle:Driver:index.html.twig', array(
            'drivers' => $drivers,
            'section' => 'Транспорт'
        ));
    }

    /**
     * @Route("/new", name="add_new_driver")
     */
    public function newAction(Request $request)
    {
        $driver = new Driver();

        $form = $this->createForm(DriverType::class, $driver, array(
            'action' => $this->generateUrl("add_new_driver"),
            'method' => "POST"
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($driver);
            $em->flush();

            $this->addFlash(
                'success',
                'Водитель успешно добавлен!'
            );

            return $this->redirectToRoute("show_all_drivers");
        }

        return $this->render('AdminBundle:Driver:form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/edit", name="edit_driver", requirements={
     *      "id": "\d+"
     * })
     */
    public function editAction(Request $request, $id)
    {
        $driver = $this->getDoctrine()->getRepository('AdminBundle:Driver')->find($id);
        if (!$driver) {
            throw $this->createNotFoundException('Водитель не найден');
        }

        $form = $this->createForm(DriverType::class, $driver, array(
            'action' => $this->generateUrl("edit_driver", array(
                'id' => $driver->getId()
            )),
            'method' => "POST"
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($driver);
            $em->flush();

            $this->addFlash(
                'info',
                'Водитель успешно изменен!'
            );

            return $this->redirectToRoute("show_all_drivers");
        }

        return $this->render('AdminBundle:Driver:form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/delete", name="delete_driver", requirements={
     *      "id": "\d+"
     * })
     */
    public function deleteAction($id)
    {
        $driver = $this->getDoctrine()->getRepository('AdminBundle:Driver')->find($id);
        if (!$driver) {
            throw $this->createNotFoundException('Водитель не найден');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($driver);
        $em->flush();

        $this->addFlash(
            'info',
            'Водитель успешно удален!'
        );

        return $this->redirectToRoute("show_all_drivers");
    }
}