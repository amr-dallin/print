<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;
use App\Service\PaperPricesService;

/**
 * PaperPrices Controller
 *
 * @property \App\Model\Table\PaperPricesTable $PaperPrices
 * @method \App\Model\Entity\PaperPrice[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PaperPricesController extends AppController
{
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add(PaperPricesService $paperPrices)
    {
        $this->request->allowMethod(['post']);
        $paperPrice = $this->PaperPrices->newEmptyEntity();
        $paperPrice = $this->PaperPrices->patchEntity($paperPrice, $this->request->getData());
        if ($paperPrices->save($paperPrice)) {
            $this->Flash->success(__('The paper price has been saved.'));
        } else {
            $this->Flash->error(__('The paper price could not be saved. Please, try again.'));
        }
        return $this->redirect(['controller' => 'Papers', 'action' => 'view', $paperPrice->paper_id]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Paper Price id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $paperPrice = $this->PaperPrices->get($id);
        if ($this->PaperPrices->delete($paperPrice)) {
            $this->Flash->success(__('The paper price has been deleted.'));
        } else {
            $this->Flash->error(__('The paper price could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
