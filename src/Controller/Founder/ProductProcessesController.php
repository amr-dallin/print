<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;
use App\Service\OrdersService;
use App\Service\ProductProcessesService;

/**
 * ProductProcesses Controller
 *
 * @property \App\Model\Table\ProductProcessesTable $ProductProcesses
 * @method \App\Model\Entity\ProductProcess[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductProcessesController extends AppController
{
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add(ProductProcessesService $productProcesses)
    {
        $this->request->allowMethod(['post']);
        $productProcess = $this->ProductProcesses->newEmptyEntity();
        $productProcess = $this->ProductProcesses->patchEntity($productProcess, $this->request->getData());
        $productProcess = $productProcesses->save($productProcess);
        if (false !== $productProcess) {
            $this->Flash->success(__('The product process has been saved.'));
        } else {
            $this->Flash->error(__('The product process could not be saved. Please, try again.'));
        }

        return $this->redirect(['controller' => 'OrderProducts', 'action' => 'view', h($productProcess->order_product_id)]);
    }

    public function changeStatus(ProductProcessesService $productProcesses, $id)
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $productProcess = $this->ProductProcesses->findById($id)
            ->firstOrFail();

        $productProcess = $this->ProductProcesses->patchEntity($productProcess, $this->request->getData());
        if ($productProcesses->changeStatus($productProcess)) {
            $this->Flash->success(__('Product process status changed.'));
        } else {
            $this->Flash->error(__('Product process status not changed. Please, try again.'));
        }

        return $this->redirect(['controller' => 'OrderProducts', 'action' => 'view', h($productProcess->order_product_id)]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Product Process id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(OrdersService $orders, $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $productProcess = $this->ProductProcesses->get($id);
        if ($this->ProductProcesses->delete($productProcess)) {
            $order = $this->getTableLocator()->get('Orders')->find()
                ->innerJoinWith('OrderProducts', function ($q) use ($productProcess) {
                    return $q->where([
                        'OrderProducts.id' => $productProcess->order_product_id
                    ]);
                })
                ->firstOrFail();

            $orders->status($order->id);
            $orders->cost($order->id);

            $this->Flash->success(__('The product process has been deleted.'));
        } else {
            $this->Flash->error(__('The product process could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'OrderProducts', 'action' => 'view', h($productProcess->order_product_id)]);
    }
}
