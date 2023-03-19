<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ConsumablePrices Model
 *
 * @property \App\Model\Table\ConsumablesTable&\Cake\ORM\Association\BelongsTo $Consumables
 * @property \App\Model\Table\ProcessConsumablesTable&\Cake\ORM\Association\HasMany $ProcessConsumables
 *
 * @method \App\Model\Entity\ConsumablePrice newEmptyEntity()
 * @method \App\Model\Entity\ConsumablePrice newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ConsumablePrice[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ConsumablePrice get($primaryKey, $options = [])
 * @method \App\Model\Entity\ConsumablePrice findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ConsumablePrice patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ConsumablePrice[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ConsumablePrice|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ConsumablePrice saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ConsumablePrice[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ConsumablePrice[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ConsumablePrice[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ConsumablePrice[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ConsumablePricesTable extends Table
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

        $this->setTable('consumable_prices');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Consumables', [
            'foreignKey' => 'consumable_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('ProcessConsumables', [
            'foreignKey' => 'consumable_price_id',
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
            ->nonNegativeInteger('consumable_id')
            ->notEmptyString('consumable_id');

        $validator
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmptyString('amount');

        $validator
            ->boolean('is_current')
            ->notEmptyString('is_current');

        $validator
            ->date('date_commited')
            ->requirePresence('date_commited', 'create')
            ->notEmptyDate('date_commited');

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
        $rules->add($rules->existsIn('consumable_id', 'Consumables'), ['errorField' => 'consumable_id']);

        return $rules;
    }

    public function findIsCurrent(Query $query, Array $options)
    {
        return $query->where([
            $this->aliasField('is_current') => true
        ]);
    }
}
