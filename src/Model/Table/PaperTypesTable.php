<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PaperTypes Model
 *
 * @property \App\Model\Table\PapersTable&\Cake\ORM\Association\HasMany $Papers
 *
 * @method \App\Model\Entity\PaperType newEmptyEntity()
 * @method \App\Model\Entity\PaperType newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PaperType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PaperType get($primaryKey, $options = [])
 * @method \App\Model\Entity\PaperType findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PaperType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PaperType[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PaperType|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PaperType saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PaperType[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PaperType[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PaperType[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PaperType[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PaperTypesTable extends Table
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

        $this->setTable('paper_types');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->hasMany('Papers', [
            'foreignKey' => 'paper_type_id',
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
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        return $validator;
    }
}
