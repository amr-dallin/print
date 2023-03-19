<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * PhoneNumbers helper
 */
class PhoneNumbersHelper extends Helper
{
    public $helpers = ['Html', 'Number'];

    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    public function isTelegram($isTelegram)
    {
        return ($isTelegram) ? true : false;
    }
}
