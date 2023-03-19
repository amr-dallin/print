<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PaperColors Model
 *
 * @property \App\Model\Table\PapersTable&\Cake\ORM\Association\HasMany $Papers
 *
 * @method \App\Model\Entity\PaperColor newEmptyEntity()
 * @method \App\Model\Entity\PaperColor newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PaperColor[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PaperColor get($primaryKey, $options = [])
 * @method \App\Model\Entity\PaperColor findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PaperColor patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PaperColor[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PaperColor|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PaperColor saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PaperColor[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PaperColor[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PaperColor[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PaperColor[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PaperColorsTable extends Table
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

        $this->setTable('paper_colors');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->hasMany('Papers', [
            'foreignKey' => 'paper_color_id',
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
            ->scalar('title')
            ->maxLength('title', 45)
            ->requirePresence('title', 'create')
            ->notEmptyString('title')
            ->add('title', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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
        $rules->add($rules->isUnique(['title']), ['errorField' => 'title']);

        return $rules;
    }
}
