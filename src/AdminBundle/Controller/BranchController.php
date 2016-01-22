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
 * @Route("/admin/departments/branches")
 */
class BranchController extends Controller
{
    /**
     * @Route("/", name="show_all_branches")
     */
    public function indexAction()
    {
        $branches = $this->getDoctrine()->getRepository('AdminBundle:Department')->findByType(Department::BRANCH);
        return $this->render('AdminBundle:Branch:index.html.twig', array(
            'branches' => $branches,
            'section' => 'Филиалы'
        ));
    }

    /**
     * TODO:
     * @Route("/pages/{page}", name="show_branches_by_page", defaults={"page": 1}, requirements={
     *      "page": "\d+"
     * })
     */
    public function showByPageAction()
    {
        $branches = $this->getDoctrine()->getRepository('AdminBundle:Department')->findByType(Department::BRANCH);
        return $this->render('AdminBundle:Branch:index.html.twig', array(
            'branches' => $branches,
            'section' => 'Филиалы'
        ));
    }

    /**
     * @Route("/new", name="add_new_branch")
     */
    public function newAction(Request $request)
    {
        $branch = new Department(Department::BRANCH);

        $form = $this->createForm(DepartmentType::class, $branch, array(
            'action' => $this->generateUrl("add_new_branch"),
            'method' => "POST"
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($branch);
            $em->flush();

            $this->addFlash(
                'success',
                'Филиал успешно добавлен!'
            );

            return $this->redirectToRoute("show_all_branches");
        }

        return $this->render("AdminBundle:Branch:form.html.twig", array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/edit", name="edit_branch", requirements={
     *      "id": "\d+"
     * })
     */
    public function editAction(Request $request, $id)
    {
        $branch = $this->getDoctrine()->getRepository('AdminBundle:Department')->find($id);
        if (!$branch) {
            throw $this->createNotFoundException('Филиал не найден');
        }

        $form = $this->createForm(DepartmentType::class, $branch, array(
            'action' => $this->generateUrl("edit_branch", array(
                'id' => $branch->getId()
            )),
            'method' => "POST"
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($branch);
            $em->flush();

            $this->addFlash(
                'info',
                'Филиал изменен!'
            );

            return $this->redirectToRoute("show_all_branches");
        }

        return $this->render("AdminBundle:Branch:form.html.twig", array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/delete", name="delete_branch", requirements={
     *      "id": "\d+"
     * })
     */
    public function deleteAction(Request $request, $id)
    {
        $branch = $this->getDoctrine()->getRepository('AdminBundle:Department')->find($id);
        if (!$branch) {
            throw $this->createNotFoundException('Филиал не найден');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($branch);
        $em->flush();

        $this->addFlash(
            'success',
            'Филиал успешно удален!'
        );

        return $this->redirectToRoute("show_all_branches");
    }
}