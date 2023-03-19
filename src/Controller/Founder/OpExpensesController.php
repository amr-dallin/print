<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;

/**
 * OpExpenses Controller
 *
 * @property \App\Model\Table\OpExpensesTable $OpExpenses
 * @method \App\Model\Entity\OpExpense[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OpExpensesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $opExpenses = $this->OpExpenses->find();
        $this->set(compact('opExpenses'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod(['post']);
        $opExpense = $this->OpExpenses->newEmptyEntity();
        $opExpense = $this->OpExpenses->patchEntity($opExpense, $this->request->getData());
        if ($this->OpExpenses->save($opExpense)) {
            $this->Flash->success(__('The op expense has been saved.'));
        } else {
            $this->Flash->error(__('The op expense could not be saved. Please, try again.'));
        }

        return $this->redirect(['controller' => 'SystemicPages', 'action' => 'cashRegisterStatistics']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Op Expense id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $opExpense = $this->OpExpenses->get($id);
        if ($this->OpExpenses->delete($opExpense)) {
            $this->Flash->success(__('The op expense has been deleted.'));
        } else {
            $this->Flash->error(__('The op expense could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
