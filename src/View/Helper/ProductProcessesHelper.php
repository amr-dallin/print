<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * ProductProcesses helper
 */
class ProductProcessesHelper extends Helper
{
    public $helpers = ['Html', 'Number', 'Orders', 'ProcessActions', 'ProcessConsumables', 'ProcessPapers'];

    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    public function statusSpinner($productProcess)
    {
        switch($productProcess->status) {
            case PRODUCT_PROCESSES_STATUS_IN_PROGRESS:
                return $this->Html->tag('span', '', [
                    'class' => 'spinner-grow spinner-grow-sm text-warning',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'auto',
                    'data-original-title' => $this->statusList()[PRODUCT_PROCESSES_STATUS_IN_PROGRESS]
                ]);
                break;
            case PRODUCT_PROCESSES_STATUS_COMPLETED:
                return $this->Html->tag('span', '', [
                    'class' => 'status status-success ml-3 mr-1',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'auto',
                    'data-original-title' => $productProcess->date_completed->format('d.m.Y H:i:s')
                ]);
                break;
            case PRODUCT_PROCESSES_STATUS_PROBLEM:
                return $this->Html->tag('span', '', [
                    'class' => 'spinner-grow spinner-grow-sm text-danger',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'auto',
                    'data-original-title' => $productProcess->status_message
                ]);
                break;
        }
    }

    public function statusList()
    {
        return [
            PRODUCT_PROCESSES_STATUS_IN_PROGRESS => __('In progress'),
            PRODUCT_PROCESSES_STATUS_COMPLETED => __('Completed'),
            PRODUCT_PROCESSES_STATUS_PROBLEM => __('Problem')
        ];
    }

    public function isStatusProblem($status)
    {
        return ($status === PRODUCT_PROCESSES_STATUS_PROBLEM) ? true : false;
    }

    public function isStatusCompleted($status)
    {
        return ($status === PRODUCT_PROCESSES_STATUS_COMPLETED) ? true : false;
    }

    public function isViewStatusInfo($productProcess)
    {
        if (
            !$this->Orders->isEstimatedStatus($productProcess->order_product->order) &&
            !$this->isStatusCompleted($productProcess->status)
        ) {
            return true;
        }
        return false;
    }

    public function groupTypeIcon($groupType)
    {
        switch($groupType) {
            case PRODUCT_PROCESSES_GROUP_TYPE_PREPRESS:
                return $this->Html->tag('span',
                    $this->groupTypeList()[PRODUCT_PROCESSES_GROUP_TYPE_PREPRESS],
                    ['class' => 'badge badge-warning']
                );
                break;
            case PRODUCT_PROCESSES_GROUP_TYPE_PRESS:
                return $this->Html->tag('span',
                    $this->groupTypeList()[PRODUCT_PROCESSES_GROUP_TYPE_PRESS],
                    ['class' => 'badge badge-success']
                );
                break;
            case PRODUCT_PROCESSES_GROUP_TYPE_POSTPRESS:
                return $this->Html->tag('span',
                    $this->groupTypeList()[PRODUCT_PROCESSES_GROUP_TYPE_POSTPRESS],
                    ['class' => 'badge badge-primary']
                );
                break;
        }
    }

    public function groupTypeList()
    {
        return [
            PRODUCT_PROCESSES_GROUP_TYPE_PREPRESS => __('Preprint'),
            PRODUCT_PROCESSES_GROUP_TYPE_PRESS => __('Print'),
            PRODUCT_PROCESSES_GROUP_TYPE_POSTPRESS => __('Postprint')
        ];
    }

    public function typeIcon($type)
    {
        switch($type) {
            case PRODUCT_PROCESSES_TYPE_INDEPENDENTLY:
                return $this->Html->tag('span', $this->typeList()[PRODUCT_PROCESSES_TYPE_INDEPENDENTLY], ['class' => 'badge badge-success']);
                break;
            case PRODUCT_PROCESSES_TYPE_OUTSOURCING:
                return $this->Html->tag('span', $this->typeList()[PRODUCT_PROCESSES_TYPE_OUTSOURCING], ['class' => 'badge badge-warning']);
                break;
        }
    }

    public function typeList()
    {
        return [
            PRODUCT_PROCESSES_TYPE_INDEPENDENTLY => __('Independently'),
            PRODUCT_PROCESSES_TYPE_OUTSOURCING => __('Outsourcing')
        ];
    }

    public function isIndependently($type)
    {
        return ($type === PRODUCT_PROCESSES_TYPE_INDEPENDENTLY) ? true : false;
    }

    public function isOutsourcing($type)
    {
        return ($type === PRODUCT_PROCESSES_TYPE_OUTSOURCING) ? true : false;
    }

    public function sortProcessesByGroup($productProcesses)
    {
        $processes = [];
        foreach($productProcesses as $productProcess) {
            switch($productProcess->group_type) {
                case PRODUCT_PROCESSES_GROUP_TYPE_PREPRESS:
                    $processes['preprint'][] = $productProcess;
                    break;
                case PRODUCT_PROCESSES_GROUP_TYPE_PRESS:
                    $processes['print'][] = $productProcess;
                    break;
                case PRODUCT_PROCESSES_GROUP_TYPE_POSTPRESS:
                    $processes['postprint'][] = $productProcess;
                    break;
            }
        }
        
        return $processes;
    }

    public function title($productProcess)
    {
        if ($this->isActionProcess($productProcess)) {
            return h($productProcess->process_action->action_price->action->title);
        } elseif ($this->isLaserMachineProcess($productProcess)) {
            return h($productProcess->process_laser_machine->laser_machine_rate->laser_machine->title);
        }
    }

    public function isActionProcess($productProcess)
    {
        return (isset($productProcess->process_action) && !empty($productProcess->process_action)) ? true : false;
    }

    public function isLaserMachineProcess($productProcess)
    {
        return (isset($productProcess->process_laser_machine) && !empty($productProcess->process_laser_machine)) ? true : false;
    }

    public function existPapers($productProcess)
    {
        return (!empty($productProcess->process_papers)) ? true : false;
    }

    public function existConsumables($productProcess)
    {
        return (!empty($productProcess->process_consumables)) ? true : false;
    }

    public function totalCostPrice($productProcess)
    {
        $processCostPrice = (string)$productProcess->cost_price;

        $papersCostPrice = (string)0;
        if ($this->existPapers($productProcess)) {
            foreach($productProcess->process_papers as $processPaper) {
                $papersCostPrice = bcadd($papersCostPrice, $this->ProcessPapers->costPrice($processPaper), 4);
            }
        }

        $consumablesCostPrice = (string)0;
        if ($this->existConsumables($productProcess)) {
            foreach($productProcess->process_consumables as $processConsumable) {
                $consumablesCostPrice = bcadd($consumablesCostPrice, $this->ProcessConsumables->costPrice($processConsumable), 4);
            }
        }

        $totalCostPrice = (string)0;
        $totalCostPrice = bcadd($totalCostPrice, $processCostPrice, 4);
        $totalCostPrice = bcadd($totalCostPrice, $papersCostPrice, 4);
        $totalCostPrice = bcadd($totalCostPrice, $consumablesCostPrice, 4);

        return $totalCostPrice;
    }
}
