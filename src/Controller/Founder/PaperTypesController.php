<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;

/**
 * PaperTypes Controller
 *
 * @property \App\Model\Table\PaperTypesTable $PaperTypes
 * @method \App\Model\Entity\PaperType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PaperTypesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $paperTypes = $this->paginate($this->PaperTypes);

        $this->set(compact('paperTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Paper Type id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $paperType = $this->PaperTypes->get($id, [
            'contain' => ['Papers'],
        ]);

        $this->set(compact('paperType'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $paperType = $this->PaperTypes->newEmptyEntity();
        if ($this->request->is('post')) {
            $paperType = $this->PaperTypes->patchEntity($paperType, $this->request->getData());
            if ($this->PaperTypes->save($paperType)) {
                $this->Flash->success(__('The paper type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The paper type could not be saved. Please, try again.'));
        }
        $this->set(compact('paperType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Paper Type id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $paperType = $this->PaperTypes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $paperType = $this->PaperTypes->patchEntity($paperType, $this->request->getData());
            if ($this->PaperTypes->save($paperType)) {
                $this->Flash->success(__('The paper type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The paper type could not be saved. Please, try again.'));
        }
        $this->set(compact('paperType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Paper Type id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $paperType = $this->PaperTypes->get($id);
        if ($this->PaperTypes->delete($paperType)) {
            $this->Flash->success(__('The paper type has been deleted.'));
        } else {
            $this->Flash->error(__('The paper type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
