<?php
declare(strict_types=1);

namespace app\src\domain\model;

use app\src\domain\model\common\PaginatedResult;

interface VideoRepositoryInterface
{
    public function paginate(int $page, int $perPage, string $orderBy, string $direction = 'asc'): PaginatedResult;
}