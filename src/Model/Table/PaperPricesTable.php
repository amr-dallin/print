<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PaperPrices Model
 *
 * @property \App\Model\Table\PapersTable&\Cake\ORM\Association\BelongsTo $Papers
 * @property \App\Model\Table\ProcessPapersTable&\Cake\ORM\Association\HasMany $ProcessPapers
 *
 * @method \App\Model\Entity\PaperPrice newEmptyEntity()
 * @method \App\Model\Entity\PaperPrice newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PaperPrice[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PaperPrice get($primaryKey, $options = [])
 * @method \App\Model\Entity\PaperPrice findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PaperPrice patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PaperPrice[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PaperPrice|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PaperPrice saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PaperPrice[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PaperPrice[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PaperPrice[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PaperPrice[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PaperPricesTable extends Table
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

        $this->setTable('paper_prices');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Papers', [
            'foreignKey' => 'paper_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('ProcessPapers', [
            'foreignKey' => 'paper_price_id',
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
            ->nonNegativeInteger('paper_id')
            ->notEmptyString('paper_id');

        $validator
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmptyString('amount');

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
        $rules->add($rules->existsIn('paper_id', 'Papers'), ['errorField' => 'paper_id']);

        return $rules;
    }

    public function findIsCurrent(Query $query, Array $options)
    {
        return $query->where([
            $this->aliasField('is_current') => true
        ]);
    }
}
