<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 06.01.2016
 * Time: 9:53
 */

namespace AdminBundle\Controller;


use AdminBundle\Entity\Client;
use AdminBundle\Form\Type\ClientType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/admin/clients")
 */
class ClientController extends Controller
{
    /**
     * @Route("/", name="show_all_clients")
     */
    public function indexAction()
    {
        $clients = $this->getDoctrine()->getRepository('AdminBundle:Client')->findAll();
        return $this->render('AdminBundle:Client:index.html.twig', array(
            'clients' => $clients
        ));
    }

    /**
     * TODO:
     * @Route("/page/{page}", name="show_clients_by_page", defaults={"page": 1}, requirements={
     *      "page": "\d+"
     * })
     */
    public function showByPageAction()
    {
        $clients = $this->getDoctrine()->getRepository('AdminBundle:Client')->findAll();
        return $this->render('AdminBundle:Client:index.html.twig', array(
            'clients' => $clients
        ));
    }

    /**
     * @Route("/new", name="add_new_client")
     */
    public function newAction(Request $request)
    {
        $client = new Client();

        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();

            return $this->redirectToRoute("show_all_clients");
        }

        return $this->render('AdminBundle:Client:new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/edit", name="edit_client", requirements={
     *      "id": "\d+"
     * })
     */
    public function editAction(Request $request, $id)
    {
        $client = $this->getDoctrine()->getRepository('AdminBundle:Client')->find($id);
        if (!$client) {
            throw $this->createNotFoundException('Клиент не найден');
        }

        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();

            $this->addFlash(
                'info',
                'Клиент изменен!'
            );

            return $this->redirectToRoute("show_all_clients");
        }

        return $this->render('AdminBundle:Client:edit.html.twig', array(
            'form' => $form->createView(),
            'id' => $client->getId()
        ));
    }

    /**
     * @Route("/{id}/delete", name="delete_client", requirements={
     *      "id": "\d+"
     * })
     */
    public function deleteAction($id)
    {
        $client = $this->getDoctrine()->getRepository('AdminBundle:Client')->find($id);
        if (!$client) {
            throw $this->createNotFoundException('Клиент не найден');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($client);
        $em->flush();

        $this->addFlash(
            'success',
            'Клинт удален!'
        );

        return $this->redirectToRoute("show_all_clients");
    }
}