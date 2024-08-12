<?php
declare(strict_types=1);

namespace App\Service;

use App\Service\OrdersService;
use App\Service\ProcessActionsSerice;
use App\Service\ProcessLaserMachinesService;
use Cake\Database\Expression\QueryExpression;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\FrozenTime;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\Utility\Inflector;

class ProductProcessesService
{
    use LocatorAwareTrait;

    public function changeStatus($productProcess)
    {
        switch($productProcess->status) {
            case PRODUCT_PROCESSES_STATUS_IN_PROGRESS:
                $productProcess->set('date_completed', null);
                $productProcess->set('status_message', null);
                break;
            case PRODUCT_PROCESSES_STATUS_COMPLETED:
                $productProcess->set('status_message', null);
                break;
            case PRODUCT_PROCESSES_STATUS_PROBLEM:
                $productProcess->set('date_completed', null);
                break;
        }

        if ($this->getTableLocator()->get('ProductProcesses')->save($productProcess)) {

            $order = $this->getTableLocator()->get('Orders')->find()
                ->innerJoinWith('OrderProducts', function ($q) use ($productProcess) {
                    return $q->where([
                        'OrderProducts.id' => $productProcess->order_product_id
                    ]);
                })
                ->firstOrFail();

            return (new OrdersService())->status($order->id);
        }

        return false;
    }

    public function save($productProcess)
    {
        if ($productProcess->isNew()) {
            $productProcess = $this->setUniqueId($productProcess);
            $productProcess = $this->setInProgressStatus($productProcess);
        }

        $productProcess = $this->setTypeInfo($productProcess);
        $productProcess = $this->setCostPrice($productProcess);
        if ($this->getTableLocator()->get('ProductProcesses')->save($productProcess)) {
            $order = $this->getTableLocator()->get('Orders')->find()
                ->innerJoinWith('OrderProducts', function ($q) use ($productProcess) {
                    return $q->where([
                        'OrderProducts.id' => $productProcess->order_product_id
                    ]);
                })
                ->firstOrFail();

            (new OrdersService())->status($order->id);
            (new OrdersService())->cost($order->id);

            return $productProcess;
        }

        return false;
    }

    private function setCostPrice($productProcess)
    {
        if ($this->isOutsourcing($productProcess->type)) {
            return $productProcess;
        }

        $costPrice = (string)0;
        if ($this->isActionProcess($productProcess)) {
            $processActions = new ProcessActionsService();
            $costPrice = $processActions->getCostPrice($productProcess->process_action);
        } elseif ($this->isLaserMachineProcess($productProcess)) {
            $processLaserMachines = new ProcessLaserMachinesService();
            $costPrice = $processLaserMachines->getCostPrice($productProcess->process_laser_machine);
        }

        $productProcess->set('cost_price', $costPrice);
        return $productProcess;
    }

    private function isOutsourcing($type)
    {
        return ($type === PRODUCT_PROCESSES_TYPE_OUTSOURCING) ? true : false;
    }

    private function isActionProcess($productProcess)
    {
        return (isset($productProcess->process_action) && !empty($productProcess->process_action)) ? true : false;
    }

    private function isLaserMachineProcess($productProcess)
    {
        return (isset($productProcess->process_laser_machine) && !empty($productProcess->process_laser_machine)) ? true : false;
    }

    public function setTypeInfo($productProcess)
    {
        if (!$productProcess->isDirty('type')) {
            return;
        }

        if ($productProcess->type === PRODUCT_PROCESSES_TYPE_INDEPENDENTLY) {
            $productProcess->set('contractor_id', null);
            $productProcess->set('contractor_full_name', null);
            $productProcess->set('contractor_telephone', null);
        } else if ($productProcess->type === PRODUCT_PROCESSES_TYPE_OUTSOURCING && !empty($productProcess->contractor_id)) {
            $contractor = $this->getTableLocator()->get('Contractors')->findById($productProcess->contractor_id)
                ->contain('Representatives.PhoneNumbers')
                ->firstOrFail();

            $productProcess->set('contractor_full_name', $contractor->representative->full_name);
            $productProcess->set('contractor_telephone', $contractor->representative->phone_number->full_number);
        }

        return $productProcess;
    }

    private function setInProgressStatus($productProcess)
    {
        return $productProcess->set('status', PRODUCT_PROCESSES_STATUS_IN_PROGRESS);
    }

    private function setUniqueId($productProcess)
    {
        return $productProcess->set('unique_id', uniqid());
    }
}