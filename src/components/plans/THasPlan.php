<?php
namespace extas\components\plans;
use extas\interfaces\plans\IHasPlan;
use extas\interfaces\plans\IPlan;

/**
 * Trait THasPlan
 *
 * @property $config
 *
 * @package extas\components\plans
 * @author jeyroik@gmail.com
 */
trait THasPlan
{
    /**
     * @return string
     */
    public function getPlanId(): string
    {
        return $this->config[IHasPlan::FIELD__PLAN_ID] ?? '';
    }

    /**
     * @param string $id
     *
     * @return $this
     */
    public function setPlanId(string $id)
    {
        $this->config[IHasPlan::FIELD__PLAN_ID] = $id;

        return $this;
    }
}
