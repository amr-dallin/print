<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;
use App\Service\ProcessConsumablesService;

/**
 * ProcessConsumables Controller
 *
 * @property \App\Model\Table\ProcessConsumablesTable $ProcessConsumables
 * @method \App\Model\Entity\ProcessConsumable[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProcessConsumablesController extends AppController
{
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add(ProcessConsumablesService $processConsumables, $productProcessId)
    {
        $this->request->allowMethod(['post']);

        $productProcess = $this->getTableLocator()->get('ProductProcesses')->get($productProcessId);
        $processConsumable = $this->ProcessConsumables->newEmptyEntity();
        $processConsumable = $this->ProcessConsumables->patchEntity($processConsumable, $this->request->getData());
        if ($processConsumables->save($processConsumable)) {
            $this->Flash->success(__('The process consumable has been saved.'));
        } else {
            $this->Flash->error(__('The process consumable could not be saved. Please, try again.'));
        }

        return $this->redirect(['controller' => 'OrderProducts', 'action' => 'view', $productProcess->order_product_id]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Process Consumable id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $processConsumable = $this->ProcessConsumables->get($id);
        if ($this->ProcessConsumables->delete($processConsumable)) {
            $this->Flash->success(__('The process consumable has been deleted.'));
        } else {
            $this->Flash->error(__('The process consumable could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
