<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;
use App\Service\ConsumablePricesService;

/**
 * ConsumablePrices Controller
 *
 * @property \App\Model\Table\ConsumablePricesTable $ConsumablePrices
 * @method \App\Model\Entity\ConsumablePrice[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ConsumablePricesController extends AppController
{
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add(ConsumablePricesService $consumablePrices)
    {
        $this->request->allowMethod(['post']);
        $consumablePrice = $this->ConsumablePrices->newEmptyEntity();
        $consumablePrice = $this->ConsumablePrices->patchEntity($consumablePrice, $this->request->getData());
        if ($consumablePrices->save($consumablePrice)) {
            $this->Flash->success(__('The consumable price has been saved.'));
        } else {
            $this->Flash->error(__('The consumable price could not be saved. Please, try again.'));
        }
        return $this->redirect(['controller' => 'Consumables', 'action' => 'view', $consumablePrice->consumable_id]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Consumable Price id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $consumablePrice = $this->ConsumablePrices->get($id);
        if ($this->ConsumablePrices->delete($consumablePrice)) {
            $this->Flash->success(__('The consumable price has been deleted.'));
        } else {
            $this->Flash->error(__('The consumable price could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
