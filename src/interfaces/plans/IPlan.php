<?php
namespace extas\interfaces\plans;

use extas\interfaces\IHasCreatedAt;
use extas\interfaces\IHasId;
use extas\interfaces\IHasUpdatedAt;
use extas\interfaces\IItem;
use extas\interfaces\parameters\IHasParameters;
use extas\interfaces\players\IHasOwner;

/**
 * Interface IPlan
 *
 * @package extas\interfaces\plans
 * @author jeyroik@gmail.com
 */
interface IPlan extends IItem, IHasId, IHasOwner, IHasCreatedAt, IHasUpdatedAt, IHasParameters
{
    const FIELD__PER_DAY = 'per_day';
    const FIELD__PER_WEEK = 'per_week';
    const FIELD__PER_MONTH = 'per_month';
    const FIELD__PER_YEAR = 'per_year';

    /**
     * @return int
     */
    public function getPerDay(): int;

    /**
     * @return int
     */
    public function getPerWeek(): int;

    /**
     * @return int
     */
    public function getPerMonth(): int;

    /**
     * @return int
     */
    public function getPerYear(): int;

    /**
     * @param int $perDay
     *
     * @return $this
     */
    public function setPerDay(int $perDay);

    /**
     * @param int $perWeek
     *
     * @return $this
     */
    public function setPerWeek(int $perWeek);

    /**
     * @param int $perMonth
     *
     * @return $this
     */
    public function setPerMonth(int $perMonth);

    /**
     * @param int $perYear
     *
     * @return $this
     */
    public function setPerYear(int $perYear);
}
