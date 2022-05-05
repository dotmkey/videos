<?php

namespace app\src\infrastructure\domain\model;

use app\src\domain\model\File;
use app\src\domain\model\FileRepositoryInterface;
use yii\db\Connection;

class FileRepository extends AbstractRepository implements FileRepositoryInterface
{
    public function __construct(Connection $connection)
    {
        parent::__construct($connection, File::class);
    }

    public function ofIds(int ...$ids): array
    {
        return File::findAll(['id' => $ids]);
    }
}