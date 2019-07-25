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
    const SUBJECT = 'kb.plan';

    const FIELD__SECONDS = 'seconds';
    const FIELD__MINUTES = 'minutes';
    const FIELD__HOURS = 'hours';
    const FIELD__DAYS = 'days';
    const FIELD__WEEKS = 'weeks';
    const FIELD__MONTHS = 'months';
    const FILED__YEARS = 'years';

    const FIELD__PER_SECOND = 'per_second';
    const FIELD__PER_MINUTE = 'per_minute';
    const FIELD__PER_HOUR = 'per_hour';
    const FIELD__PER_DAY = 'per_day';
    const FIELD__PER_WEEK = 'per_week';
    const FIELD__PER_MONTH = 'per_month';
    const FIELD__PER_YEAR = 'per_year';

    const FIELD__DEADLINE = 'deadline';

    /**
     * @param string $format
     *
     * @return string|int
     */
    public function getDeadline($format = '');

    /**
     * @return float
     */
    public function getPerSecond(): float;

    /**
     * @return float
     */
    public function getPerMinute(): float;

    /**
     * @return float
     */
    public function getPerHour(): float;

    /**
     * @return float
     */
    public function getPerDay(): float;

    /**
     * @return float
     */
    public function getPerWeek(): float;

    /**
     * @return float
     */
    public function getPerMonth(): float;

    /**
     * @return float
     */
    public function getPerYear(): float;

    /**
     * @return float
     */
    public function getSeconds(): float;

    /**
     * @return float
     */
    public function getMinutes(): float;

    /**
     * @return float
     */
    public function getHours(): float;

    /**
     * @return float
     */
    public function getDays(): float;

    /**
     * @return float
     */
    public function getWeeks(): float;

    /**
     * @return float
     */
    public function getMonths(): float;

    /**
     * @return float
     */
    public function getYears(): float;

    /**
     * @param int|string|\DateTime $deadline
     *
     * @return $this
     */
    public function setDeadline($deadline);

    /**
     * @param float $per
     * 
     * @return $this
     */
    public function setPerSecond(float $per);

    /**
     * @param float $per
     * 
     * @return $this
     */
    public function setPerMinute(float $per);

    /**
     * @param float $per
     * 
     * @return $this
     */
    public function setPerHour(float $per);

    /**
     * @param float $perDay
     *
     * @return $this
     */
    public function setPerDay(float $perDay);

    /**
     * @param float $perWeek
     *
     * @return $this
     */
    public function setPerWeek(float $perWeek);

    /**
     * @param float $perMonth
     *
     * @return $this
     */
    public function setPerMonth(float $perMonth);

    /**
     * @param float $perYear
     *
     * @return $this
     */
    public function setPerYear(float $perYear);

    /**
     * @param float $seconds
     * 
     * @return $this
     */
    public function setSeconds(float $seconds);

    /**
     * @param float $minutes
     * 
     * @return $this
     */
    public function setMinutes(float $minutes);

    /**
     * @param float $hours
     * 
     * @return $this
     */
    public function setHours(float $hours);

    /**
     * @param float $days
     * 
     * @return $this
     */
    public function setDays(float $days);

    /**
     * @param float $weeks
     * 
     * @return $this
     */
    public function setWeeks(float $weeks);

    /**
     * @param float $months
     * 
     * @return $this
     */
    public function setMonths(float $months);

    /**
     * @param float $years
     * 
     * @return $this
     */
    public function setYears(float $years);
}
