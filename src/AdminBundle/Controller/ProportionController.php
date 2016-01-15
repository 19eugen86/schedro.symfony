<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 15.01.2016
 * Time: 12:25
 */

namespace AdminBundle\Controller;


use AdminBundle\Entity\Proportion;
use AdminBundle\Form\Type\ProportionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin/settings/proportions")
 */
class ProportionController extends Controller
{
    /**
     * @Route("/", name="show_all_proportions")
     */
    public function indexAction()
    {
        $proportions = $this->getDoctrine()->getRepository('AdminBundle:Proportion')->findAll();
        return $this->render('AdminBundle:Proportion:index.html.twig', array(
            'proportions' => $proportions,
            'section' => 'Настройки'
        ));
    }

    /**
     * @Route("/page/{page}", name="show_proportions_by_page", defaults={"page": 1}, requirements={
     *      "page": "\d+"
     * })
     */
    public function showByPageAction($page)
    {
        $proportions = $this->getDoctrine()->getRepository('AdminBundle:Proportion')->findAll();
        return $this->render('AdminBundle:Proportion:index.html.twig', array(
            'proportions' => $proportions,
            'section' => 'Настройки'
        ));
    }

    /**
     * @Route("/new", name="add_new_proportion")
     */
    public function newAction(Request $request)
    {
        $proportion = new Proportion();

        $form = $this->createForm(ProportionType::class, $proportion, array(
            'action' => $this->generateUrl("add_new_proportion"),
            'method' => 'POST'
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($proportion);
            $em->flush();

            $this->addFlash(
                'success',
                'Пропорция успешно добавлена!'
            );

            return $this->redirectToRoute("show_all_proportions");
        }

        return $this->render('AdminBundle:Proportion:form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/edit", name="edit_proportion", requirements={
     *      "id": "\d+"
     * })
     */
    public function editAction(Request $request, $id)
    {
        $proportion = $this->getDoctrine()->getRepository('AdminBundle:Proportion')->find($id);
        if (!$proportion) {
            throw $this->createNotFoundException('Пропорция не найдена');
        }

        $form = $this->createForm(ProportionType::class, $proportion, array(
            'action' => $this->generateUrl("edit_proportion", array(
                'id' => $proportion->getId()
            )),
            'method' => 'POST'
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($proportion);
            $em->flush();

            $this->addFlash(
                'info',
                'Пропорция изменена!'
            );

            return $this->redirectToRoute("show_all_proportions");
        }

        return $this->render('AdminBundle:Proportion:form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/delete", name="delete_proportion", requirements={
     *      "id": "\d+"
     * })
     */
    public function deleteAction($id)
    {
        $proportion = $this->getDoctrine()->getRepository('AdminBundle:Proportion')->find($id);
        if (!$proportion) {
            throw $this->createNotFoundException('Пропорция не найдена');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($proportion);
        $em->flush();

        $this->addFlash(
            'success',
            'Пропорция успешно удалена!'
        );

        return $this->redirectToRoute("show_all_proportions");
    }
}