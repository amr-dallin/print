<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;

/**
 * Actions Controller
 *
 * @property \App\Model\Table\ActionsTable $Actions
 * @method \App\Model\Entity\Action[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ActionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Units'],
        ];
        $actions = $this->paginate($this->Actions);

        $this->set(compact('actions'));
    }

    /**
     * View method
     *
     * @param string|null $id Action id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $action = $this->Actions->get($id, [
            'contain' => ['Units', 'ActionPrices'],
        ]);

        $actionPrice = $this->Actions->ActionPrices->newEmptyEntity();

        $this->set(compact('action', 'actionPrice'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $action = $this->Actions->newEmptyEntity();
        if ($this->request->is('post')) {
            $action = $this->Actions->patchEntity($action, $this->request->getData());
            if ($this->Actions->save($action)) {
                $this->Flash->success(__('The action has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The action could not be saved. Please, try again.'));
        }
        $units = $this->Actions->Units->find('list')->all();
        $this->set(compact('action', 'units'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Action id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $action = $this->Actions->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $action = $this->Actions->patchEntity($action, $this->request->getData());
            if ($this->Actions->save($action)) {
                $this->Flash->success(__('The action has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The action could not be saved. Please, try again.'));
        }
        $units = $this->Actions->Units->find('list', ['limit' => 200])->all();
        $this->set(compact('action', 'units'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Action id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $action = $this->Actions->get($id);
        if ($this->Actions->delete($action)) {
            $this->Flash->success(__('The action has been deleted.'));
        } else {
            $this->Flash->error(__('The action could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
