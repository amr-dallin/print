<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;

/**
 * ConsumableCategories Controller
 *
 * @property \App\Model\Table\ConsumableCategoriesTable $ConsumableCategories
 * @method \App\Model\Entity\ConsumableCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ConsumableCategoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $consumableCategories = $this->paginate($this->ConsumableCategories);

        $this->set(compact('consumableCategories'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $consumableCategory = $this->ConsumableCategories->newEmptyEntity();
        if ($this->request->is('post')) {
            $consumableCategory = $this->ConsumableCategories->patchEntity($consumableCategory, $this->request->getData());
            if ($this->ConsumableCategories->save($consumableCategory)) {
                $this->Flash->success(__('The consumable category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The consumable category could not be saved. Please, try again.'));
        }
        $this->set(compact('consumableCategory'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Consumable Category id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $consumableCategory = $this->ConsumableCategories->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $consumableCategory = $this->ConsumableCategories->patchEntity($consumableCategory, $this->request->getData());
            if ($this->ConsumableCategories->save($consumableCategory)) {
                $this->Flash->success(__('The consumable category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The consumable category could not be saved. Please, try again.'));
        }
        $this->set(compact('consumableCategory'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Consumable Category id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $consumableCategory = $this->ConsumableCategories->get($id);
        if ($this->ConsumableCategories->delete($consumableCategory)) {
            $this->Flash->success(__('The consumable category has been deleted.'));
        } else {
            $this->Flash->error(__('The consumable category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
