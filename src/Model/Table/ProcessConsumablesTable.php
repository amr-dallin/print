<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProcessConsumables Model
 *
 * @property \App\Model\Table\ConsumablePricesTable&\Cake\ORM\Association\BelongsTo $ConsumablePrices
 * @property \App\Model\Table\ProductProcessesTable&\Cake\ORM\Association\BelongsTo $ProductProcesses
 *
 * @method \App\Model\Entity\ProcessConsumable newEmptyEntity()
 * @method \App\Model\Entity\ProcessConsumable newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ProcessConsumable[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProcessConsumable get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProcessConsumable findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ProcessConsumable patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProcessConsumable[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProcessConsumable|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProcessConsumable saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProcessConsumable[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProcessConsumable[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProcessConsumable[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProcessConsumable[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ProcessConsumablesTable extends Table
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

        $this->setTable('process_consumables');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('ConsumablePrices', [
            'foreignKey' => 'consumable_price_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ProductProcesses', [
            'foreignKey' => 'product_process_id',
            'joinType' => 'INNER',
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
            ->nonNegativeInteger('consumable_price_id')
            ->notEmptyString('consumable_price_id');

        $validator
            ->nonNegativeInteger('product_process_id')
            ->notEmptyString('product_process_id');

        $validator
            ->numeric('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmptyString('quantity');

        $validator
            ->decimal('cost_price')
            ->allowEmptyString('cost_price');

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
        $rules->add($rules->existsIn('consumable_price_id', 'ConsumablePrices'), ['errorField' => 'consumable_price_id']);
        $rules->add($rules->existsIn('product_process_id', 'ProductProcesses'), ['errorField' => 'product_process_id']);

        return $rules;
    }
}
