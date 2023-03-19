<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;

/**
 * Papers Controller
 *
 * @property \App\Model\Table\PapersTable $Papers
 * @method \App\Model\Entity\Paper[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PapersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $papers = $this->Papers->find()
            ->contain(['InitialUnits', 'PaperColors', 'PaperDensities', 'PaperFormats', 'PaperTypes', 'Units']);

        $this->set(compact('papers'));
    }

    /**
     * View method
     *
     * @param string|null $id Paper id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $paper = $this->Papers->findById($id)
            ->contain([
                'PaperColors',
                'PaperDensities',
                'PaperFormats',
                'PaperPrices',
                'PaperTypes',
                'Expenses',
                'InitialUnits',
                'PurchaseEntities.Purchases' => function ($q) {
                    return $q->find('approved')->contain('Suppliers');
                },
                'Units'
            ])
            ->firstOrFail();

        $paperPrice = $this->Papers->PaperPrices->newEmptyEntity();

        $this->set(compact('paper', 'paperPrice'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $paper = $this->Papers->newEmptyEntity();
        if ($this->request->is('post')) {
            $paper = $this->Papers->patchEntity($paper, $this->request->getData());
            if ($this->Papers->save($paper)) {
                $this->Flash->success(__('The paper has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The paper could not be saved. Please, try again.'));
        }
        $initialUnits = $this->Papers->Units->find('list');
        $paperColors = $this->Papers->PaperColors->find('list');
        $paperDensities = $this->Papers->PaperDensities->find('list');
        $paperFormats = $this->Papers->PaperFormats->find('list', [
            'keyField' => 'id',
            'valueField' => 'full_name'
        ]);
        $paperTypes = $this->Papers->PaperTypes->find('list');
        $units = $this->Papers->Units->find('list');
        $this->set(compact('initialUnits', 'paper', 'paperColors', 'paperDensities', 'paperFormats', 'paperTypes', 'units'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Paper id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $paper = $this->Papers->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $paper = $this->Papers->patchEntity($paper, $this->request->getData());
            if ($this->Papers->save($paper)) {
                $this->Flash->success(__('The paper has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The paper could not be saved. Please, try again.'));
        }
        $initialUnits = $this->Papers->Units->find('list');
        $paperColors = $this->Papers->PaperColors->find('list');
        $paperDensities = $this->Papers->PaperDensities->find('list');
        $paperFormats = $this->Papers->PaperFormats->find('list', [
            'keyField' => 'id',
            'valueField' => 'full_name'
        ]);
        $paperTypes = $this->Papers->PaperTypes->find('list');
        $units = $this->Papers->Units->find('list');
        $this->set(compact('initialUnits', 'paper', 'paperColors', 'paperDensities', 'paperFormats', 'paperTypes', 'units'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Paper id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $paper = $this->Papers->get($id);
        if ($this->Papers->delete($paper)) {
            $this->Flash->success(__('The paper has been deleted.'));
        } else {
            $this->Flash->error(__('The paper could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
