<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 14.01.2016
 * Time: 12:00
 */

namespace AdminBundle\Controller;


use AdminBundle\Entity\Unit;
use AdminBundle\Form\Type\UnitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin/settings/units")
 */
class UnitController extends Controller
{
    /**
     * @Route("/", name="show_all_units")
     */
    public function indexAction()
    {
        $units = $this->getDoctrine()->getRepository('AdminBundle:Unit')->findAll();
        return $this->render('AdminBundle:Unit:index.html.twig', array(
            'units' => $units,
            'section' => 'Настройки'
        ));
    }

    /**
     * TODO:
     * @Route("/page/{page}", name="show_units_by_page", defaults={"page": 1}, requirements={
     *      "page": "\d+"
     * })
     */
    public function showByPageAction($page)
    {
        $units = $this->getDoctrine()->getRepository('AdminBundle:Unit')->findAll();
        return $this->render('AdminBundle:Unit:index.html.twig', array(
            'units' => $units,
            'section' => 'Настройки'
        ));
    }

    /**
     * @Route("/new", name="add_new_unit")
     */
    public function newAction(Request $request)
    {
        $unit = new Unit();

        $form = $this->createForm(UnitType::class, $unit, array(
            'action' => $this->generateUrl("add_new_unit"),
            'method' => 'POST'
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($unit);
            $em->flush();

            $this->addFlash(
                'success',
                'Единица измерения успешно добавлена!'
            );

            return $this->redirectToRoute("show_all_units");
        }

        return $this->render('AdminBundle:Unit:form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/edit", name="edit_unit", requirements={
     *      "id": "\d+"
     * })
     */
    public function editAction(Request $request, $id)
    {
        $unit = $this->getDoctrine()->getRepository('AdminBundle:Unit')->find($id);
        if (!$unit) {
            throw $this->createNotFoundException('Единица измерения не найдена');
        }

        $form = $this->createForm(UnitType::class, $unit, array(
            'action' => $this->generateUrl("edit_unit", array(
                'id' => $unit->getId()
            )),
            'method' => 'POST'
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($unit);
            $em->flush();

            $this->addFlash(
                'info',
                'Единица измерения изменена!'
            );

            return $this->redirectToRoute("show_all_units");
        }

        return $this->render('AdminBundle:Unit:form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/delete", name="delete_unit", requirements={
     *      "id": "\d+"
     * })
     */
    public function deleteAction($id)
    {
        $unit = $this->getDoctrine()->getRepository('AdminBundle:Unit')->find($id);
        if (!$unit) {
            throw $this->createNotFoundException('Единица измерения не найдена');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($unit);
        $em->flush();

        $this->addFlash(
            'success',
            'Единица измерения успешно удалена!'
        );

        return $this->redirectToRoute("show_all_units");
    }
}