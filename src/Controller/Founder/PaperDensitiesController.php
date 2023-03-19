<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;

/**
 * PaperDensities Controller
 *
 * @property \App\Model\Table\PaperDensitiesTable $PaperDensities
 * @method \App\Model\Entity\PaperDensity[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PaperDensitiesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $paperDensities = $this->paginate($this->PaperDensities);

        $this->set(compact('paperDensities'));
    }

    /**
     * View method
     *
     * @param string|null $id Paper Density id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $paperDensity = $this->PaperDensities->get($id, [
            'contain' => ['Papers'],
        ]);

        $this->set(compact('paperDensity'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $paperDensity = $this->PaperDensities->newEmptyEntity();
        if ($this->request->is('post')) {
            $paperDensity = $this->PaperDensities->patchEntity($paperDensity, $this->request->getData());
            if ($this->PaperDensities->save($paperDensity)) {
                $this->Flash->success(__('The paper density has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The paper density could not be saved. Please, try again.'));
        }
        $this->set(compact('paperDensity'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Paper Density id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $paperDensity = $this->PaperDensities->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $paperDensity = $this->PaperDensities->patchEntity($paperDensity, $this->request->getData());
            if ($this->PaperDensities->save($paperDensity)) {
                $this->Flash->success(__('The paper density has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The paper density could not be saved. Please, try again.'));
        }
        $this->set(compact('paperDensity'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Paper Density id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $paperDensity = $this->PaperDensities->get($id);
        if ($this->PaperDensities->delete($paperDensity)) {
            $this->Flash->success(__('The paper density has been deleted.'));
        } else {
            $this->Flash->error(__('The paper density could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
