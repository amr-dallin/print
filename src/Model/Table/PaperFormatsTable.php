<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PaperFormats Model
 *
 * @property \App\Model\Table\PapersTable&\Cake\ORM\Association\HasMany $Papers
 *
 * @method \App\Model\Entity\PaperFormat newEmptyEntity()
 * @method \App\Model\Entity\PaperFormat newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PaperFormat[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PaperFormat get($primaryKey, $options = [])
 * @method \App\Model\Entity\PaperFormat findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PaperFormat patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PaperFormat[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PaperFormat|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PaperFormat saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PaperFormat[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PaperFormat[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PaperFormat[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PaperFormat[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PaperFormatsTable extends Table
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

        $this->setTable('paper_formats');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Papers', [
            'foreignKey' => 'paper_format_id',
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
            ->maxLength('title', 128)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->integer('width')
            ->requirePresence('width', 'create')
            ->notEmptyString('width');

        $validator
            ->integer('height')
            ->requirePresence('height', 'create')
            ->notEmptyString('height');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        return $validator;
    }
}
