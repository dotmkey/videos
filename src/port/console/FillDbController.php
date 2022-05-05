<?php
declare(strict_types=1);

namespace app\src\port\console;

use yii\console\Controller;
use yii\console\ExitCode;
use yii\db\Connection;

class FillDbController extends Controller
{
    private Connection $connection;

    public function __construct($id, $module, Connection $connection, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->connection = $connection;
    }

    public function actionIndex(): int
    {
        $this->connection->transaction(function () {
            $this->connection->createCommand('drop index video_added_at_id_idx')->execute();
            $this->connection->createCommand('drop index video_views_id_idx')->execute();
            $this->connection->createCommand("
                insert into file (url, path)
                values
                    ('/images/1.jpg', '/path/to/file'),
                    ('/images/2.jpg', '/path/to/file1'),
                    ('/images/3.jpg', '/path/to/file2')
            ")->execute();

            $this->connection->createCommand("
                insert into video (title, thumbnail_id, duration, views, added_at)
                select
                    v.title,
                    f.id,
                    v.duration,
                    v.views,
                    v.added_at
                from (
                    select
                        ceil(random() * 3) as frn,
                        md5(random()::text) as title,
                        (random() * 10000)::int as duration,
                        (random() * 1000000)::int as views,
                        timestamp '2020-01-01 00:00:00' + random() * (now() - '2020-01-01 00:00:00') as added_at
                    from generate_series(1, 10000000)
                ) v
                join (select id, row_number() over () as rn from file) f on f.rn = v.frn
            ")->execute();
            $this->connection->createCommand('create index video_added_at_id_idx on video (added_at, id)')->execute();
            $this->connection->createCommand('create index video_views_id_idx on video (views, id)')->execute();
        });

        return ExitCode::OK;
    }
}