<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProcessLaserMachines Model
 *
 * @property \App\Model\Table\LaserMachineRatesTable&\Cake\ORM\Association\BelongsTo $LaserMachineRates
 * @property \App\Model\Table\ProductProcessesTable&\Cake\ORM\Association\BelongsTo $ProductProcesses
 *
 * @method \App\Model\Entity\ProcessLaserMachine newEmptyEntity()
 * @method \App\Model\Entity\ProcessLaserMachine newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ProcessLaserMachine[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProcessLaserMachine get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProcessLaserMachine findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ProcessLaserMachine patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProcessLaserMachine[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProcessLaserMachine|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProcessLaserMachine saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProcessLaserMachine[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProcessLaserMachine[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProcessLaserMachine[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProcessLaserMachine[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ProcessLaserMachinesTable extends Table
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

        $this->setTable('process_laser_machines');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('LaserMachineRates', [
            'foreignKey' => 'laser_machine_rate_id',
            //'joinType' => 'INNER',
        ]);
        $this->belongsTo('ProductProcesses', [
            'foreignKey' => 'product_process_id',
            'joinType' => 'INNER',
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
            ->nonNegativeInteger('laser_machine_rate_id')
            ->notEmptyString('laser_machine_rate_id');

        $validator
            ->nonNegativeInteger('product_process_id')
            ->notEmptyString('product_process_id');

        $validator
            ->nonNegativeInteger('number_of_copies')
            ->requirePresence('number_of_copies', 'create')
            ->notEmptyString('number_of_copies');

        $validator
            ->nonNegativeInteger('number_of_pages')
            ->requirePresence('number_of_pages', 'create')
            ->notEmptyString('number_of_pages');

        $validator
            ->nonNegativeInteger('width')
            ->requirePresence('width', 'create')
            ->notEmptyString('width');

        $validator
            ->nonNegativeInteger('height')
            ->requirePresence('height', 'create')
            ->notEmptyString('height');

        $validator
            ->scalar('print_type')
            ->requirePresence('print_type', 'create')
            ->notEmptyString('print_type');

        $validator
            ->numeric('pouring')
            ->requirePresence('pouring', 'create')
            ->notEmptyString('pouring');

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
        $rules->add($rules->existsIn('laser_machine_rate_id', 'LaserMachineRates'), ['errorField' => 'laser_machine_rate_id']);
        $rules->add($rules->existsIn('product_process_id', 'ProductProcesses'), ['errorField' => 'product_process_id']);

        return $rules;
    }
}
