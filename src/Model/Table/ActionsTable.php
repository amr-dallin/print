<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Actions Model
 *
 * @property \App\Model\Table\UnitsTable&\Cake\ORM\Association\BelongsTo $Units
 * @property \App\Model\Table\ActionPricesTable&\Cake\ORM\Association\HasMany $ActionPrices
 *
 * @method \App\Model\Entity\Action newEmptyEntity()
 * @method \App\Model\Entity\Action newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Action[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Action get($primaryKey, $options = [])
 * @method \App\Model\Entity\Action findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Action patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Action[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Action|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Action saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Action[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Action[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Action[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Action[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ActionsTable extends Table
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

        $this->setTable('actions');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->belongsTo('Units', [
            'foreignKey' => 'unit_id',
            //'joinType' => 'INNER',
        ]);
        $this->hasMany('ActionPrices', [
            'foreignKey' => 'action_id',
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
            ->nonNegativeInteger('unit_id')
            ->notEmptyString('unit_id');

        $validator
            ->scalar('group_type')
            ->requirePresence('group_type', 'create')
            ->notEmptyString('group_type');

        $validator
            ->scalar('title')
            ->maxLength('title', 128)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

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
        $rules->add($rules->existsIn('unit_id', 'Units'), ['errorField' => 'unit_id']);

        return $rules;
    }

    public function findPrePrint(Query $query, Array $options)
    {
        return $query->where([
            $this->aliasField('group_type') => ACTIONS_GROUP_TYPE_PREPRESS
        ]);
    }

    public function findPostPrint(Query $query, Array $options)
    {
        return $query->where([
            $this->aliasField('group_type') => ACTIONS_GROUP_TYPE_POSTPRESS
        ]);
    }
}
