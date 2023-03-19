<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;

/**
 * PaperColors Controller
 *
 * @property \App\Model\Table\PaperColorsTable $PaperColors
 * @method \App\Model\Entity\PaperColor[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PaperColorsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $paperColors = $this->paginate($this->PaperColors);

        $this->set(compact('paperColors'));
    }

    /**
     * View method
     *
     * @param string|null $id Paper Color id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $paperColor = $this->PaperColors->get($id, [
            'contain' => ['Papers'],
        ]);

        $this->set(compact('paperColor'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $paperColor = $this->PaperColors->newEmptyEntity();
        if ($this->request->is('post')) {
            $paperColor = $this->PaperColors->patchEntity($paperColor, $this->request->getData());
            if ($this->PaperColors->save($paperColor)) {
                $this->Flash->success(__('The paper color has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The paper color could not be saved. Please, try again.'));
        }
        $this->set(compact('paperColor'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Paper Color id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $paperColor = $this->PaperColors->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $paperColor = $this->PaperColors->patchEntity($paperColor, $this->request->getData());
            if ($this->PaperColors->save($paperColor)) {
                $this->Flash->success(__('The paper color has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The paper color could not be saved. Please, try again.'));
        }
        $this->set(compact('paperColor'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Paper Color id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $paperColor = $this->PaperColors->get($id);
        if ($this->PaperColors->delete($paperColor)) {
            $this->Flash->success(__('The paper color has been deleted.'));
        } else {
            $this->Flash->error(__('The paper color could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
