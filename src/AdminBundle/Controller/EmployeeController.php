<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 20.01.2016
 * Time: 10:56
 */

namespace AdminBundle\Controller;


use AdminBundle\Entity\Employee;
use AdminBundle\Form\Type\EmployeeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin/employees")
 */
class EmployeeController extends Controller
{
    /**
     * @Route("/", name="show_all_employees")
     */
    public function indexAction()
    {
        $employees = $this->getDoctrine()->getRepository('AdminBundle:Employee')->findAll();
        return $this->render('AdminBundle:Employee:index.html.twig', array(
            'employees' => $employees,
            'section' => 'Сотрудники'
        ));
    }

    /**
     * @Route("/pages/{page}", name="show_employees_by_page")
     */
    public function showByPageAction()
    {
        $employees = $this->getDoctrine()->getRepository('AdminBundle:Employee')->findAll();
        return $this->render('AdminBundle:Employee:index.html.twig', array(
            'employees' => $employees,
            'section' => 'Сотрудники'
        ));
    }

    /**
     * @Route("/new", name="add_new_employee")
     */
    public function newAction(Request $request)
    {
        $employee = new Employee();

        $form = $this->createForm(EmployeeType::class, $employee, array(
            'action' => $this->generateUrl("add_new_employee"),
            'method' => "POST"
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($employee);
            $em->flush();

            $this->addFlash(
                'success',
                'Сотрудник успешно добавлен!'
            );

            return $this->redirectToRoute("show_all_employees");
        }

        return $this->render("AdminBundle:Employee:form.html.twig", array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/edit", name="edit_employee", requirements={
     *      "id": "\d+"
     * })
     */
    public function editAction(Request $request, $id)
    {
        $employee = $this->getDoctrine()->getRepository('AdminBundle:Employee')->find($id);
        if (!$employee) {
            throw $this->createNotFoundException('Сотрудник не найден');
        }

        $form = $this->createForm(EmployeeType::class, $employee, array(
            'action' => $this->generateUrl("edit_employee", array(
                'id' => $employee->getId()
            )),
            'method' => "POST"
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($employee);
            $em->flush();

            $this->addFlash(
                'info',
                'Сотрудник изменен!'
            );

            return $this->redirectToRoute("show_all_employees");
        }

        return $this->render("AdminBundle:Employee:form.html.twig", array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/delete", name="delete_employee", requirements={
     *      "id": "\d+"
     * })
     */
    public function deleteAction($id)
    {
        $employee = $this->getDoctrine()->getRepository('AdminBundle:Employee')->find($id);
        if (!$employee) {
            throw $this->createNotFoundException('Сотрудник не найден');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($employee);
        $em->flush();

        $this->addFlash(
            'success',
            'Сотрудник успешно удален!'
        );

        return $this->redirectToRoute("show_all_employees");
    }
}