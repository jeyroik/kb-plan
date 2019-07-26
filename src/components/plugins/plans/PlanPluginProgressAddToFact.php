<?php
namespace extas\components\plugins\plans;

use Carbon\Carbon;
use extas\components\plans\facts\PlanFact;
use extas\components\plugins\Plugin;
use extas\components\SystemContainer;
use extas\interfaces\plans\facts\IPlanFact;
use extas\interfaces\plans\facts\IPlanFactRepository;
use extas\interfaces\plans\IPlan;
use extas\interfaces\plans\progress\IPlanProgress;

/**
 * Class PlanPluginProgressAddToFact
 *
 * @stage kb.plan.progress.added
 *
 * @package df\components\plugins\plans
 * @author jeyroik@gmail.com
 */
class PlanPluginProgressAddToFact extends Plugin
{
    protected $factRepo = IPlanFactRepository::class;

    /**
     * @override_it
     *
     * @return string
     */
    protected function getPlanFactSubject()
    {
        return 'kb.plan.fact';
    }

    /**
     * @override_it
     *
     * @param $factData
     *
     * @return IPlanFact
     */
    protected function getPlanFact($factData)
    {
        return new PlanFact($factData);
    }

    /**
     * @param IPlan $plan
     * @param IPlanProgress $progress
     * @param bool $recursion
     */
    public function __invoke($plan, $progress, $recursion = false)
    {
        /**
         * @var $factRepo IPlanFactRepository
         * @var $fact IPlanFact
         */
        $factRepo = SystemContainer::getItem($this->factRepo);
        $fact = $factRepo->one([IPlanFact::FIELD__PLAN_ID => $plan->getId()]);

        if ($fact) {
            $this->setStepsData($fact);

            $stage = $this->getPlanFactSubject() . '.progress.add';
            foreach ($this->getPluginsByStage($stage) as $plugin) {
                $plugin($fact, $progress);
            }

            $factRepo->update($fact);
        } elseif (!$recursion) {
            $fact = $this->newPlanFact($plan);
            $factRepo->create($fact);
            $this($plan, $progress, true);
        }
    }

    /**
     * @param IPlan $plan
     * @return IPlanFact
     */
    protected function newPlanFact($plan)
    {
        return $this->getPlanFact([
            IPlanFact::FIELD__PLAN_ID => $plan->getId(),
            IPlanFact::FIELD__OWNER => $plan->getOwnerName(),
            IPlanFact::FIELD__CREATED_AT => time(),
            IPlanFact::FIELD__DEADLINE => $plan->getDeadline()
        ]);
    }

    /**
     * @param IPlanFact $fact
     */
    protected function setStepsData(&$fact)
    {
        $lastUpdated = $fact->getUpdatedAt();
        $passed = time() - $lastUpdated;

        $seconds = $passed > 86400 ? 86400 : $passed;
        $minutes = $seconds/60;
        $hours = $minutes/60;
        $days = $hours/24;
        $weeks = $days/7;
        $months = $days/(Carbon::now()->daysInMonth);
        $years = $days/365;

        $fact->setSeconds($fact->getSeconds()+$seconds)
            ->setMinutes($fact->getMinutes()+$minutes)
            ->setHours($fact->getHours()+$hours)
            ->setDays($fact->getDays()+$days)
            ->setWeeks($fact->getWeeks()+$weeks)
            ->setMonths($fact->getMonths()+$months)
            ->setYears($fact->getYears()+$years);
    }
}
