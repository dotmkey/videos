<?php
declare(strict_types=1);

namespace app\src\domain\model;

interface FileRepositoryInterface
{
    /** @return array<File> */
    public function ofIds(int ...$ids): array;
}