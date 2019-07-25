# kb-plan

Пакет с сущностью "План".

# Установка

`composer requrie jeyroik/kb-plan`

# Использование

Предполагается следующая модель использования данного пакета:
- Создание собственных сущностей, наследующих сущности текущего пакета (План, План-факт и Прогресс по плану).
- В рамках создания собственных сущностей рекомендуется использовать свои репозитории (но они могут наследовать репозитории по умолчанию из этого пакета).
- В остальном использование абсолютно идентично нижеприведённому.

## Пример использования сущностей пакета:

```php
/**
 * @var $planRepo extas\interfaces\plans\IPlanRepository
 */
$plan = $planRepo->one([IPlan::FIELD__ID => 'demo.plan']);
$plan->addProgress(['items_count' => 20])
```

## Создание своих сущностей

### Классы сущностей

```php
class MyPlanProgress extends PlanProgress
{
    protected $planRepo = 'my\extas\plans\Repository';
}

class MyPlan extends Plan
{
    protected $planProgressRepo = 'my\extas\plans\progress\Repository';
    
    /**
     * @return string
     */
    protected function getPlanSubject()
    {
        return 'my.plan';
    }

    /**
     * @param array $data
     * 
     * @return IPlanProgress
     */
    protected function getPlanProgress($data)
    {
        return new MyPlanProgress($data);
    }
}

class MyPlanFact extends PlanFact
{
    protected $planRepo = 'my\extas\plans\Repository';
    protected $factRepo = 'my\extas\plans\facts\Repository';
}
```

### Плагины

Для наc будет доступна следующая стадия (событие):
- `my.plan.progress.added (IPlan $plan, IPlanProgress $progress)` - добавлен прогресс по плану

Необходимо создать плагин для данного события.

```php
class MyPluginFact extends PlanPluginProgressAddToFact
{
    protected $factRepo = 'my\extas\plans\facts\Repository';
    
    /**
     * @override_it
     *
     * @return string
     */
    protected function getPlanFactSubject()
    {
        return 'my.plan.fact';
    }

    /**
     * @override_it
     *
     * @param $factData
     *
     * @return IPlanFact
     */
    protected function getPlanFact($factData)
    {
        return new MyPlanFact($factData);
    }
}
```

После этого станет доступна стадия (событие):
- `my.plan.fact.progress.add (IPlanFact $fact, IPlanProgress $progress)` - подготовка к добавление прогресса по план-факту.

Необходимо реализовать плагин для этой стадии, чтобы применить параметры из прогресса к план-факту.

Например, будем использовать эти сущности для отслеживания прогресса чтения. Для этого будем использовать параметр прогресса "pages_count".

```php
class CountPagesPlugin extends Plugin
{
    public function __invoke(&$fact, $progress)
    {
        $factPages = $fact->getParameter('pages_count', null);
        $progressPages = $progress->getParameter('page_count', [
            'name' => 'pages_count',
            'value' => 0
        ]);
        
        if (!$factPages) {
            $factPages = $progressPages;
        } else {
            $factPages->setValue($factPages->getValue() + $progressPages->getValue());
        }
        
        $fact->setParameter('pages_count', $factPages);
        $fact->setParameter('book', $progress->getParameter('book'));
    }
}
```

### Использование всего ранее созданного вместе

```php
/**
 * @var $planRepo my\extas\plans\Repository
 */
 
$plan = $planRepo->one([IPlan::FIELD__ID => 'my.plan.some.id']);
if ($plan) {
    $plan->addProgress([
        'pages_count' => 20,
        'book' => 'jeyroik/kb-plan/README.md'
    ]);
}
```