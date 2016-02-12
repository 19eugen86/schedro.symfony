<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 05.02.2016
 * Time: 12:25
 */

namespace AppBundle\Admin;


use AppBundle\Entity\Department;


class DistributionCenterWarehouseAdmin extends WarehouseAdmin
{
    protected $baseRouteName = 'sonata_distributions_centers_warehouses';
    protected $baseRoutePattern = 'departments/distribution_centers/warehouses';

    protected $label = 'Distribution Center';
    protected $departmentType = Department::DISTRIBUTION_CENTER;
    protected $departmentAdminCode = 'admin.distribution_center';
    protected $warehouseCellsAdminCode = 'admin.distribution_center_warehouse_cell';
}