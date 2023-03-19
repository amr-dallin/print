<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;

/**
 * OpReceipts Controller
 *
 * @property \App\Model\Table\OpReceiptsTable $OpReceipts
 * @method \App\Model\Entity\OpReceipt[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OpReceiptsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $opReceipts = $this->OpReceipts->find();
        $this->set(compact('opReceipts'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod(['post']);
        $opReceipt = $this->OpReceipts->newEmptyEntity();
        $opReceipt = $this->OpReceipts->patchEntity($opReceipt, $this->request->getData());
        if ($this->OpReceipts->save($opReceipt)) {
            $this->Flash->success(__('The op receipt has been saved.'));
        } else {
            $this->Flash->error(__('The op receipt could not be saved. Please, try again.'));
        }
        
        return $this->redirect(['controller' => 'SystemicPages', 'action' => 'cashRegisterStatistics']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Op Receipt id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $opReceipt = $this->OpReceipts->get($id);
        if ($this->OpReceipts->delete($opReceipt)) {
            $this->Flash->success(__('The op receipt has been deleted.'));
        } else {
            $this->Flash->error(__('The op receipt could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
