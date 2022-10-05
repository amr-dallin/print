<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;
use Cake\Event\EventInterface;

/**
 * OpServices Controller
 *
 * @property \App\Model\Table\OpServicesTable $OpServices
 * @method \App\Model\Entity\OperationalPrintingService[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OpServicesController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $opServices = $this->paginate($this->OpServices);

        $this->set(compact('opServices'));
    }

    /**
     * View method
     *
     * @param string|null $id Operational Printing Service id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $opService = $this->OpServices->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('opService'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $opService = $this->OpServices->newEmptyEntity();
        if ($this->request->is('post')) {
            $opService = $this->OpServices->patchEntity($opService, $this->request->getData());
            if ($this->OpServices->save($opService)) {
                $this->Flash->success(__('The operational printing service has been saved.'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The operational printing service could not be saved. Please, try again.'));
        }
        $this->set(compact('opService'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Operational Printing Service id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $opService = $this->OpServices->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $opService = $this->OpServices->patchEntity($opService, $this->request->getData());
            if ($this->OpServices->save($opService)) {
                $this->Flash->success(__('The operational printing service has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The operational printing service could not be saved. Please, try again.'));
        }
        $this->set(compact('opService'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Operational Printing Service id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $opService = $this->OpServices->get($id);
        if ($this->OpServices->delete($opService)) {
            $this->Flash->success(__('The operational printing service has been deleted.'));
        } else {
            $this->Flash->error(__('The operational printing service could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
