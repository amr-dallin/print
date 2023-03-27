<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;
use App\Service\OrdersService;

/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 * @method \App\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrdersController extends AppController
{
    /**
     * Index estimated method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function indexEstimated()
    {
        $orders = $this->Orders->find('estimated')
            ->contain('OrderProducts');

        $this->set('orders', $orders);
    }

    /**
     * Index in progress method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function indexInProgress()
    {
        $orders = $this->Orders->find('inProgress')
            ->contain([
                'Clients',
                'OrderProducts'
            ]);

        $this->set('orders', $orders);
    }

    /**
     * Index statement completed method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function indexStatementCompleted()
    {
        $orders = $this->Orders->find('statementCompleted')
            ->contain([
                'Clients',
                'OrderProducts'
            ]);

        $this->set('orders', $orders);
    }

    /**
     * Index completed method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function indexCompleted()
    {
        $orders = $this->Orders->find('completed')
            ->contain([
                'Clients',
                'OrderProducts'
            ]);

        $this->set('orders', $orders);
    }

    /**
     * Index problem method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function indexProblem()
    {
        $orders = $this->Orders->find('problem')
            ->contain([
                'Clients',
                'OrderProducts'
            ]);

        $this->set('orders', $orders);
    }

    /**
     * View method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => [
                'Clients.Representatives.PhoneNumbers',
                'OrderProducts' => [
                    'ProductProcesses' => function ($q) {
                        return $q
                            ->contain([
                                'Contractors',
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
                    },
                    'ProductTypes'
                ]
                
            ],
        ]);

        $externalClients = $this->Orders->Clients->find('list')->find('external');
        $internalClients = $this->Orders->Clients->find('list')->find('internal');
        $contractors = $this->Orders->OrderProducts->Contractors->find('list');
        $orderProduct = $this->Orders->OrderProducts->newEmptyEntity();
        $productTypes = $this->Orders->OrderProducts->ProductTypes->find('list');
        $this->set(compact('contractors', 'externalClients', 'internalClients', 'order', 'orderProduct', 'productTypes'));
    }

    public function document($id)
    {
        $order = $this->Orders->get($id, [
            'contain' => [
                'Clients.Representatives.PhoneNumbers',
                'OrderProducts' => [
                    'ProductTypes'
                ]
            ],
        ]);

        $this->viewBuilder()->setOption('pdfConfig', [
            'filename' => 'order_document_' . $order->id . '.pdf'
        ]);

        $this->set('order', $order);
    }

    public function inProgress(OrdersService $orders, $id)
    {
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);
        if ($orders->inProgress($order)) {
            $this->Flash->success(__('Order submitted for execution.'));
        } else {
            $this->Flash->error(__('Order not submitted for execution. Please, try again.'));
        }

        return $this->redirect(['action' => 'view', h($id)]);
    }

    public function completed(OrdersService $orders, $id)
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $order = $this->Orders->get($id);
        $order = $this->Orders->patchEntity($order, $this->request->getData());
        if ($orders->completed($order)) {
            $this->Flash->success(__('Order completed.'));
        } else {
            $this->Flash->error(__('Order not completed. Please, try again.'));
        }

        return $this->redirect(['action' => 'view', h($id)]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add(OrdersService $orders)
    {
        $order = $orders->create();
        if (false !== $order) {
            $this->Flash->success(__('The order has been saved.'));
            return $this->redirect(['action' => 'view', h($order->id)]);
        }

        $this->Flash->error(__('The order could not be saved. Please, try again.'));
        return $this->redirect(['controller' => 'SystemicPages', 'action' => 'press']);
    }

    public function specifyClient(OrdersService $orders, $id)
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $order = $this->Orders->get($id);
        $order = $this->Orders->patchEntity($order, $this->request->getData());
        if ($orders->specifyClient($order)) {
            $this->Flash->success(__('The order has been saved.'));
        } else {
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }

        return $this->redirect(['action' => 'view', h($order->id)]);
    }

    /**
     * Edit method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $order = $this->Orders->get($id, [
            'contain' => [],
        ]);
        $order = $this->Orders->patchEntity($order, $this->request->getData());
        if ($this->Orders->save($order)) {
            $this->Flash->success(__('The order has been saved.'));
        } else {
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }

        return $this->redirect(['action' => 'view', h($order->id)]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);
        if ($this->Orders->delete($order)) {
            $this->Flash->success(__('The order has been deleted.'));
        } else {
            $this->Flash->error(__('The order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'indexInProgress']);
    }
}
