<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Contractors Model
 *
 * @property \App\Model\Table\OrderProductsTable&\Cake\ORM\Association\HasMany $OrderProducts
 * @property \App\Model\Table\OrdersTable&\Cake\ORM\Association\HasMany $Orders
 * @property \App\Model\Table\ProductProcessesTable&\Cake\ORM\Association\HasMany $ProductProcesses
 *
 * @method \App\Model\Entity\Contractor newEmptyEntity()
 * @method \App\Model\Entity\Contractor newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Contractor[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Contractor get($primaryKey, $options = [])
 * @method \App\Model\Entity\Contractor findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Contractor patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Contractor[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Contractor|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Contractor saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Contractor[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Contractor[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Contractor[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Contractor[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ContractorsTable extends Table
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

        $this->setTable('contractors');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->hasMany('OrderProducts', [
            'foreignKey' => 'contractor_id',
        ]);
        $this->hasMany('Orders', [
            'foreignKey' => 'contractor_id',
        ]);
        $this->hasMany('ProductProcesses', [
            'foreignKey' => 'contractor_id',
        ]);

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'date_created' => 'new',
                    'date_modified' => 'always'
                ]
            ]
        ]);

        $this->addBehavior('Representatives');
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
            ->notEmptyString('title');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        return $validator;
    }
}
