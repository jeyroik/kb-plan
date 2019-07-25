<?php
namespace extas\components\plugins;

use extas\components\plans\progress\PlanProgress;
use extas\interfaces\plans\progress\IPlanProgressRepository;

/**
 * Class PluginInstallPlansProgress
 *
 * @stage extas.install
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallPlansProgress extends PluginInstallDefault
{
    protected $selfItemClass = PlanProgress::class;
    protected $selfRepositoryClass = IPlanProgressRepository::class;
    protected $selfUID = PlanProgress::FIELD__ID;
    protected $selfSection = 'plans_progress';
    protected $selfName = 'plan progress';
}
