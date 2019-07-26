<?php
namespace extas\components\plans;

use extas\components\Item;
use extas\components\parameters\THasParameters;
use extas\components\plans\progress\PlanProgress;
use extas\components\players\THasOwner;
use extas\components\SystemContainer;
use extas\components\THasCreatedAt;
use extas\components\THasId;
use extas\components\THasUpdatedAt;
use extas\interfaces\parameters\IParameter;
use extas\interfaces\plans\IPlan;
use extas\interfaces\plans\progress\IPlanProgress;
use extas\interfaces\plans\progress\IPlanProgressRepository;

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

    protected $planProgressRepo = IPlanProgressRepository::class;

    /**
     * @override_it
     *
     * @return string
     */
    protected function getPlanSubject()
    {
        return 'kb.plan';
    }

    /**
     * @override_it
     *
     * @param array $data
     *
     * @return IPlanProgress
     */
    protected function getPlanProgress($data)
    {
        return new PlanProgress($data);
    }

    /**
     * @param $parameters
     *
     * @return $this
     */
    public function addProgress($parameters)
    {
        $progressParameters = [];

        foreach ($parameters as $name => $value) {
            $progressParameters[] = [
                IParameter::FIELD__NAME => $name,
                IParameter::FIELD__VALUE => $value
            ];
        }

        $progress = $this->getPlanProgress([
            PlanProgress::FIELD__PLAN_ID => $this->getId(),
            PlanProgress::FIELD__CREATED_AT => time(),
            PlanProgress::FIELD__PARAMETERS => $progressParameters,
            PlanProgress::FIELD__OWNER => $this->getOwnerName()
        ]);

        /**
         * @var $progressRepo IPlanProgressRepository
         */
        $progressRepo = SystemContainer::getItem($this->planProgressRepo);
        $progressRepo->create($progress);

        $stage = $this->getPlanSubject() . '.progress.added';
        foreach ($this->getPluginsByStage($stage) as $plugin) {
            $plugin($this, $progress);
        }

        return $this;
    }

    /**
     * @return float
     */
    public function getSeconds(): float
    {
        return $this->config[static::FIELD__SECONDS] ?? 0;
    }

    /**
     * @return float
     */
    public function getMinutes(): float
    {
        return $this->config[static::FIELD__MINUTES] ?? 0;
    }

    /**
     * @return float
     */
    public function getHours(): float
    {
        return $this->config[static::FIELD__HOURS] ?? 0;
    }

    /**
     * @return float
     */
    public function getDays(): float
    {
        return $this->config[static::FIELD__DAYS] ?? 0;
    }

    /**
     * @return float
     */
    public function getWeeks(): float
    {
        return $this->config[static::FIELD__WEEKS] ?? 0;
    }

    /**
     * @return float
     */
    public function getMonths(): float
    {
        return $this->config[static::FIELD__MONTHS] ?? 0;
    }

    /**
     * @return float
     */
    public function getYears(): float
    {
        return $this->config[static::FILED__YEARS] ?? 0;
    }

    /**
     * @param string $format
     *
     * @return float|string
     */
    public function getDeadline($format = '')
    {
        $deadline = $this->config[static::FIELD__DEADLINE] ?? 0;

        return $format ? date($format, $deadline) : $deadline;
    }

    /**
     * @return float
     */
    public function getPerSecond(): float
    {
        return $this->config[static::FIELD__PER_SECOND] ?? 0;
    }

    /**
     * @return float
     */
    public function getPerMinute(): float
    {
        return $this->config[static::FIELD__PER_MINUTE] ?? 0;
    }

    /**
     * @return float
     */
    public function getPerHour(): float
    {
        return $this->config[static::FIELD__PER_HOUR] ?? 0;
    }

    /**
     * @return float
     */
    public function getPerDay(): float
    {
        return $this->config[static::FIELD__PER_DAY] ?? 0;
    }

    /**
     * @return float
     */
    public function getPerWeek(): float
    {
        return $this->config[static::FIELD__PER_WEEK] ?? 0;
    }

    /**
     * @return float
     */
    public function getPerMonth(): float
    {
        return $this->config[static::FIELD__PER_MONTH] ?? 0;
    }

    /**
     * @return float
     */
    public function getPerYear(): float
    {
        return $this->config[static::FIELD__PER_YEAR] ?? 0;
    }

    /**
     * @param float $seconds
     *
     * @return $this
     */
    public function setSeconds(float $seconds)
    {
        $this->config[static::FIELD__SECONDS] = $seconds;

        return $this;
    }

    /**
     * @param float $minutes
     *
     * @return $this
     */
    public function setMinutes(float $minutes)
    {
        $this->config[static::FIELD__MINUTES] = $minutes;

        return $this;
    }

    /**
     * @param float $hours
     *
     * @return $this
     */
    public function setHours(float $hours)
    {
        $this->config[static::FIELD__HOURS] = $hours;

        return $this;
    }

    /**
     * @param float $days
     *
     * @return $this
     */
    public function setDays(float $days)
    {
        $this->config[static::FIELD__DAYS] = $days;

        return $this;
    }

    /**
     * @param float $weeks
     *
     * @return $this
     */
    public function setWeeks(float $weeks)
    {
        $this->config[static::FIELD__WEEKS] = $weeks;

        return $this;
    }

    /**
     * @param float $months
     *
     * @return $this
     */
    public function setMonths(float $months)
    {
        $this->config[static::FIELD__MONTHS] = $months;

        return $this;
    }

    /**
     * @param float $years
     *
     * @return $this
     */
    public function setYears(float $years)
    {
        $this->config[static::FILED__YEARS] = $years;

        return $this;
    }

    /**
     * @param \DateTime|int|string $deadline
     *
     * @return $this
     */
    public function setDeadline($deadline)
    {
        if ($deadline instanceof \DateTime) {
            $deadline = $deadline->getTimestamp();
        } elseif (!is_numeric($deadline)) {
            $deadline = strtotime($deadline);
        }

        $this->config[static::FIELD__DEADLINE] = (float) $deadline;

        return $this;
    }

    /**
     * @param float $per
     *
     * @return $this
     */
    public function setPerSecond(float $per)
    {
        $this->config[static::FIELD__PER_SECOND] = $per;

        return $this;
    }

    /**
     * @param float $per
     *
     * @return $this
     */
    public function setPerMinute(float $per)
    {
        $this->config[static::FIELD__PER_MINUTE] = $per;

        return $this;
    }

    /**
     * @param float $per
     *
     * @return $this
     */
    public function setPerHour(float $per)
    {
        $this->config[static::FIELD__PER_HOUR] = $per;

        return $this;
    }

    /**
     * @param float $perDay
     *
     * @return $this
     */
    public function setPerDay(float $perDay)
    {
        $this->config[static::FIELD__PER_DAY] = $perDay;

        return $this;
    }

    /**
     * @param float $perWeek
     *
     * @return $this
     */
    public function setPerWeek(float $perWeek)
    {
        $this->config[static::FIELD__PER_WEEK] = $perWeek;

        return $this;
    }

    /**
     * @param float $perMonth
     *
     * @return $this
     */
    public function setPerMonth(float $perMonth)
    {
        $this->config[static::FIELD__PER_MONTH] = $perMonth;

        return $this;
    }

    /**
     * @param float $perYear
     *
     * @return $this
     */
    public function setPerYear(float $perYear)
    {
        $this->config[static::FIELD__PER_YEAR] = $perYear;

        return $this;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
