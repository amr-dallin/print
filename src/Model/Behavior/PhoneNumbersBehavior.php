<?php
declare(strict_types=1);

namespace App\Model\Behavior;

use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\ORM\Behavior;
use Cake\ORM\Table;

/**
 * PhoneNumbers behavior
 */
class PhoneNumbersBehavior extends Behavior
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
        $this->_table->hasOne('PhoneNumbers')
            ->setForeignKey('foreign_key')
            ->setConditions(['PhoneNumbers.model' => $this->_table->getAlias()])
            ->setCascadeCallbacks(true)
            ->setDependent(true);
    }

    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options): void
    {
        if ($entity->has('phone_number')) {
            $entity->phone_number->set('model', $this->_table->getAlias());
        }
    }
}
