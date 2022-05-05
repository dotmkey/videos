<?php
declare(strict_types=1);

namespace app\src\infrastructure\migration;

use yii\db\ColumnSchemaBuilder;
use yii\db\Connection;

trait TypesTrait
{
    /** @return Connection|array|string */
    abstract protected function getDb();

    public function uuid(): ColumnSchemaBuilder
    {
        return $this->getDb()->getSchema()->createColumnSchemaBuilder('uuid');
    }
}