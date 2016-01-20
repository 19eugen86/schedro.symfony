<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 30.12.2015
 * Time: 12:44
 */

namespace AdminBundle\Controller;


use AdminBundle\Entity\City;
use AdminBundle\Form\Type\CityType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * TODO: Update forms to use AJAX
 * @Route("/admin/cities")
 */
class CityController extends Controller
{
    /**
     * @Route("/", name="show_all_cities")
     */
    public function indexAction()
    {
        $cities = $this->getDoctrine()->getRepository('AdminBundle:City')->findAll();
        return $this->render('AdminBundle:City:index.html.twig', array(
            'cities' => $cities,
            'section' => 'География'
        ));
    }

    /**
     * TODO:
     * @Route("/page/{page}", name="show_cities_by_page", defaults={"page": 1}, requirements={
     *      "page": "\d+"
     * })
     */
    public function showByPageAction($page)
    {
        $cities = $this->getDoctrine()->getRepository('AdminBundle:City')->findAll();
        return $this->render('AdminBundle:City:index.html.twig', array(
            'cities' => $cities,
            'section' => 'География'
        ));
    }

    /**
     * @Route("/new", name="add_new_city")
     */
    public function newAction(Request $request)
    {
        $city = new City();

        $form = $this->createForm(CityType::class, $city);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($city);
            $em->flush();

            $this->addFlash(
                'success',
                'Город успешно добавлен!'
            );

            return $this->redirectToRoute("show_all_cities");
        }

        return $this->render('AdminBundle:City:new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/edit", name="edit_city", requirements={
     *      "id": "\d+"
     * })
     */
    public function editAction(Request $request, $id)
    {
        $city = $this->getDoctrine()->getRepository("AdminBundle:City")->find($id);
        if (!$city) {
            throw $this->createNotFoundException('Город не найден');
        }

        $form = $this->createForm(CityType::class, $city);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($city);
            $em->flush();

            $this->addFlash(
                'info',
                'Город изменен!'
            );

            return $this->redirectToRoute("show_all_cities");
        }

        return $this->render('AdminBundle:City:edit.html.twig', array(
            'form' => $form->createView(),
            'id' => $city->getId()
        ));
    }

    /**
     * @Route("/{id}/delete", name="delete_city", requirements={
     *      "id": "\d+"
     * })
     */
    public function deleteAction($id)
    {
        $city = $this->getDoctrine()->getRepository("AdminBundle:City")->find($id);
        if (!$city) {
            throw $this->createNotFoundException('Город не найден');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($city);
        $em->flush();

        $this->addFlash(
            'success',
            'Город успешно удален!'
        );

        return $this->redirectToRoute("show_all_cities");
    }
}