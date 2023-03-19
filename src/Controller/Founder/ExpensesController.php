<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;
use App\Service\ExpensesService;

/**
 * Expenses Controller
 *
 * @property \App\Model\Table\ExpensesTable $Expenses
 * @method \App\Model\Entity\Expense[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ExpensesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index(ExpensesService $expenses)
    {
        $expense = $this->Expenses->newEmptyEntity();
        $expenses = $expenses->getRange($this->request->getQuery('range'));

        $consumables = $this->getTableLocator()->get('Consumables')
            ->find('list', [
                'valueField' => 'full_name'
            ])
            ->contain('ConsumableCategories');

        $papers = $this->getTableLocator()->get('Papers')
            ->find('list', [
                'valueField' => 'full_name'
            ])
            ->contain(['PaperDensities', 'PaperFormats']);

        $this->set(compact('consumables', 'expense', 'expenses', 'papers'));
    }

    /**
     * View method
     *
     * @param string|null $id Expense id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $expense = $this->Expenses->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('expense'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod(['post']);
        $expense = $this->Expenses->newEmptyEntity();
        $expense = $this->Expenses->patchEntity($expense, $this->request->getData());

        if ($this->Expenses->save($expense)) {
            $this->Flash->success(__('The expense has been saved.'));
        } else {
            $this->Flash->error(__('The expense could not be saved. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Expense id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $expense = $this->Expenses->get($id);
        $expense = $this->Expenses->patchEntity($expense, $this->request->getData());
        if ($this->Expenses->save($expense)) {
            $this->Flash->success(__('The expense has been saved.'));
        } else {
            $this->Flash->error(__('The expense could not be saved. Please, try again.'));
        }
    
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Expense id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $expense = $this->Expenses->get($id);
        if ($this->Expenses->delete($expense)) {
            $this->Flash->success(__('The expense has been deleted.'));
        } else {
            $this->Flash->error(__('The expense could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
