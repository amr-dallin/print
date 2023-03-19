<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;

/**
 * LaserMachineRates Controller
 *
 * @property \App\Model\Table\LaserMachineRatesTable $LaserMachineRates
 * @method \App\Model\Entity\LaserMachineRate[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LaserMachineRatesController extends AppController
{
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod(['post']);
        $laserMachineRate = $this->LaserMachineRates->newEmptyEntity();
        $laserMachineRate = $this->LaserMachineRates->patchEntity($laserMachineRate, $this->request->getData());
        if ($this->LaserMachineRates->save($laserMachineRate)) {
            $this->Flash->success(__('The laser machine rate has been saved.'));
        } else {
            $this->Flash->error(__('The laser machine rate could not be saved. Please, try again.'));
        }

        return $this->redirect(['controller' => 'LaserMachines', 'action' => 'view', $laserMachineRate->laser_machine_id]);
    }

    /**
     * Edit method
     *
     * @param string|null $id Laser Machine Rate id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $laserMachineRate = $this->LaserMachineRates->get($id, [
            'contain' => [],
        ]);
        $laserMachineRate = $this->LaserMachineRates->patchEntity($laserMachineRate, $this->request->getData());
        if ($this->LaserMachineRates->save($laserMachineRate)) {
            $this->Flash->success(__('The laser machine rate has been saved.'));
        } else {
            $this->Flash->error(__('The laser machine rate could not be saved. Please, try again.'));
        }

        return $this->redirect(['controller' => 'LaserMachines', 'action' => 'view', $laserMachineRate->laser_machine_id]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Laser Machine Rate id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $laserMachineRate = $this->LaserMachineRates->get($id);
        if ($this->LaserMachineRates->delete($laserMachineRate)) {
            $this->Flash->success(__('The laser machine rate has been deleted.'));
        } else {
            $this->Flash->error(__('The laser machine rate could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'LaserMachines', 'action' => 'view', $laserMachineRate->laser_machine_id]);
    }
}
