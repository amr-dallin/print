<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * Clients helper
 */
class ClientsHelper extends Helper
{
    public $helpers = ['Html', 'Number'];

    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    public function typeIcon($type)
    {
        switch($type) {
            case CLIENTS_TYPE_INTERNAL:
                return $this->Html->tag('span', $this->typeList()[CLIENTS_TYPE_INTERNAL], ['class' => 'badge badge-warning']);
                break;
            case CLIENTS_TYPE_EXTERNAL:
                return $this->Html->tag('span', $this->typeList()[CLIENTS_TYPE_EXTERNAL], ['class' => 'badge badge-success']);
                break;
        }
    }

    public function typeList()
    {
        return [
            CLIENTS_TYPE_INTERNAL => __('Internal'),
            CLIENTS_TYPE_EXTERNAL => __('External')
        ];
    }

    public function navigationSlug($type)
    {
        if ($type === CLIENTS_TYPE_INTERNAL) {
            return 'internal';
        } elseif ($type === CLIENTS_TYPE_EXTERNAL) {
            return 'external';
        }
    }

    public function isInternal($type)
    {
        return ($type === CLIENTS_TYPE_INTERNAL) ? true : false;
    }

    public function isExternal($type)
    {
        return ($type === CLIENTS_TYPE_EXTERNAL) ? true : false;
    }
}
