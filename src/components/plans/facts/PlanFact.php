<?php
namespace extas\components\plans\facts;

use Carbon\Carbon;
use extas\components\plans\Plan;
use extas\components\plans\THasPlan;
use extas\components\SystemContainer;
use extas\interfaces\plans\facts\IPlanFact;
use extas\interfaces\plans\facts\IPlanFactRepository;
use extas\interfaces\plans\IPlan;
use extas\interfaces\plans\IPlanRepository;
use extas\interfaces\repositories\IRepository;

/**
 * Class PlanFact
 *
 * @package extas\components\plans\facts
 * @author jeyroik@gmail.com
 */
class PlanFact extends Plan implements IPlanFact
{
    use THasPlan;

    protected $planRepo = IPlanRepository::class;
    protected $factRepo = IPlanFactRepository::class;

    /**
     * @return IPlan|null
     */
    public function getPlan(): ?IPlan
    {
        /**
         * @var $planRepo IPlanRepository
         */
        $planRepo = SystemContainer::getItem($this->planRepo);

        return $planRepo->one([IPlan::FIELD__ID => $this->getPlanId()]);
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'kb.plan.fact';
    }
}
