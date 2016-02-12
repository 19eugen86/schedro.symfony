<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 11.02.2016
 * Time: 17:18
 */

namespace AppBundle\Admin;

class BranchWarehouseCellAdmin extends WarehouseCellAdmin
{
    protected $warehouseAdminCode = 'admin.branch_warehouse';

    protected $baseRouteName = 'sonata_branch_warehouse_cells';
    protected $baseRoutePattern = 'departments/branches/warehouses/{warehouseId}/cells';
}