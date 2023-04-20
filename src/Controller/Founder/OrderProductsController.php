<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;
use App\Service\OrderProductsService;
use App\Service\OrdersService;
use Cake\ORM\Locator\LocatorAwareTrait;

/**
 * OrderProducts Controller
 *
 * @property \App\Model\Table\OrderProductsTable $OrderProducts
 * @method \App\Model\Entity\OrderProduct[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrderProductsController extends AppController
{
    use LocatorAwareTrait;

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Contractors', 'Orders', 'ProductTypes'],
        ];
        $orderProducts = $this->paginate($this->OrderProducts);

        $this->set(compact('orderProducts'));
    }

    /**
     * View method
     *
     * @param string|null $id Order Product id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $orderProduct = $this->OrderProducts->get($id, [
            'contain' => [
                'Contractors.Representatives.PhoneNumbers',
                'Orders.Clients',
                'ProductTypes',
                'ProductProcesses' => function ($q) {
                    return $q
                        ->contain([
                            'Contractors',
                            'OrderProducts.Orders',
                            'ProcessActions.ActionPrices.Actions.Units',
                            'ProcessConnections' => [
                                'ParentProcesses',
                                'ProductProcesses'
                            ],
                            'ProcessConsumables.ConsumablePrices.Consumables' => function ($q) {
                                return $q->contain([
                                    'ConsumableCategories',
                                    'InitialUnits',
                                    'Units'
                                ]);
                            },
                            'ProcessLaserMachines.LaserMachineRates.LaserMachines',
                            'ProcessPapers.PaperPrices.Papers' => function ($q) {
                                return $q->contain([
                                    'PaperColors',
                                    'PaperDensities',
                                    'PaperFormats',
                                    'PaperPrices',
                                    'PaperTypes',
                                    'InitialUnits',
                                    'Units'
                                ]);
                            }
                        ])
                        ->order(['ProductProcesses.group_type' => 'ASC']);
                }
            ]
        ]);

        $consumables = $this->getTableLocator()->get('Consumables')
            ->find('list', [
                'keyField' => 'consumable_prices.0.id',
                'valueField' => 'full_name'
            ])
            ->find('used')
            ->innerJoinWith('ConsumablePrices', function ($q) {
                return $q->find('isCurrent');
            })
            ->contain([
                'ConsumablePrices',
                'InitialUnits',
                'Units'
            ]);

        $contractors = $this->getTableLocator()->get('Contractors')->find('list');

        $laserMachines = $this->getTableLocator()->get('LaserMachines')
            ->find('list', [
                'keyField' => 'laser_machine_rates.0.id',
                'valueField' => 'title'
            ])
            ->innerJoinWith('LaserMachineRates', function ($q) {
                return $q->find('current');
            })
            ->contain('LaserMachineRates', function ($q) {
                return $q->find('current');
            });

        $papers = $this->getTableLocator()->get('Papers')
            ->find('list', [
                'keyField' => 'paper_prices.0.id',
                'valueField' => 'full_name'
            ])
            ->innerJoinWith('PaperPrices', function ($q) {
                return $q->find('isCurrent');
            })
            ->contain([
                'PaperColors',
                'PaperDensities',
                'PaperFormats',
                'PaperPrices' => function ($q) {
                    return $q->find('isCurrent');
                },
                'PaperTypes',
                'Expenses',
                'InitialUnits',
                'Units'
            ]);

        $postPrintActions = $this->getTableLocator()->get('Actions')
            ->find('list', [
                'keyField' => 'action_prices.0.id',
                'valueField' => 'title_with_unit'
            ])
            ->find('postPrint')
            ->innerJoinWith('ActionPrices', function ($q) {
                return $q->find('isCurrent');
            })
            ->contain('Units')
            ->contain('ActionPrices', function ($q) {
                return $q->find('isCurrent');
            });

        $prePrintActions = $this->getTableLocator()->get('Actions')
            ->find('list', [
                'keyField' => 'action_prices.0.id',
                'valueField' => 'title_with_unit'
            ])
            ->find('prePrint')
            ->innerJoinWith('ActionPrices', function ($q) {
                return $q->find('isCurrent');
            })
            ->contain('Units')
            ->contain('ActionPrices', function ($q) {
                return $q->find('isCurrent');
            });

        $productProcess = $this->OrderProducts->ProductProcesses->newEmptyEntity();
        $productProcesses = $this->OrderProducts->ProductProcesses->find('list')
            ->where(['ProductProcesses.order_product_id' => $id]);

        $productTypes = $this->OrderProducts->ProductTypes->find('list');
        $processConsumable = $this->getTableLocator()->get('ProcessConsumables')->newEmptyEntity();
        $processPaper = $this->getTableLocator()->get('ProcessPapers')->newEmptyEntity();

        $this->set(
            compact(
                'consumables',
                'contractors',
                'laserMachines',
                'orderProduct',
                'papers',
                'postPrintActions',
                'processConsumable',
                'processPaper',
                'prePrintActions',
                'productProcess',
                'productProcesses',
                'productTypes'
            )
        );
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add(OrderProductsService $orderProducts)
    {
        $this->request->allowMethod(['post']);
        $orderProduct = $this->OrderProducts->newEmptyEntity();
        $orderProduct = $this->OrderProducts->patchEntity($orderProduct, $this->request->getData());

        $orderProduct = $orderProducts->save($orderProduct);
        if (false !== $orderProduct) {
            $this->Flash->success(__('The order product has been saved.'));
        } else {
            $this->Flash->error(__('The order product could not be saved. Please, try again.'));
        }
            
        return $this->redirect(['controller' => 'Orders', 'action' => 'view', h($orderProduct->order_id)]);
    }

    public function changeStatus(OrderProductsService $orderProducts, $id)
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $orderProduct = $this->OrderProducts->findById($id)
            ->firstOrFail();

        $orderProduct = $this->OrderProducts->patchEntity($orderProduct, $this->request->getData());
        if ($orderProducts->changeStatus($orderProduct)) {
            $this->Flash->success(__('Order product process status changed.'));
        } else {
            $this->Flash->error(__('Order product process status not changed. Please, try again.'));
        }

        return $this->redirect(['controller' => 'OrderProducts', 'action' => 'view', h($orderProduct->id)]);
    }

    public function specifyContractor(OrderProductsService $orderProducts, $id)
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $orderProduct = $this->OrderProducts->get($id);
        $orderProduct = $this->OrderProducts->patchEntity($orderProduct, $this->request->getData());
        if ($orderProducts->specifyContractor($orderProduct)) {
            $this->Flash->success(__('The order product has been saved.'));
        } else {
            $this->Flash->error(__('The order product could not be saved. Please, try again.'));
        }

        return $this->redirect(['action' => 'view', h($orderProduct->id)]);
    }

    /**
     * Edit method
     */
    public function edit(OrdersService $orders, $id = null)
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $orderProduct = $this->OrderProducts->get($id);
        $orderProduct = $this->OrderProducts->patchEntity($orderProduct, $this->request->getData());
        if ($this->OrderProducts->save($orderProduct)) {
            $orders->cost($orderProduct->order_id);
            $this->Flash->success(__('The order product has been saved.'));
        } else {
            $this->Flash->error(__('The order product could not be saved. Please, try again.'));
        }

        return $this->redirect(['action' => 'view', h($orderProduct->id)]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Order Product id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(OrdersService $orders, $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $orderProduct = $this->OrderProducts->get($id);
        if ($this->OrderProducts->delete($orderProduct)) {
            $orders->status($orderProduct->order_id);
            $orders->cost($orderProduct->order_id);

            $this->Flash->success(__('The order product has been deleted.'));
        } else {
            $this->Flash->error(__('The order product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'Orders', 'action' => 'view', h($orderProduct->order_id)]);
    }
}
