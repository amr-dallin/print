<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OpCollections Model
 *
 * @property \App\Model\Table\OpServicesTable&\Cake\ORM\Association\HasMany $OpServices
 *
 * @method \App\Model\Entity\OpCollection newEmptyEntity()
 * @method \App\Model\Entity\OpCollection newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\OpCollection[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OpCollection get($primaryKey, $options = [])
 * @method \App\Model\Entity\OpCollection findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\OpCollection patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OpCollection[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\OpCollection|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OpCollection saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OpCollection[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\OpCollection[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\OpCollection[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\OpCollection[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class OpCollectionsTable extends Table
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

        $this->setTable('op_collections');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('OpServices', [
            'foreignKey' => 'op_collection_id',
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
            ->date('date_from')
            ->requirePresence('date_from', 'create')
            ->notEmptyDate('date_from');

        $validator
            ->date('date_to')
            ->requirePresence('date_to', 'create')
            ->notEmptyDate('date_to');

        $validator
            ->date('date_collection')
            ->allowEmptyDate('date_collection');

        $validator
            ->boolean('confirmed')
            ->notEmptyString('confirmed');

        $validator
            ->scalar('notes')
            ->allowEmptyString('notes');

        $validator
            ->dateTime('date_created')
            ->requirePresence('date_created', 'create')
            ->notEmptyDateTime('date_created');

        $validator
            ->dateTime('date_modified')
            ->allowEmptyDateTime('date_modified');

        return $validator;
    }
}
