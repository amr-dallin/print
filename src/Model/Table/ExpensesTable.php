<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Expenses Model
 *
 * @method \App\Model\Entity\Expense newEmptyEntity()
 * @method \App\Model\Entity\Expense newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Expense[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Expense get($primaryKey, $options = [])
 * @method \App\Model\Entity\Expense findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Expense patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Expense[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Expense|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Expense saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Expense[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Expense[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Expense[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Expense[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ExpensesTable extends Table
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

        $this->setTable('expenses');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Consumables')
            ->setForeignKey('foreign_key');

        $this->belongsTo('Papers', [
            'foreignKey' => 'foreign_key',
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
            ->requirePresence('foreign_key', 'create')
            ->notEmptyString('foreign_key');

        $validator
            ->scalar('model')
            ->maxLength('model', 128)
            ->requirePresence('model', 'create')
            ->notEmptyString('model');

        $validator
            ->numeric('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmptyString('quantity');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->date('date_expensed')
            ->requirePresence('date_expensed', 'create')
            ->notEmptyDate('date_expensed');

        return $validator;
    }
}
