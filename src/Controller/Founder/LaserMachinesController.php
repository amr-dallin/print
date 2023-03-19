<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;
use App\Service\LaserMachinesService;

/**
 * LaserMachines Controller
 *
 * @property \App\Model\Table\LaserMachinesTable $LaserMachines
 * @method \App\Model\Entity\LaserMachine[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LaserMachinesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $laserMachines = $this->LaserMachines->find();

        $this->set(compact('laserMachines'));
    }

    /**
     * View method
     *
     * @param string|null $id Laser Machine id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $laserMachine = $this->LaserMachines->get($id, [
            'contain' => ['LaserMachineRates'],
        ]);

        $laserMachineRate = $this->LaserMachines->LaserMachineRates->newEmptyEntity();

        $this->set(compact('laserMachine', 'laserMachineRate'));
    }

    public function calculate($id, LaserMachinesService $laserMachines)
    {
        $this->request->allowMethod(['post']);
        $laserMachine = $this->LaserMachines->findById($id)
            ->find('active')
            ->innerJoinWith('LaserMachineRates', function ($q) {
                return $q->find('current');
            })
            ->contain('LaserMachineRates')
            ->firstOrFail();

        $result = $laserMachines->calculate($laserMachine, $this->request->getData());
        $this->set('result', $result);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $laserMachine = $this->LaserMachines->newEmptyEntity();
        if ($this->request->is('post')) {
            $laserMachine = $this->LaserMachines->patchEntity($laserMachine, $this->request->getData());
            if ($this->LaserMachines->save($laserMachine)) {
                $this->Flash->success(__('The laser machine has been saved.'));

                return $this->redirect(['action' => 'view', $laserMachine->id]);
            }
            $this->Flash->error(__('The laser machine could not be saved. Please, try again.'));
        }
        $this->set(compact('laserMachine'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Laser Machine id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $laserMachine = $this->LaserMachines->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $laserMachine = $this->LaserMachines->patchEntity($laserMachine, $this->request->getData());
            if ($this->LaserMachines->save($laserMachine)) {
                $this->Flash->success(__('The laser machine has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The laser machine could not be saved. Please, try again.'));
        }
        $this->set(compact('laserMachine'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Laser Machine id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $laserMachine = $this->LaserMachines->get($id);
        if ($this->LaserMachines->delete($laserMachine)) {
            $this->Flash->success(__('The laser machine has been deleted.'));
        } else {
            $this->Flash->error(__('The laser machine could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
