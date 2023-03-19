<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProcessConnections Model
 *
 * @property \App\Model\Table\ProcessConnectionsTable&\Cake\ORM\Association\BelongsTo $ParentProcessConnections
 * @property \App\Model\Table\ProductProcessesTable&\Cake\ORM\Association\BelongsTo $ProductProcesses
 * @property \App\Model\Table\ProcessConnectionsTable&\Cake\ORM\Association\HasMany $ChildProcessConnections
 *
 * @method \App\Model\Entity\ProcessConnection newEmptyEntity()
 * @method \App\Model\Entity\ProcessConnection newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ProcessConnection[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProcessConnection get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProcessConnection findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ProcessConnection patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProcessConnection[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProcessConnection|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProcessConnection saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProcessConnection[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProcessConnection[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProcessConnection[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProcessConnection[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ProcessConnectionsTable extends Table
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

        $this->setTable('process_connections');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('ParentProcesses', [
            'className' => 'ProductProcesses',
            'foreignKey' => 'parent_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ProductProcesses', [
            'className' => 'ProductProcesses',
            'foreignKey' => 'process_id',
            'joinType' => 'INNER',
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
            ->nonNegativeInteger('parent_id')
            ->notEmptyString('parent_id');

        $validator
            ->nonNegativeInteger('process_id')
            ->notEmptyString('process_id');

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
        $rules->add($rules->existsIn('parent_id', 'ParentProcessConnections'), ['errorField' => 'parent_id']);
        $rules->add($rules->existsIn('process_id', 'ProductProcesses'), ['errorField' => 'process_id']);

        return $rules;
    }
}
