<?php
namespace extas\components\plans;

use extas\components\repositories\Repository;
use extas\interfaces\plans\IPlanRepository;

/**
 * Class PlanRepository
 *
 * @package extas\components\plans
 * @author jeyroik@gmail.com
 */
class PlanRepository extends Repository implements IPlanRepository
{
    protected $idAs = Plan::FIELD__ID;
    protected $itemClass = Plan::class;
    protected $scope = 'kb';
    protected $name = 'plans';
    protected $pk = Plan::FIELD__ID;
}
