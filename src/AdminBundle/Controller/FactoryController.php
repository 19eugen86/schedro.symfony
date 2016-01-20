<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 20.01.2016
 * Time: 16:10
 */

namespace AdminBundle\Controller;


use AdminBundle\Entity\Factory;
use AdminBundle\Form\Type\FactoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin/factories")
 */
class FactoryController extends Controller
{
    /**
     * @Route("/", name="show_all_factories")
     */
    public function indexAction()
    {
        $factories = $this->getDoctrine()->getRepository('AdminBundle:Factory')->findAll();
        return $this->render('AdminBundle:Factory:index.html.twig', array(
            'factories' => $factories,
            'section' => 'Комбинаты'
        ));
    }

    /**
     * TODO:
     * @Route("/pages/{page}", name="show_factories_by_page", defaults={"page": 1}, requirements={
     *      "page": "\d+"
     * })
     */
    public function showByPageAction()
    {
        $factories = $this->getDoctrine()->getRepository('AdminBundle:Factory')->findAll();
        return $this->render('AdminBundle:Factory:index.html.twig', array(
            'factories' => $factories,
            'section' => 'Комбинаты'
        ));
    }

    /**
     * @Route("/new", name="add_new_factory")
     */
    public function newAction(Request $request)
    {
        $factory = new Factory();

        $form = $this->createForm(FactoryType::class, $factory, array(
            'action' => $this->generateUrl("add_new_factory"),
            'method' => "POST"
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($factory);
            $em->flush();

            $this->addFlash(
                'success',
                'Комбинат успешно добавлен!'
            );

            return $this->redirectToRoute("show_all_factories");
        }

        return $this->render("AdminBundle:Factory:form.html.twig", array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/edit", name="edit_factory", requirements={
     *      "id": "\d+"
     * })
     */
    public function editAction(Request $request, $id)
    {
        $factory = $this->getDoctrine()->getRepository('AdminBundle:Factory')->find($id);
        if (!$factory) {
            throw $this->createNotFoundException('Комбинат не найден');
        }

        $form = $this->createForm(FactoryType::class, $factory, array(
            'action' => $this->generateUrl("edit_factory", array(
                'id' => $factory->getId()
            )),
            'method' => "POST"
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($factory);
            $em->flush();

            $this->addFlash(
                'info',
                'Комбинат изменен!'
            );

            return $this->redirectToRoute("show_all_factories");
        }

        return $this->render("AdminBundle:Factory:form.html.twig", array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/delete", name="delete_factory", requirements={
     *      "id": "\d+"
     * })
     */
    public function deleteAction(Request $request, $id)
    {
        $factory = $this->getDoctrine()->getRepository('AdminBundle:Factory')->find($id);
        if (!$factory) {
            throw $this->createNotFoundException('Комбинат не найден');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($factory);
        $em->flush();

        $this->addFlash(
            'success',
            'Комбинат успешно удален!'
        );

        return $this->redirectToRoute("show_all_factories");
    }
}