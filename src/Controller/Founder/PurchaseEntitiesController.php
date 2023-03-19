<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;

/**
 * PurchaseEntities Controller
 *
 * @property \App\Model\Table\PurchaseEntitiesTable $PurchaseEntities
 * @method \App\Model\Entity\PurchaseEntity[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PurchaseEntitiesController extends AppController
{
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod(['post']);
        $purchaseEntity = $this->PurchaseEntities->newEmptyEntity();
        $purchaseEntity = $this->PurchaseEntities->patchEntity($purchaseEntity, $this->request->getData());
        if ($this->PurchaseEntities->save($purchaseEntity)) {
            $this->Flash->success(__('The purchase entity has been saved.'));
        } else {
            $this->Flash->error(__('The purchase entity could not be saved. Please, try again.'));
        }
        return $this->redirect(['controller' => 'Purchases', 'action' => 'view', $purchaseEntity->purchase_id]);
    }

    /**
     * Edit method
     *
     * @param string|null $id Purchase Entity id.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $purchaseEntity = $this->PurchaseEntities->get($id);
        $purchaseEntity = $this->PurchaseEntities->patchEntity($purchaseEntity, $this->request->getData());
        if ($this->PurchaseEntities->save($purchaseEntity)) {
            $this->Flash->success(__('The purchase entity has been saved.'));
        } else {
            $this->Flash->error(__('The purchase entity could not be saved. Please, try again.'));
        }

        return $this->redirect(['controller' => 'Purchases', 'action' => 'view', $purchaseEntity->purchase_id]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchase Entity id.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $purchaseEntity = $this->PurchaseEntities->get($id);
        if ($this->PurchaseEntities->delete($purchaseEntity)) {
            $this->Flash->success(__('The purchase entity has been deleted.'));
        } else {
            $this->Flash->error(__('The purchase entity could not be deleted. Please, try again.'));
        }
        return $this->redirect(['controller' => 'Purchases', 'action' => 'view', $purchaseEntity->purchase_id]);
    }
}
