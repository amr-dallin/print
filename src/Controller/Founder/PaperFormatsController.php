<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;

/**
 * PaperFormats Controller
 *
 * @property \App\Model\Table\PaperFormatsTable $PaperFormats
 * @method \App\Model\Entity\PaperFormat[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PaperFormatsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $paperFormats = $this->paginate($this->PaperFormats);

        $this->set(compact('paperFormats'));
    }

    /**
     * View method
     *
     * @param string|null $id Paper Format id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $paperFormat = $this->PaperFormats->get($id, [
            'contain' => ['Papers'],
        ]);

        $this->set(compact('paperFormat'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $paperFormat = $this->PaperFormats->newEmptyEntity();
        if ($this->request->is('post')) {
            $paperFormat = $this->PaperFormats->patchEntity($paperFormat, $this->request->getData());
            if ($this->PaperFormats->save($paperFormat)) {
                $this->Flash->success(__('The paper format has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The paper format could not be saved. Please, try again.'));
        }
        $this->set(compact('paperFormat'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Paper Format id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $paperFormat = $this->PaperFormats->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $paperFormat = $this->PaperFormats->patchEntity($paperFormat, $this->request->getData());
            if ($this->PaperFormats->save($paperFormat)) {
                $this->Flash->success(__('The paper format has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The paper format could not be saved. Please, try again.'));
        }
        $this->set(compact('paperFormat'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Paper Format id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $paperFormat = $this->PaperFormats->get($id);
        if ($this->PaperFormats->delete($paperFormat)) {
            $this->Flash->success(__('The paper format has been deleted.'));
        } else {
            $this->Flash->error(__('The paper format could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
