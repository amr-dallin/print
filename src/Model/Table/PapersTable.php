<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Papers Model
 *
 * @property \App\Model\Table\PaperColorsTable&\Cake\ORM\Association\BelongsTo $PaperColors
 * @property \App\Model\Table\PaperDensitiesTable&\Cake\ORM\Association\BelongsTo $PaperDensities
 * @property \App\Model\Table\PaperFormatsTable&\Cake\ORM\Association\BelongsTo $PaperFormats
 * @property \App\Model\Table\PaperTypesTable&\Cake\ORM\Association\BelongsTo $PaperTypes
 * @property \App\Model\Table\UnitsTable&\Cake\ORM\Association\BelongsTo $Units
 *
 * @method \App\Model\Entity\Paper newEmptyEntity()
 * @method \App\Model\Entity\Paper newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Paper[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Paper get($primaryKey, $options = [])
 * @method \App\Model\Entity\Paper findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Paper patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Paper[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Paper|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Paper saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Paper[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Paper[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Paper[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Paper[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PapersTable extends Table
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

        $this->setTable('papers');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->hasMany('Expenses', [
            'foreignKey' => 'foreign_key',
            'conditions' => ['model' => $this->getAlias()]
        ]);
        $this->belongsTo('InitialUnits', [
            'className' => 'Units',
            'foreignKey' => 'initial_unit_id'
        ]);
        $this->belongsTo('PaperColors', [
            'foreignKey' => 'paper_color_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('PaperDensities', [
            'foreignKey' => 'paper_density_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('PaperFormats', [
            'foreignKey' => 'paper_format_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('PaperPrices');
        $this->belongsTo('PaperTypes', [
            'foreignKey' => 'paper_type_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('PurchaseEntities', [
            'foreignKey' => 'foreign_key',
            'conditions' => ['model' => $this->getAlias()]
        ]);
        $this->belongsTo('Units', [
            'foreignKey' => 'unit_id'
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
            ->nonNegativeInteger('paper_color_id')
            ->notEmptyString('paper_color_id');

        $validator
            ->nonNegativeInteger('paper_density_id')
            ->notEmptyString('paper_density_id');

        $validator
            ->nonNegativeInteger('paper_format_id')
            ->notEmptyString('paper_format_id');

        $validator
            ->nonNegativeInteger('paper_type_id')
            ->notEmptyString('paper_type_id');

        $validator
            ->nonNegativeInteger('initial_unit_id')
            ->notEmptyString('initial_unit_id');

        $validator
            ->nonNegativeInteger('unit_id')
            ->notEmptyString('unit_id');

        $validator
            ->numeric('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmptyString('quantity');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

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
        $rules->add($rules->existsIn('paper_color_id', 'PaperColors'), ['errorField' => 'paper_color_id']);
        $rules->add($rules->existsIn('paper_density_id', 'PaperDensities'), ['errorField' => 'paper_density_id']);
        $rules->add($rules->existsIn('paper_format_id', 'PaperFormats'), ['errorField' => 'paper_format_id']);
        $rules->add($rules->existsIn('paper_type_id', 'PaperTypes'), ['errorField' => 'paper_type_id']);
        $rules->add($rules->existsIn('initial_unit_id', 'Units'), ['errorField' => 'initial_unit_id']);
        $rules->add($rules->existsIn('unit_id', 'Units'), ['errorField' => 'unit_id']);

        return $rules;
    }
}
