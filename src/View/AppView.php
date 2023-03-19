<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\View;

use Cake\View\View;

/**
 * Application View
 *
 * Your application's default view class
 *
 * @link https://book.cakephp.org/4/en/views.html#the-app-view
 */
class AppView extends View
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading helpers.
     *
     * e.g. `$this->loadHelper('Html');`
     *
     * @return void
     */
    public function initialize(): void
    {
        $this->loadHelper('Authentication.Identity');
        $this->loadHelper('Panel.Panel');
        $this->loadHelper('Form', [
            'className' => 'Panel.Form',
            'errorClass' => 'form-control is-invalid'
        ]);

        $this->loadHelper('ActionPrices');
        $this->loadHelper('Actions');
        $this->loadHelper('CashRegister');
        $this->loadHelper('Clients');
        $this->loadHelper('Consumables');
        $this->loadHelper('ConsumablePrices');
        $this->loadHelper('Expenses');
        $this->loadHelper('LaserMachineRates');
        $this->loadHelper('LaserMachines');
        $this->loadHelper('Materials');
        $this->loadHelper('OpServices');
        $this->loadHelper('OrderProducts');
        $this->loadHelper('Orders');
        $this->loadHelper('PaperDensities');
        $this->loadHelper('PaperPrices');
        $this->loadHelper('Papers');
        $this->loadHelper('PhoneNumbers');
        $this->loadHelper('ProcessActions');
        $this->loadHelper('ProcessConsumables');
        $this->loadHelper('ProcessLaserMachines');
        $this->loadHelper('ProcessPapers');
        $this->loadHelper('ProductProcesses');
        $this->loadHelper('PurchaseEntities');
        $this->loadHelper('Purchases');
        $this->loadHelper('Storage');
    }
}
