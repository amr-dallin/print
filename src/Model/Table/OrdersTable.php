<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\Database\Expression\QueryExpression;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Orders Model
 *
 * @property \App\Model\Table\ClientsTable&\Cake\ORM\Association\BelongsTo $Clients
 * @property \App\Model\Table\OrderProductsTable&\Cake\ORM\Association\HasMany $OrderProducts
 *
 * @method \App\Model\Entity\Order newEmptyEntity()
 * @method \App\Model\Entity\Order newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Order[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Order get($primaryKey, $options = [])
 * @method \App\Model\Entity\Order findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Order patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Order[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Order|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Order saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class OrdersTable extends Table
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

        $this->setTable('orders');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
        ]);
        $this->hasMany('OrderProducts', [
            'foreignKey' => 'order_id',
            'dependent' => true,
            'cascadeCallbacks' => true
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
            ->nonNegativeInteger('client_id')
            ->allowEmptyString('client_id');

        $validator
            ->scalar('unique_id')
            ->maxLength('unique_id', 13)
            ->requirePresence('unique_id', 'create')
            ->notEmptyString('unique_id')
            ->add('unique_id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('client_full_name')
            ->maxLength('client_full_name', 128)
            ->allowEmptyString('client_full_name');

        $validator
            ->scalar('client_telephone')
            ->maxLength('client_telephone', 45)
            ->allowEmptyString('client_telephone');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->decimal('cost_price')
            ->allowEmptyString('cost_price');

        $validator
            ->decimal('saved_price')
            ->allowEmptyString('saved_price');

        $validator
            ->decimal('profit_cost')
            ->allowEmptyString('profit_cost');

        $validator
            ->dateTime('date_deadline')
            ->allowEmptyDateTime('date_deadline');

        $validator
            ->dateTime('date_accepted')
            ->allowEmptyDateTime('date_accepted');

        $validator
            ->scalar('status')
            ->notEmptyString('status');

        $validator
            ->scalar('status_message')
            ->allowEmptyString('status_message');

        $validator
            ->dateTime('date_completed')
            ->allowEmptyDateTime('date_completed');

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
        $rules->add($rules->isUnique(['unique_id']), ['errorField' => 'unique_id']);
        $rules->add($rules->existsIn('client_id', 'Clients'), ['errorField' => 'client_id']);

        return $rules;
    }

    public function findEstimated(Query $query, Array $options)
    {
        return $query->where([
            $this->aliasField('status') => ORDERS_STATUS_ESTIMATED
        ]);
    }

    public function findNotEstimated(Query $query, Array $options)
    {
        return $query->where([
            $this->aliasField('status !=') => ORDERS_STATUS_ESTIMATED
        ]);
    }

    public function findInProgress(Query $query, Array $options)
    {
        return $query->where([
            $this->aliasField('status') => ORDERS_STATUS_IN_PROGRESS
        ]);
    }

    public function findStatementCompleted(Query $query, Array $options)
    {
        return $query->where([
            $this->aliasField('status') => ORDERS_STATUS_STATEMENT_COMPLETED
        ]);
    }

    public function findCompleted(Query $query, Array $options)
    {
        return $query->where([
            $this->aliasField('status') => ORDERS_STATUS_COMPLETED
        ]);
    }

    public function findProblem(Query $query, Array $options)
    {
        return $query->where([
            $this->aliasField('status') => ORDERS_STATUS_PROBLEM
        ]);
    }

    public function findWithCostPrice(Query $query, Array $options)
    {
        return $query->where([
            $this->aliasField('cost_price is not') => null
        ]);
    }

    public function findWithSavedPrice(Query $query, Array $options)
    {
        return $query->where([
            $this->aliasField('saved_price is not') => null
        ]);
    }

    public function findWithProfitCost(Query $query, Array $options)
    {
        return $query->where([
            $this->aliasField('profit_cost is not') => null
        ]);
    }

    public function findWithSavedPriceOrProfitCost(Query $query, Array $options)
    {
        return $query->where(function (QueryExpression $exp, Query $query) {
            return $exp->or([
                $this->aliasField('saved_price is not') => null,
                $this->aliasField('profit_cost is not') => null
            ]);
        });
    }
}
