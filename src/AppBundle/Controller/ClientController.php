<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 06.01.2016
 * Time: 9:53
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Client;
use AppBundle\Form\Type\ClientType;
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
        $clients = $this->getDoctrine()->getRepository('AppBundle:Client')->findAll();
        return $this->render('client/index.html.twig', array(
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

        return $this->render('client/new.html.twig', array(
            'form' => $form->createView()
        ));
    }
}