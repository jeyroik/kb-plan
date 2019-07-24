<?php
namespace extas\components\plans\progress;

use extas\components\Item;
use extas\components\parameters\THasParameters;
use extas\components\plans\THasPlan;
use extas\components\players\THasOwner;
use extas\components\SystemContainer;
use extas\components\THasCreatedAt;
use extas\components\THasId;
use extas\interfaces\plans\IPlan;
use extas\interfaces\plans\progress\IPlanProgress;
use extas\interfaces\plans\IPlanRepository;
use extas\interfaces\repositories\IRepository;

/**
 * Class PlanProgress
 *
 * @package extas\components\plans
 * @author jeyroik@gmail.com
 */
class PlanProgress extends Item implements IPlanProgress
{
    use THasPlan;
    use THasId;
    use THasCreatedAt;
    use THasOwner;
    use THasParameters;

    protected $planRepo = IPlanRepository::class;

    /**
     * @return IPlan|null
     */
    public function getPlan(): ?IPlan
    {
        /**
         * @var $planRepo IRepository
         */
        $planRepo = SystemContainer::getItem($this->planRepo);

        return $planRepo->one([IPlan::FIELD__ID => $this->getPlanId()]);
    }
}
