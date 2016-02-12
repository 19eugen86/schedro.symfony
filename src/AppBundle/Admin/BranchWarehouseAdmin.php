<?php
/**
 * Created by PhpStorm.
 * User: evgeniy.edlenko
 * Date: 05.02.2016
 * Time: 12:18
 */

namespace AppBundle\Admin;


use AppBundle\Entity\Department;

class BranchWarehouseAdmin extends WarehouseAdmin
{
    protected $baseRouteName = 'sonata_branches_warehouses';
    protected $baseRoutePattern = 'departments/branches/warehouses';

    protected $label = 'Branch';
    protected $departmentType = Department::BRANCH;
    protected $departmentAdminCode = 'admin.branch';
    protected $warehouseCellsAdminCode = 'admin.branch_warehouse_cell';
}