<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;

/**
 * ProcessLaserMachines Controller
 *
 * @property \App\Model\Table\ProcessLaserMachinesTable $ProcessLaserMachines
 * @method \App\Model\Entity\ProcessLaserMachine[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProcessLaserMachinesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['LaserMachineRates', 'ProductProcesses'],
        ];
        $processLaserMachines = $this->paginate($this->ProcessLaserMachines);

        $this->set(compact('processLaserMachines'));
    }

    /**
     * View method
     *
     * @param string|null $id Process Laser Machine id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $processLaserMachine = $this->ProcessLaserMachines->get($id, [
            'contain' => ['LaserMachineRates', 'ProductProcesses'],
        ]);

        $this->set(compact('processLaserMachine'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $processLaserMachine = $this->ProcessLaserMachines->newEmptyEntity();
        if ($this->request->is('post')) {
            $processLaserMachine = $this->ProcessLaserMachines->patchEntity($processLaserMachine, $this->request->getData());
            if ($this->ProcessLaserMachines->save($processLaserMachine)) {
                $this->Flash->success(__('The process laser machine has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The process laser machine could not be saved. Please, try again.'));
        }
        $laserMachineRates = $this->ProcessLaserMachines->LaserMachineRates->find('list', ['limit' => 200])->all();
        $productProcesses = $this->ProcessLaserMachines->ProductProcesses->find('list', ['limit' => 200])->all();
        $this->set(compact('processLaserMachine', 'laserMachineRates', 'productProcesses'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Process Laser Machine id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $processLaserMachine = $this->ProcessLaserMachines->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $processLaserMachine = $this->ProcessLaserMachines->patchEntity($processLaserMachine, $this->request->getData());
            if ($this->ProcessLaserMachines->save($processLaserMachine)) {
                $this->Flash->success(__('The process laser machine has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The process laser machine could not be saved. Please, try again.'));
        }
        $laserMachineRates = $this->ProcessLaserMachines->LaserMachineRates->find('list', ['limit' => 200])->all();
        $productProcesses = $this->ProcessLaserMachines->ProductProcesses->find('list', ['limit' => 200])->all();
        $this->set(compact('processLaserMachine', 'laserMachineRates', 'productProcesses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Process Laser Machine id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $processLaserMachine = $this->ProcessLaserMachines->get($id);
        if ($this->ProcessLaserMachines->delete($processLaserMachine)) {
            $this->Flash->success(__('The process laser machine has been deleted.'));
        } else {
            $this->Flash->error(__('The process laser machine could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
