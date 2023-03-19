<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProcessPapers Model
 *
 * @property \App\Model\Table\PaperPricesTable&\Cake\ORM\Association\BelongsTo $PaperPrices
 * @property \App\Model\Table\ProductProcessesTable&\Cake\ORM\Association\BelongsTo $ProductProcesses
 *
 * @method \App\Model\Entity\ProcessPaper newEmptyEntity()
 * @method \App\Model\Entity\ProcessPaper newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ProcessPaper[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProcessPaper get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProcessPaper findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ProcessPaper patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProcessPaper[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProcessPaper|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProcessPaper saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProcessPaper[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProcessPaper[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProcessPaper[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProcessPaper[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ProcessPapersTable extends Table
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

        $this->setTable('process_papers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('PaperPrices', [
            'foreignKey' => 'paper_price_id',
            'joinType' => 'INNER',
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
            ->nonNegativeInteger('paper_price_id')
            ->notEmptyString('paper_price_id');

        $validator
            ->nonNegativeInteger('product_process_id')
            ->notEmptyString('product_process_id');

        $validator
            ->numeric('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmptyString('quantity');

        $validator
            ->decimal('cost_price')
            ->allowEmptyString('cost_price');

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
        $rules->add($rules->existsIn('paper_price_id', 'PaperPrices'), ['errorField' => 'paper_price_id']);
        $rules->add($rules->existsIn('product_process_id', 'ProductProcesses'), ['errorField' => 'product_process_id']);

        return $rules;
    }
}
