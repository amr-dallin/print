<?php
declare(strict_types=1);

namespace App\Model\Behavior;

use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\ORM\Behavior;
use Cake\ORM\Table;

/**
 * Representatives behavior
 */
class RepresentativesBehavior extends Behavior
{
    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    /**
     * Initialize method
     *
     * @param array $config Configuration options
     * @return void
     */
    public function initialize(array $config): void
    {
        $this->_table->hasOne('Representatives')
            ->setForeignKey('foreign_key')
            ->setConditions(['Representatives.model' => $this->_table->getAlias()])
            ->setCascadeCallbacks(true)
            ->setDependent(true);
    }

    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options): void
    {
        if ($entity->has('representative')) {
            $entity->representative->set('model', $this->_table->getAlias());
        }
    }
}
