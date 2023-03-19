<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LaserMachines Model
 *
 * @property \App\Model\Table\LaserMachineRatesTable&\Cake\ORM\Association\HasMany $LaserMachineRates
 *
 * @method \App\Model\Entity\LaserMachine newEmptyEntity()
 * @method \App\Model\Entity\LaserMachine newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\LaserMachine[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LaserMachine get($primaryKey, $options = [])
 * @method \App\Model\Entity\LaserMachine findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\LaserMachine patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LaserMachine[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\LaserMachine|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LaserMachine saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LaserMachine[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LaserMachine[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\LaserMachine[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LaserMachine[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LaserMachinesTable extends Table
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

        $this->setTable('laser_machines');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->hasMany('LaserMachineRates', [
            'foreignKey' => 'laser_machine_id',
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
            ->scalar('type')
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        $validator
            ->scalar('title')
            ->maxLength('title', 128)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->boolean('is_active')
            ->notEmptyString('is_active');

        return $validator;
    }

    public function findActive(Query $query, Array $options)
    {
        return $query->where([
            $this->aliasField('is_active') => true
        ]);
    }
}
