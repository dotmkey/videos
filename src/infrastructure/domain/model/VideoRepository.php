<?php
declare(strict_types=1);

namespace app\src\infrastructure\domain\model;

use app\src\domain\model\common\PaginatedResult;
use app\src\domain\model\Video;
use app\src\domain\model\VideoRepositoryInterface;
use yii\db\Connection;

class VideoRepository extends AbstractRepository implements VideoRepositoryInterface
{
    private const SORTABLE_FIELDS = ['added_at', 'views'];
    private const DEFAULT_SORTABLE_FIELD = 'added_at';

    public function __construct(Connection $connection)
    {
        parent::__construct($connection, Video::class);
    }

    public function paginate(int $page, int $perPage, string $orderBy, string $direction = 'asc'): PaginatedResult
    {
        $orderBy = $this->filterSortField($orderBy);
        $direction = $this->filterSortDirection($direction);
        $cursorSign = $direction === 'asc' ? '>=' : '<=';

        $sql = <<<SQL
with
    cursor as (
        select $orderBy, id from video order by $orderBy $direction, id $direction limit 1 offset :offset
    )
    select * from video
    inner join (select count(1) as cnt from video) s on true
    where ($orderBy, id) $cursorSign (select $orderBy, id from cursor)
    order by $orderBy $direction
    limit $perPage
SQL;

        $res = $this->connection->createCommand($sql)->bindValues(['offset' => $page * $perPage])->query()->readAll();

        return new PaginatedResult(array_map(fn(array $_) => $this->hydrate($_), $res), $res[0]['cnt'] ?? 0);
    }

    private function filterSortField(string $field): string
    {
        return in_array($field, self::SORTABLE_FIELDS) ? $field : self::DEFAULT_SORTABLE_FIELD;
    }
}