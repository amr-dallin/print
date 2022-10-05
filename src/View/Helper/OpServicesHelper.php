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
    public $helpers = ['ContractOrders', 'Html'];

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
}
