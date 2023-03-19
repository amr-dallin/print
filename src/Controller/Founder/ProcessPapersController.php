<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;
use App\Service\ProcessPapersService;

/**
 * ProcessPapers Controller
 *
 * @property \App\Model\Table\ProcessPapersTable $ProcessPapers
 * @method \App\Model\Entity\ProcessPaper[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProcessPapersController extends AppController
{
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add(ProcessPapersService $processPapers, $productProcessId)
    {
        $this->request->allowMethod(['post', 'delete']);

        $productProcess = $this->getTableLocator()->get('ProductProcesses')->get($productProcessId);
        $processPaper = $this->ProcessPapers->newEmptyEntity();
        $processPaper = $this->ProcessPapers->patchEntity($processPaper, $this->request->getData());
        if ($processPapers->save($processPaper)) {
            $this->Flash->success(__('The process paper has been saved.'));   
        } else {
            $this->Flash->error(__('The process paper could not be saved. Please, try again.'));
        }

        return $this->redirect(['controller' => 'OrderProducts', 'action' => 'view', $productProcess->order_product_id]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Process Paper id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $processPaper = $this->ProcessPapers->get($id);
        if ($this->ProcessPapers->delete($processPaper)) {
            $this->Flash->success(__('The process paper has been deleted.'));
        } else {
            $this->Flash->error(__('The process paper could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
