<?php
declare(strict_types=1);

namespace app\src\infrastructure\domain\model;

use Exception;
use yii\db\ActiveRecord;
use yii\db\Connection;

abstract class AbstractRepository
{
    protected Connection $connection;
    protected string $className;

    public function __construct(Connection $connection, string $className)
    {
        if (!is_a($className, ActiveRecord::class, true)) {
            throw new Exception("Repositories are supposed to work with entities of ActiveRecord");
        }

        $this->connection = $connection;
        $this->className = $className;
    }

    protected function hydrate(array $rawValue): ActiveRecord
    {
        $entity = $this->className::instance(true);
        $this->className::populateRecord($entity, $rawValue);
        $entity->afterFind();

        return $entity;
    }

    protected function filterSortDirection(string $direction): string
    {
        return in_array($direction, ['asc', 'desc']) ? $direction : 'asc';
    }
}