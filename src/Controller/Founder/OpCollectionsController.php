<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;

/**
 * OpCollections Controller
 *
 * @property \App\Model\Table\OpCollectionsTable $OpCollections
 * @method \App\Model\Entity\OpCollection[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OpCollectionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $opCollections = $this->paginate($this->OpCollections);

        $this->set(compact('opCollections'));
    }

    /**
     * View method
     *
     * @param string|null $id Op Collection id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $opCollection = $this->OpCollections->get($id, [
            'contain' => ['OpServices'],
        ]);

        $this->set(compact('opCollection'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $opCollection = $this->OpCollections->newEmptyEntity();
        if ($this->request->is('post')) {
            $opCollection = $this->OpCollections->patchEntity($opCollection, $this->request->getData());
            if ($this->OpCollections->save($opCollection)) {
                $this->Flash->success(__('The op collection has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The op collection could not be saved. Please, try again.'));
        }
        $this->set(compact('opCollection'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Op Collection id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $opCollection = $this->OpCollections->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $opCollection = $this->OpCollections->patchEntity($opCollection, $this->request->getData());
            if ($this->OpCollections->save($opCollection)) {
                $this->Flash->success(__('The op collection has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The op collection could not be saved. Please, try again.'));
        }
        $this->set(compact('opCollection'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Op Collection id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $opCollection = $this->OpCollections->get($id);
        if ($this->OpCollections->delete($opCollection)) {
            $this->Flash->success(__('The op collection has been deleted.'));
        } else {
            $this->Flash->error(__('The op collection could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
