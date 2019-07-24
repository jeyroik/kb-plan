<?php
namespace extas\components\plans\progress;

use extas\components\repositories\Repository;
use extas\interfaces\plans\progress\IPlanProgressRepository;

/**
 * Class PlanProgressRepository
 *
 * @package extas\components\plans\progress
 * @author jeyroik@gmail.com
 */
class PlanProgressRepository extends Repository implements IPlanProgressRepository
{
    protected $pk = PlanProgress::FIELD__ID;
    protected $name = 'plans_progress';
    protected $scope = 'kb';
    protected $itemClass = PlanProgress::class;
    protected $idAs = PlanProgress::FIELD__ID;
}
