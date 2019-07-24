<?php
namespace extas\components\plans;

use extas\components\Item;
use extas\components\parameters\THasParameters;
use extas\components\players\THasOwner;
use extas\components\THasCreatedAt;
use extas\components\THasId;
use extas\components\THasUpdatedAt;
use extas\interfaces\plans\IPlan;

/**
 * Class Plan
 *
 * @package extas\components\plans
 * @author jeyroik@gmail.com
 */
class Plan extends Item implements IPlan
{
    use THasId;
    use THasOwner;
    use THasCreatedAt;
    use THasUpdatedAt;
    use THasParameters;

    /**
     * @return int
     */
    public function getPerDay(): int
    {
        return $this->config[static::FIELD__PER_DAY] ?? 0;
    }

    /**
     * @return int
     */
    public function getPerWeek(): int
    {
        return $this->config[static::FIELD__PER_WEEK] ?? 0;
    }

    /**
     * @return int
     */
    public function getPerMonth(): int
    {
        return $this->config[static::FIELD__PER_MONTH] ?? 0;
    }

    /**
     * @return int
     */
    public function getPerYear(): int
    {
        return $this->config[static::FIELD__PER_YEAR] ?? 0;
    }

    /**
     * @param int $perDay
     *
     * @return $this
     */
    public function setPerDay(int $perDay)
    {
        $this->config[static::FIELD__PER_DAY] = $perDay;

        return $this;
    }

    /**
     * @param int $perWeek
     *
     * @return $this
     */
    public function setPerWeek(int $perWeek)
    {
        $this->config[static::FIELD__PER_WEEK] = $perWeek;

        return $this;
    }

    /**
     * @param int $perMonth
     *
     * @return $this
     */
    public function setPerMonth(int $perMonth)
    {
        $this->config[static::FIELD__PER_MONTH] = $perMonth;

        return $this;
    }

    /**
     * @param int $perYear
     *
     * @return $this
     */
    public function setPerYear(int $perYear)
    {
        $this->config[static::FIELD__PER_YEAR] = $perYear;

        return $this;
    }
}
