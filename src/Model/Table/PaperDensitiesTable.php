<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PaperDensities Model
 *
 * @property \App\Model\Table\PapersTable&\Cake\ORM\Association\HasMany $Papers
 *
 * @method \App\Model\Entity\PaperDensity newEmptyEntity()
 * @method \App\Model\Entity\PaperDensity newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PaperDensity[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PaperDensity get($primaryKey, $options = [])
 * @method \App\Model\Entity\PaperDensity findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PaperDensity patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PaperDensity[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PaperDensity|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PaperDensity saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PaperDensity[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PaperDensity[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PaperDensity[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PaperDensity[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PaperDensitiesTable extends Table
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

        $this->setTable('paper_densities');
        $this->setDisplayField('density');
        $this->setPrimaryKey('id');

        $this->hasMany('Papers', [
            'foreignKey' => 'paper_density_id',
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
            ->nonNegativeInteger('density')
            ->requirePresence('density', 'create')
            ->notEmptyString('density')
            ->add('density', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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
        $rules->add($rules->isUnique(['density']), ['errorField' => 'density']);

        return $rules;
    }
}
