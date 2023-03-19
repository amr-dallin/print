<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;

/**
 * Clients Controller
 *
 * @property \App\Model\Table\ClientsTable $Clients
 * @method \App\Model\Entity\Client[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientsController extends AppController
{
    /**
     * Index method
     *
     * @param string $type Client type.
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($type)
    {
        if (!in_array($type, ['1', '2'])) {
            throw new NotFoundException(__('Not found page.'));
        }
        $clients = $this->Clients->find()
            ->where(['Clients.type' => $type])
            ->contain([
                'Orders' => function ($q) {
                    return $q->find('notEstimated');
                },
                'Representatives.PhoneNumbers',
                'Users'
            ]);

        $this->set(compact('clients'));
    }

    /**
     * View method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $client = $this->Clients->findById($id)
            ->contain([
                'Orders' => function ($q) {
                    return $q->find('notEstimated')
                        ->contain('OrderProducts');
                },
                'Representatives.PhoneNumbers',
                'Users'
            ])
            ->firstOrFail();

        $this->set(compact('client'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $client = $this->Clients->newEmptyEntity();
        if ($this->request->is('post')) {
            $client = $this->Clients->patchEntity($client, $this->request->getData(), [
                'associated' => [
                    'Representatives' => [
                        'associated' => ['PhoneNumbers']
                    ]
                ]
            ]);

            if ($this->Clients->save($client)) {
                $this->Flash->success(__('The client has been saved.'));

                return $this->redirect(['action' => 'index', h($client->type)]);
            }
            $this->Flash->error(__('The client could not be saved. Please, try again.'));
        }
        $this->set(compact('client'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $client = $this->Clients->findById($id)
            ->contain([
                'Representatives.PhoneNumbers',
                'Users'
            ])
            ->firstOrFail();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $client = $this->Clients->patchEntity($client, $this->request->getData(), [
                'associated' => [
                    'Representatives' => [
                        'associated' => ['PhoneNumbers']
                    ]
                ]
            ]);

            if ($this->Clients->save($client)) {
                $this->Flash->success(__('The client has been saved.'));

                return $this->redirect(['action' => 'view', h($client->id)]);
            }
            $this->Flash->error(__('The client could not be saved. Please, try again.'));
        }
        $this->set(compact('client'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $client = $this->Clients->get($id);
        if ($this->Clients->delete($client)) {
            $this->Flash->success(__('The client has been deleted.'));
        } else {
            $this->Flash->error(__('The client could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
