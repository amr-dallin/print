<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;
use App\Service\ActionPricesService;

/**
 * ActionPrices Controller
 *
 * @property \App\Model\Table\ActionPricesTable $ActionPrices
 * @method \App\Model\Entity\ActionPrice[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ActionPricesController extends AppController
{
        /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add(ActionPricesService $actionPrices)
    {
        $this->request->allowMethod(['post']);
        $actionPrice = $this->ActionPrices->newEmptyEntity();
        $actionPrice = $this->ActionPrices->patchEntity($actionPrice, $this->request->getData());
        if ($actionPrices->save($actionPrice)) {
            $this->Flash->success(__('The action price has been saved.'));
        } else {
            $this->Flash->error(__('The action price could not be saved. Please, try again.'));
        }
        return $this->redirect(['controller' => 'Actions', 'action' => 'view', $actionPrice->action_id]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Action Price id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $actionPrice = $this->ActionPrices->get($id);
        if ($this->ActionPrices->delete($actionPrice)) {
            $this->Flash->success(__('The action price has been deleted.'));
        } else {
            $this->Flash->error(__('The action price could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
