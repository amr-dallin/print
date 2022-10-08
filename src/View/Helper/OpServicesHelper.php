<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * OpServices helper
 */
class OpServicesHelper extends Helper
{
    public $helpers = ['ContractOrders', 'Html', 'Number'];

    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    public function methodList()
    {
        return [
            OPERATION_PRINTING_SERVICES_METHOD_CASH => __('Cash'),
            OPERATION_PRINTING_SERVICES_METHOD_TRANSFER => __('Transfer')
        ];
    }

    public function typeList()
    {
        return [
            OPERATION_PRINTING_SERVICES_TYPE_PRINTING => __('Printing'),
            OPERATION_PRINTING_SERVICES_TYPE_SCANNING => __('Scanning'),
            OPERATION_PRINTING_SERVICES_TYPE_COPYING => __('Copying')
        ];
    }

    public function tabularCalculations($opServices)
    {
        $services = [];
        foreach($opServices as $opService) {
            if (!array_key_exists($opService->type, $services)) {
                /*
                    Данные по типам услуги:
                    Первый элемент массива содержит количество услуг оплаченных в наличной форме
                    Второй элемент массива содержит количество услуг оплаченных переводом
                    Третий элемент массива содержит общую сумму в наличной форме
                    Четвёртый элемент массива содержит общую сумму переводом
                */ 
                $services[$opService->type] = [0, 0, (string)0, (string)0];
            }
            
            if ($opService->method === OPERATION_PRINTING_SERVICES_METHOD_CASH) {
                $services[$opService->type][0]++;
                $services[$opService->type][2] = bcadd($services[$opService->type][2], $opService->amount, 4);
            } else {
                $services[$opService->type][1]++;
                $services[$opService->type][3] = bcadd($services[$opService->type][3], $opService->amount, 4);
            }
        }

        foreach($services as $key => $service) {
            $services[$key][2] = $this->Number->currency($service[2], 'UZS', ['locale' => 'uz_UZ']);
            $services[$key][3] = $this->Number->currency($service[3], 'UZS', ['locale' => 'uz_UZ']);
        }

        ksort($services);
        
        return $services;
    }

    public function paymentsByPaymentMethod($opServices)
    {
        /*
            Первый элемент массива содержит общую сумму в наличной форме
            Второй элемент массива содержит общую сумму переводом
        */
        $results = [(string)0, (string)0];
        foreach($opServices as $opService) {
            if ($opService->method === OPERATION_PRINTING_SERVICES_METHOD_CASH) {
                $results[0] = bcadd($results[0], $opService->amount, 4);
            } else {
                $results[1] = bcadd($results[1], $opService->amount, 4);
            }
        }

        $results[0] = $this->Number->currency($results[0], 'UZS', ['locale' => 'uz_UZ']);
        $results[1] = $this->Number->currency($results[1], 'UZS', ['locale' => 'uz_UZ']);

        return $results;
    }

    public function totalAmount($opServices)
    {
        $totalAmount = (string)0;
        foreach($opServices as $opService) {
            $totalAmount = bcadd($totalAmount, $opService->amount, 4);
        }

        return $this->Number->currency($totalAmount, 'UZS', ['locale' => 'uz_UZ']);
    }
}
