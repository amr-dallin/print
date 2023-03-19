<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;

/**
 * ProcessActions Controller
 *
 * @property \App\Model\Table\ProcessActionsTable $ProcessActions
 * @method \App\Model\Entity\ProcessAction[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProcessActionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ActionPrices', 'ProductProcesses'],
        ];
        $processActions = $this->paginate($this->ProcessActions);

        $this->set(compact('processActions'));
    }

    /**
     * View method
     *
     * @param string|null $id Process Action id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $processAction = $this->ProcessActions->get($id, [
            'contain' => ['ActionPrices', 'ProductProcesses'],
        ]);

        $this->set(compact('processAction'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $processAction = $this->ProcessActions->newEmptyEntity();
        if ($this->request->is('post')) {
            $processAction = $this->ProcessActions->patchEntity($processAction, $this->request->getData());
            if ($this->ProcessActions->save($processAction)) {
                $this->Flash->success(__('The process action has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The process action could not be saved. Please, try again.'));
        }
        $actionPrices = $this->ProcessActions->ActionPrices->find('list', ['limit' => 200])->all();
        $productProcesses = $this->ProcessActions->ProductProcesses->find('list', ['limit' => 200])->all();
        $this->set(compact('processAction', 'actionPrices', 'productProcesses'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Process Action id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $processAction = $this->ProcessActions->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $processAction = $this->ProcessActions->patchEntity($processAction, $this->request->getData());
            if ($this->ProcessActions->save($processAction)) {
                $this->Flash->success(__('The process action has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The process action could not be saved. Please, try again.'));
        }
        $actionPrices = $this->ProcessActions->ActionPrices->find('list', ['limit' => 200])->all();
        $productProcesses = $this->ProcessActions->ProductProcesses->find('list', ['limit' => 200])->all();
        $this->set(compact('processAction', 'actionPrices', 'productProcesses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Process Action id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $processAction = $this->ProcessActions->get($id);
        if ($this->ProcessActions->delete($processAction)) {
            $this->Flash->success(__('The process action has been deleted.'));
        } else {
            $this->Flash->error(__('The process action could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
