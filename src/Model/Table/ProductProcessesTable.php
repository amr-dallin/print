<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductProcesses Model
 *
 * @property \App\Model\Table\ContractorsTable&\Cake\ORM\Association\BelongsTo $Contractors
 * @property \App\Model\Table\OrderProductsTable&\Cake\ORM\Association\BelongsTo $OrderProducts
 * @property \App\Model\Table\ProcessActionsTable&\Cake\ORM\Association\HasMany $ProcessActions
 * @property \App\Model\Table\ProcessConsumablesTable&\Cake\ORM\Association\HasMany $ProcessConsumables
 * @property \App\Model\Table\ProcessLaserMachinesTable&\Cake\ORM\Association\HasMany $ProcessLaserMachines
 * @property \App\Model\Table\ProcessPapersTable&\Cake\ORM\Association\HasMany $ProcessPapers
 *
 * @method \App\Model\Entity\ProductProcess newEmptyEntity()
 * @method \App\Model\Entity\ProductProcess newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ProductProcess[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProductProcess get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProductProcess findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ProductProcess patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProductProcess[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProductProcess|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductProcess saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductProcess[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProductProcess[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProductProcess[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProductProcess[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ProductProcessesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('product_processes');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->belongsTo('Contractors', [
            'foreignKey' => 'contractor_id',
        ]);
        $this->belongsTo('OrderProducts', [
            'foreignKey' => 'order_product_id',
            'joinType' => 'INNER',
        ]);
        $this->hasOne('ProcessActions', [
            'foreignKey' => 'product_process_id',
            'dependent' => true
        ]);
        $this->hasMany('ProcessConnections', [
            'className' => 'ProcessConnections',
            'foreignKey' => 'process_id',
        ]);
        $this->hasMany('ProcessConsumables', [
            'foreignKey' => 'product_process_id',
            'dependent' => true
        ]);
        $this->hasOne('ProcessLaserMachines', [
            'foreignKey' => 'product_process_id',
            'dependent' => true
        ]);
        $this->hasMany('ProcessPapers', [
            'foreignKey' => 'product_process_id',
            'dependent' => true
        ]);

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'date_created' => 'new',
                    'date_modified' => 'always'
                ]
            ]
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->nonNegativeInteger('contractor_id')
            ->allowEmptyString('contractor_id');

        $validator
            ->nonNegativeInteger('order_product_id')
            ->notEmptyString('order_product_id');

        $validator
            ->scalar('type')
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        $validator
            ->scalar('group_type')
            ->requirePresence('group_type', 'create')
            ->notEmptyString('group_type');

        $validator
            ->scalar('unique_id')
            ->maxLength('unique_id', 13)
            ->requirePresence('unique_id', 'create')
            ->notEmptyString('unique_id')
            ->add('unique_id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('contractor_full_name')
            ->maxLength('contractor_full_name', 128)
            ->allowEmptyString('contractor_full_name');

        $validator
            ->scalar('contractor_telephone')
            ->maxLength('contractor_telephone', 45)
            ->allowEmptyString('contractor_telephone');

        $validator
            ->scalar('title')
            ->maxLength('title', 128)
            ->requirePresence('title', 'create')
            ->allowEmptyString('title');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->decimal('cost_price')
            ->allowEmptyString('cost_price');

        $validator
            ->scalar('status')
            ->notEmptyString('status');

        $validator
            ->scalar('status_message')
            ->allowEmptyString('status_message');

        $validator
            ->dateTime('date_completed')
            ->allowEmptyDateTime('date_completed');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['unique_id']), ['errorField' => 'unique_id']);
        $rules->add($rules->existsIn('contractor_id', 'Contractors'), ['errorField' => 'contractor_id']);
        $rules->add($rules->existsIn('order_product_id', 'OrderProducts'), ['errorField' => 'order_product_id']);

        return $rules;
    }
}
