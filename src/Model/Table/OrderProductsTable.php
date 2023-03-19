<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrderProducts Model
 *
 * @property \App\Model\Table\ContractorsTable&\Cake\ORM\Association\BelongsTo $Contractors
 * @property \App\Model\Table\OrdersTable&\Cake\ORM\Association\BelongsTo $Orders
 * @property \App\Model\Table\ProductTypesTable&\Cake\ORM\Association\BelongsTo $ProductTypes
 * @property \App\Model\Table\ProductProcessesTable&\Cake\ORM\Association\HasMany $ProductProcesses
 *
 * @method \App\Model\Entity\OrderProduct newEmptyEntity()
 * @method \App\Model\Entity\OrderProduct newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\OrderProduct[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrderProduct get($primaryKey, $options = [])
 * @method \App\Model\Entity\OrderProduct findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\OrderProduct patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OrderProduct[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrderProduct|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrderProduct saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrderProduct[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\OrderProduct[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\OrderProduct[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\OrderProduct[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class OrderProductsTable extends Table
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

        $this->setTable('order_products');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->belongsTo('Contractors', [
            'foreignKey' => 'contractor_id',
        ]);
        $this->belongsTo('Orders', [
            'foreignKey' => 'order_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ProductTypes', [
            'foreignKey' => 'product_type_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('ProductProcesses', [
            'foreignKey' => 'order_product_id',
            'dependent' => true,
            'cascadeCallbacks' => true
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
            ->nonNegativeInteger('order_id')
            ->notEmptyString('order_id');

        $validator
            ->nonNegativeInteger('product_type_id')
            ->notEmptyString('product_type_id');

        $validator
            ->scalar('type')
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

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
            ->allowEmptyString('title');

        $validator
            ->numeric('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmptyString('quantity');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->decimal('cost_price')
            ->allowEmptyString('cost_price');

        $validator
            ->decimal('competitive_price')
            ->allowEmptyString('competitive_price');

        $validator
            ->decimal('profit_price')
            ->allowEmptyString('profit_price');

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
        $rules->add($rules->existsIn('order_id', 'Orders'), ['errorField' => 'order_id']);
        $rules->add($rules->existsIn('product_type_id', 'ProductTypes'), ['errorField' => 'product_type_id']);

        return $rules;
    }
}
