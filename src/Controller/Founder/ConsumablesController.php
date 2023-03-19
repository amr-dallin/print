<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;

/**
 * Consumables Controller
 *
 * @property \App\Model\Table\ConsumablesTable $Consumables
 * @method \App\Model\Entity\Consumable[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ConsumablesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $consumables = $this->Consumables->find()
            ->contain(['ConsumableCategories', 'InitialUnits', 'Units']);

        $this->set(compact('consumables'));
    }

    /**
     * View method
     *
     * @param string|null $id Consumable id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $consumable = $this->Consumables->findById($id)
            ->contain([
                'ConsumableCategories',
                'ConsumablePrices',
                'Expenses',
                'InitialUnits',
                'PurchaseEntities.Purchases' => function ($q) {
                    return $q->find('approved')->contain('Suppliers');
                },
                'Units'
            ])
            ->firstOrFail();

        $consumablePrice = $this->Consumables->ConsumablePrices->newEmptyEntity();

        $this->set(compact('consumable', 'consumablePrice'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $consumable = $this->Consumables->newEmptyEntity();
        if ($this->request->is('post')) {
            $consumable = $this->Consumables->patchEntity($consumable, $this->request->getData());
            if ($this->Consumables->save($consumable)) {
                $this->Flash->success(__('The consumable has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The consumable could not be saved. Please, try again.'));
        }
        $initialUnits = $this->Consumables->Units->find('list');
        $consumableCategories = $this->Consumables->ConsumableCategories->find('list')->all();
        $units = $this->Consumables->Units->find('list')->all();
        $this->set(compact('initialUnits', 'consumable', 'consumableCategories', 'units'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Consumable id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $consumable = $this->Consumables->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $consumable = $this->Consumables->patchEntity($consumable, $this->request->getData());
            if ($this->Consumables->save($consumable)) {
                $this->Flash->success(__('The consumable has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The consumable could not be saved. Please, try again.'));
        }
        $initialUnits = $this->Consumables->Units->find('list');
        $consumableCategories = $this->Consumables->ConsumableCategories->find('list')->all();
        $units = $this->Consumables->Units->find('list')->all();
        $this->set(compact('initialUnits', 'consumable', 'consumableCategories', 'units'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Consumable id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $consumable = $this->Consumables->get($id);
        if ($this->Consumables->delete($consumable)) {
            $this->Flash->success(__('The consumable has been deleted.'));
        } else {
            $this->Flash->error(__('The consumable could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
