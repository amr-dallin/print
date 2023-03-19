<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ActionPrices Model
 *
 * @property \App\Model\Table\ActionsTable&\Cake\ORM\Association\BelongsTo $Actions
 * @property \App\Model\Table\ProcessActionsTable&\Cake\ORM\Association\HasMany $ProcessActions
 *
 * @method \App\Model\Entity\ActionPrice newEmptyEntity()
 * @method \App\Model\Entity\ActionPrice newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ActionPrice[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ActionPrice get($primaryKey, $options = [])
 * @method \App\Model\Entity\ActionPrice findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ActionPrice patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ActionPrice[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ActionPrice|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ActionPrice saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ActionPrice[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ActionPrice[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ActionPrice[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ActionPrice[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ActionPricesTable extends Table
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

        $this->setTable('action_prices');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Actions', [
            'foreignKey' => 'action_id',
            //'joinType' => 'INNER',
        ]);
        $this->hasMany('ProcessActions', [
            'foreignKey' => 'action_price_id',
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
            ->nonNegativeInteger('action_id')
            ->notEmptyString('action_id');

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
        $rules->add($rules->existsIn('action_id', 'Actions'), ['errorField' => 'action_id']);

        return $rules;
    }

    public function findIsCurrent(Query $query, Array $options)
    {
        return $query->where([
            $this->aliasField('is_current') => true
        ]);
    }
}
