<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ConsumableCategories Model
 *
 * @property \App\Model\Table\ConsumablesTable&\Cake\ORM\Association\HasMany $Consumables
 *
 * @method \App\Model\Entity\ConsumableCategory newEmptyEntity()
 * @method \App\Model\Entity\ConsumableCategory newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ConsumableCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ConsumableCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\ConsumableCategory findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ConsumableCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ConsumableCategory[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ConsumableCategory|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ConsumableCategory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ConsumableCategory[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ConsumableCategory[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ConsumableCategory[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ConsumableCategory[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ConsumableCategoriesTable extends Table
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

        $this->setTable('consumable_categories');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->hasMany('Consumables', [
            'foreignKey' => 'consumable_category_id',
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

        return $rules;
    }
}
