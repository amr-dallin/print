<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LaserMachineRates Model
 *
 * @property \App\Model\Table\LaserMachinesTable&\Cake\ORM\Association\BelongsTo $LaserMachines
 *
 * @method \App\Model\Entity\LaserMachineRate newEmptyEntity()
 * @method \App\Model\Entity\LaserMachineRate newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\LaserMachineRate[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LaserMachineRate get($primaryKey, $options = [])
 * @method \App\Model\Entity\LaserMachineRate findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\LaserMachineRate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LaserMachineRate[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\LaserMachineRate|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LaserMachineRate saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LaserMachineRate[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LaserMachineRate[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\LaserMachineRate[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LaserMachineRate[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LaserMachineRatesTable extends Table
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

        $this->setTable('laser_machine_rates');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('LaserMachines', [
            'foreignKey' => 'laser_machine_id',
            //'joinType' => 'INNER',
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
            ->nonNegativeInteger('laser_machine_id')
            ->notEmptyString('laser_machine_id');

        $validator
            ->numeric('default_pouring')
            ->requirePresence('default_pouring', 'create')
            ->notEmptyString('default_pouring');

        $validator
            ->numeric('default_size')
            ->requirePresence('default_size', 'create')
            ->notEmptyString('default_size');

        $validator
            ->decimal('toner_c_p')
            ->allowEmptyString('toner_c_p');

        $validator
            ->decimal('toner_m_p')
            ->allowEmptyString('toner_m_p');

        $validator
            ->decimal('toner_y_p')
            ->allowEmptyString('toner_y_p');

        $validator
            ->decimal('toner_k_p')
            ->requirePresence('toner_k_p', 'create')
            ->notEmptyString('toner_k_p');

        $validator
            ->decimal('drum_c_p')
            ->allowEmptyString('drum_c_p');

        $validator
            ->decimal('drum_m_p')
            ->allowEmptyString('drum_m_p');

        $validator
            ->decimal('drum_y_p')
            ->allowEmptyString('drum_y_p');

        $validator
            ->decimal('drum_k_p')
            ->requirePresence('drum_k_p', 'create')
            ->notEmptyString('drum_k_p');

        $validator
            ->decimal('developer_c_p')
            ->allowEmptyString('developer_c_p');

        $validator
            ->decimal('developer_m_p')
            ->allowEmptyString('developer_m_p');

        $validator
            ->decimal('developer_y_p')
            ->allowEmptyString('developer_y_p');

        $validator
            ->decimal('developer_k_p')
            ->requirePresence('developer_k_p', 'create')
            ->notEmptyString('developer_k_p');

        $validator
            ->numeric('extra')
            ->allowEmptyString('extra');

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
        $rules->add($rules->existsIn('laser_machine_id', 'LaserMachines'), ['errorField' => 'laser_machine_id']);

        return $rules;
    }

    public function findCurrent(Query $query, Array $options)
    {
        return $query->where([
            $this->aliasField('is_current') => true
        ]);
    }
}
