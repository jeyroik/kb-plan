<?php
namespace extas\interfaces\plans;

/**
 * Interface IHasPlan
 *
 * @package extas\interfaces\plans
 * @author jeyroik@gmail.com
 */
interface IHasPlan
{
    const FIELD__PLAN_ID = 'plan_id';

    /**
     * @return string
     */
    public function getPlanId(): string;

    /**
     * @return IPlan|null
     */
    public function getPlan(): ?IPlan;

    /**
     * @param string $id
     *
     * @return $this
     */
    public function setPlanId(string $id);
}
