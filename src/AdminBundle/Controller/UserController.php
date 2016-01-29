<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 20.01.2016
 * Time: 10:56
 */

namespace AdminBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Form\Type\UserType;

/**
 * @Route("/admin/users")
 */
class UserController extends Controller
{
    /**
     * @Route(
     *      "/{pageParam}/{page}",
     *      name="show_users",
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
        $users = $this->get('fos_user.user_manager')->findUsers();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($users, $page, 5);

        return $this->render('AdminBundle:User:index.html.twig', array(
            'pagination' => $pagination,
            'section' => $this->get('translator')->trans('users')
        ));
    }

    /**
     * @Route("/new", name="add_new_user")
     */
    public function newAction(Request $request)
    {
        $user = new User();
        $user->setEnabled(true);

        $form = $this->createForm(UserType::class, $user, array(
            'action' => $this->generateUrl("add_new_user"),
            'method' => "POST"
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'success',
                'Сотрудник успешно добавлен!'
            );

            return $this->redirectToRoute("show_users");
        }

        return $this->render("AdminBundle:User:form.html.twig", array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/edit", name="edit_user", requirements={
     *      "id": "\d+"
     * })
     */
    public function editAction(Request $request, $id)
    {
        $user = $this->getDoctrine()->getRepository('UserBundle:User')->find($id);
        if (!$user) {
            throw $this->createNotFoundException('Сотрудник не найден');
        }

        $form = $this->createForm(UserType::class, $user, array(
            'action' => $this->generateUrl("edit_user", array(
                'id' => $user->getId()
            )),
            'method' => "POST"
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'info',
                'Сотрудник изменен!'
            );

            return $this->redirectToRoute("show_users");
        }

        return $this->render("AdminBundle:User:form.html.twig", array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/delete", name="delete_user", requirements={
     *      "id": "\d+"
     * })
     */
    public function deleteAction($id)
    {
        $user = $this->getDoctrine()->getRepository('UserBundle:User')->find($id);
        if (!$user) {
            throw $this->createNotFoundException('Сотрудник не найден');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        $this->addFlash(
            'success',
            'Сотрудник успешно удален!'
        );

        return $this->redirectToRoute("show_users");
    }
}