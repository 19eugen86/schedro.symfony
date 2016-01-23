<?php
/**
 * Created by PhpStorm.
 * User: EDLENKO
 * Date: 23.01.2016
 * Time: 11:44
 */

namespace AdminBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/admin/warehouses")
 */
class WarehouseCellController extends Controller
{
    /**
     * @Route("/{warehouseId}/cells", name="show_all_cells_of_warehouse", requirements={
     *      "warehouseId": "\d+"
     * })
     */
    public function indexAction($warehouseId)
    {
        $warehouse = $this->getDoctrine()->getRepository('AdminBundle:Warehouse')->find($warehouseId);
        $cells = $this->getDoctrine()->getRepository('AdminBundle:WarehouseCell')->findByWarehouse($warehouse);

        return $this->render('AdminBundle:WarehouseCell:index.html.twig', array(
            'cells' => $cells
        ));
    }
}