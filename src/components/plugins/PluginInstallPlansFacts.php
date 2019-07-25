<?php
namespace extas\components\plugins;

use extas\components\plans\facts\PlanFact;
use extas\interfaces\plans\facts\IPlanFactRepository;

/**
 * Class PluginInstallPlansFacts
 *
 * @stage extas.install
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallPlansFacts extends PluginInstallDefault
{
    protected $selfItemClass = PlanFact::class;
    protected $selfRepositoryClass = IPlanFactRepository::class;
    protected $selfUID = PlanFact::FIELD__ID;
    protected $selfSection = 'plans_facts';
    protected $selfName = 'plan fact';
}
