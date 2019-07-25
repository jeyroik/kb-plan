<?php
namespace extas\components\plans\facts;

use extas\components\repositories\Repository;
use extas\interfaces\plans\facts\IPlanFactRepository;

/**
 * Class PlanFactRepository
 *
 * @package extas\components\plans\facts
 * @author jeyroik@gmail.com
 */
class PlanFactRepository extends Repository implements IPlanFactRepository
{
    protected $idAs = PlanFact::FIELD__ID;
    protected $itemClass = PlanFact::class;
    protected $scope = 'kb';
    protected $name = 'plans_facts';
    protected $pk = PlanFact::FIELD__ID;
}
