<?php
namespace extas\components\plugins;

use extas\components\plans\Plan;
use extas\interfaces\plans\IPlanRepository;

/**
 * Class PluginInstallPlans
 *
 * @stage extas.install
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallPlans extends PluginInstallDefault
{
    protected $selfItemClass = Plan::class;
    protected $selfRepositoryClass = IPlanRepository::class;
    protected $selfUID = Plan::FIELD__ID;
    protected $selfSection = 'plans';
    protected $selfName = 'plan';
}
