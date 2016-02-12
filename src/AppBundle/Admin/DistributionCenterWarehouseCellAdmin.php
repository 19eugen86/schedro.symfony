<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 11.02.2016
 * Time: 17:18
 */

namespace AppBundle\Admin;

class DistributionCenterWarehouseCellAdmin extends WarehouseCellAdmin
{
    protected $warehouseAdminCode = 'admin.distribution_center_warehouse';

    protected $baseRouteName = 'sonata_distribution_center_warehouse_cells';
    protected $baseRoutePattern = 'departments/distribution_centers/warehouses/{warehouseId}/cells';
}