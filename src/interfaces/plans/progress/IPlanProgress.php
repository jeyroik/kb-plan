<?php
namespace extas\interfaces\plans\progress;

use extas\interfaces\IHasCreatedAt;
use extas\interfaces\IHasId;
use extas\interfaces\IItem;
use extas\interfaces\parameters\IHasParameters;
use extas\interfaces\plans\IHasPlan;
use extas\interfaces\players\IHasOwner;

/**
 * Interface IPlanProgress
 *
 * @package extas\interfaces\plans
 * @author jeyroik@gmail.com
 */
interface IPlanProgress extends IItem, IHasPlan, IHasId, IHasOwner, IHasCreatedAt, IHasParameters
{

}
