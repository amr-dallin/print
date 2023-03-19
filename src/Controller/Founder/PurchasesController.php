<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;
use App\Service\PurchasesService;
use Cake\Http\Exception\BadRequestException;

/**
 * Purchases Controller
 *
 * @property \App\Model\Table\PurchasesTable $Purchases
 * @method \App\Model\Entity\Purchase[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PurchasesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index(PurchasesService $purchases)
    {
        $purchases = $purchases->getRange($this->request->getQuery('range'));
        $this->set(compact('purchases'));
    }

    /**
     * View method
     *
     * @param string|null $id Purchase id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $purchase = $this->Purchases->get($id, [
            'contain' => [
                'Suppliers',
                'PurchaseEntities' => [
                    'Consumables' => [
                        'ConsumableCategories',
                        'Units'
                    ],
                    'Papers' => [
                        'InitialUnits',
                        'PaperColors',
                        'PaperDensities',
                        'PaperFormats',
                        'PaperTypes',
                        'Units'
                    ]
                ]
            ]
        ]);

        $consumables = $this->getTableLocator()->get('Consumables')
            ->find('list', [
                'valueField' => 'full_name'
            ])
            ->contain('ConsumableCategories');

        $papers = $this->getTableLocator()->get('Papers')
            ->find('list', [
                'valueField' => 'full_name'
            ])
            ->contain(['PaperDensities', 'PaperFormats']);

        $purchaseEntity = $this->getTableLocator()->get('PurchaseEntities')->newEmptyEntity();

        $this->set(compact('consumables', 'papers', 'purchase', 'purchaseEntity'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $purchase = $this->Purchases->newEmptyEntity();
        if ($this->request->is('post')) {
            $purchase = $this->Purchases->patchEntity($purchase, $this->request->getData());
            if ($this->Purchases->save($purchase)) {
                $this->Flash->success(__('The purchase has been saved.'));

                return $this->redirect(['action' => 'view', $purchase->id]);
            }
            $this->Flash->error(__('The purchase could not be saved. Please, try again.'));
        }

        $suppliers = $this->Purchases->Suppliers->find('list');
        $this->set(compact('purchase', 'suppliers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Purchase id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $purchase = $this->Purchases->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchase = $this->Purchases->patchEntity($purchase, $this->request->getData());
            if ($this->Purchases->save($purchase)) {
                $this->Flash->success(__('The purchase has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase could not be saved. Please, try again.'));
        }
        $suppliers = $this->Purchases->Suppliers->find('list', ['limit' => 200])->all();
        $this->set(compact('purchase', 'suppliers'));
    }

    public function approve($id, PurchasesService $purchases)
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $purchase = $this->Purchases
            ->findById($id)
            ->find('notApproved')
            ->contain('PurchaseEntities')
            ->first();

        if (empty($purchase)) {
            throw new BadRequestException(__('Bad request!'));
        }

        $purchase = $this->Purchases->patchEntity($purchase, $this->request->getData());
        if ($purchases->approve($purchase)) {
            $this->Flash->success(__('Purchase approved.'));
        } else {
            $this->Flash->error(__('Purchase not approved. Please, try again.'));
        }
        
        return $this->redirect(['action' => 'view', $id]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchase id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $purchase = $this->Purchases->get($id);
        if ($this->Purchases->delete($purchase)) {
            $this->Flash->success(__('The purchase has been deleted.'));
        } else {
            $this->Flash->error(__('The purchase could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
