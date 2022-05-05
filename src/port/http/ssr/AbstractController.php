<?php
declare(strict_types=1);

namespace app\src\port\http\ssr;

use yii\web\BadRequestHttpException;
use yii\web\Controller;

abstract class AbstractController extends Controller
{
    public function getPage(int $default = 0, string $paramName = 'page'): int
    {
        if (($page = $this->request->get($paramName) ?? $default) < 0) {
            throw new BadRequestHttpException('Page must be greater or equal than 0');
        }

        $page = (int) $page;

        return $page === 0 ? 0 : $page - 1;
    }

    public function getPerPage(int $default = 50, string $paramName = 'per-page'): int
    {
        if (($perPage = $this->request->get($paramName) ?? $default) <= 0) {
            throw new BadRequestHttpException('PerPage must be greater than 0');
        }

        return (int) $perPage;
    }

    public function getSort(string $default, array $allowed, string $paramName = 'sort'): string
    {
        $sort = $this->request->get($paramName) ?? $default;
        $sort = str_starts_with($sort, '-') ? substr($sort, 1) : $sort;

        return in_array($sort, $allowed) ? $sort : $default;
    }

    public function getDirection(string $default = 'asc', string $paramName = 'sort'): string
    {
        $sort = $this->request->get($paramName);

        if ($sort === null) {
            return $default;
        }

        return str_starts_with($sort, '-') ? 'desc' : 'asc';
    }
}