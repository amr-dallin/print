<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Representatives Model
 *
 * @method \App\Model\Entity\Representative newEmptyEntity()
 * @method \App\Model\Entity\Representative newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Representative[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Representative get($primaryKey, $options = [])
 * @method \App\Model\Entity\Representative findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Representative patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Representative[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Representative|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Representative saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Representative[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Representative[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Representative[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Representative[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class RepresentativesTable extends Table
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

        $this->setTable('representatives');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'date_created' => 'new',
                    'date_modified' => 'always'
                ]
            ]
        ]);

        $this->addBehavior('PhoneNumbers');
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
            ->scalar('first_name')
            ->maxLength('first_name', 45)
            ->requirePresence('first_name', 'create')
            ->notEmptyString('first_name');

        $validator
            ->scalar('second_name')
            ->maxLength('second_name', 45)
            ->allowEmptyString('second_name');

        $validator
            ->scalar('sur_name')
            ->maxLength('sur_name', 45)
            ->allowEmptyString('sur_name');

        return $validator;
    }
}
