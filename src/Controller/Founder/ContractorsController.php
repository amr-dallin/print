<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;

/**
 * Contractors Controller
 *
 * @property \App\Model\Table\ContractorsTable $Contractors
 * @method \App\Model\Entity\Contractor[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContractorsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $contractors = $this->Contractors->find()
            ->contain([
                'Representatives.PhoneNumbers'
            ]);

        $this->set(compact('contractors'));
    }

    /**
     * View method
     *
     * @param string|null $id Contractor id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contractor = $this->Contractors->findById($id)
            ->contain([
                'Representatives.PhoneNumbers'
            ])
            ->firstOrFail();

        $this->set(compact('contractor'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contractor = $this->Contractors->newEmptyEntity();
        if ($this->request->is('post')) {
            $contractor = $this->Contractors->patchEntity($contractor, $this->request->getData(), [
                'associated' => [
                    'Representatives' => [
                        'associated' => ['PhoneNumbers']
                    ]
                ]
            ]);
            if ($this->Contractors->save($contractor)) {
                $this->Flash->success(__('The contractor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contractor could not be saved. Please, try again.'));
        }
        $this->set(compact('contractor'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Contractor id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contractor = $this->Contractors->findById($id)
            ->contain([
                'Representatives.PhoneNumbers'
            ])
            ->firstOrFail();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $contractor = $this->Contractors->patchEntity($contractor, $this->request->getData(), [
                'associated' => [
                    'Representatives' => [
                        'associated' => ['PhoneNumbers']
                    ]
                ]
            ]);
            if ($this->Contractors->save($contractor)) {
                $this->Flash->success(__('The contractor has been saved.'));

                return $this->redirect(['action' => 'view', h($contractor->id)]);
            }
            $this->Flash->error(__('The contractor could not be saved. Please, try again.'));
        }
        $this->set(compact('contractor'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Contractor id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contractor = $this->Contractors->get($id);
        if ($this->Contractors->delete($contractor)) {
            $this->Flash->success(__('The contractor has been deleted.'));
        } else {
            $this->Flash->error(__('The contractor could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
