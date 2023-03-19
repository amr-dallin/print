<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Consumables Model
 *
 * @property \App\Model\Table\ConsumableCategoriesTable&\Cake\ORM\Association\BelongsTo $ConsumableCategories
 * @property \App\Model\Table\UnitsTable&\Cake\ORM\Association\BelongsTo $Units
 *
 * @method \App\Model\Entity\Consumable newEmptyEntity()
 * @method \App\Model\Entity\Consumable newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Consumable[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Consumable get($primaryKey, $options = [])
 * @method \App\Model\Entity\Consumable findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Consumable patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Consumable[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Consumable|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Consumable saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Consumable[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Consumable[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Consumable[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Consumable[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ConsumablesTable extends Table
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

        $this->setTable('consumables');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->belongsTo('ConsumableCategories', [
            'foreignKey' => 'consumable_category_id',
        ]);
        $this->hasMany('ConsumablePrices');
        $this->hasMany('Expenses', [
            'foreignKey' => 'foreign_key',
            'conditions' => ['model' => $this->getAlias()]
        ]);
        $this->belongsTo('InitialUnits', [
            'className' => 'Units',
            'foreignKey' => 'initial_unit_id'
        ]);
        $this->hasMany('PurchaseEntities', [
            'foreignKey' => 'foreign_key',
            'conditions' => ['model' => $this->getAlias()]
        ]);
        $this->belongsTo('Units', [
            'foreignKey' => 'unit_id'
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
            ->nonNegativeInteger('consumable_category_id')
            ->notEmptyString('consumable_category_id');

        $validator
            ->nonNegativeInteger('initial_unit_id')
            ->notEmptyString('initial_unit_id');

        $validator
            ->nonNegativeInteger('unit_id')
            ->allowEmptyString('unit_id');

        $validator
            ->numeric('quantity')
            ->requirePresence('quantity', 'create')
            ->allowEmptyString('quantity');

        $validator
            ->scalar('type')
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        $validator
            ->scalar('title')
            ->maxLength('title', 128)
            ->requirePresence('title', 'create')
            ->notEmptyString('title')
            ->add('title', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

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
        $rules->add($rules->isUnique(['title']), ['errorField' => 'title']);
        $rules->add($rules->existsIn('consumable_category_id', 'ConsumableCategories'), ['errorField' => 'consumable_category_id']);
        $rules->add($rules->existsIn('initial_unit_id', 'Units'), ['errorField' => 'initial_unit_id']);
        $rules->add($rules->existsIn('unit_id', 'Units'), ['errorField' => 'unit_id']);

        return $rules;
    }

    public function findUsed(Query $query, Array $options)
    {
        return $query->where([
            $this->aliasField('type') => CONSUMABLES_TYPE_USED
        ]);
    }
}
