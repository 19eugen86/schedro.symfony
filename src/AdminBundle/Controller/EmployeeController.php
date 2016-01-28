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
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin/employees")
 */
class EmployeeController extends Controller
{
    /**
     * @Route(
     *      "/{pageParam}/{page}",
     *      name="show_employees",
     *      defaults={
     *          "pageParam": "page",
     *          "page": 1
     *      },
     *      requirements={
     *          "pageParam": "page",
     *          "page", "\d+"
     *      }
     * )
     */
    public function indexAction($page)
    {
        $employees = $this->get('fos_user.user_manager')->findUsers();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($employees, $page, 5);

        return $this->render('AdminBundle:Employee:index.html.twig', array(
            'pagination' => $pagination,
            'section' => $this->get('translator')->trans('Employees')
        ));
    }

    /**
     * @Route("/new", name="add_new_employee")
     */
    public function newAction(Request $request)
    {
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');

        $user = $userManager->createUser();
        $user->setEnabled(true);

        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.profile.form.factory');

        $form = $formFactory->createForm(array(
            'action' => $this->generateUrl("add_new_employee"),
            'method' => "POST"
        ));
        $form->setData($user);

        dump($form);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $response = $this->redirectToRoute("show_employees");
            }

            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }

//        $employee = new Employee();
//
//        $form = $this->createForm(EmployeeType::class, $employee, array(
//            'action' => $this->generateUrl("add_new_employee"),
//            'method' => "POST"
//        ));
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($employee);
//            $em->flush();
//
//            $this->addFlash(
//                'success',
//                'Сотрудник успешно добавлен!'
//            );
//
//            return $this->redirectToRoute("show_employees");
//        }

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

            return $this->redirectToRoute("show_employees");
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

        return $this->redirectToRoute("show_employees");
    }
}