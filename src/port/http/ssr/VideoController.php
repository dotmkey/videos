<?php
declare(strict_types=1);

namespace app\src\port\http\ssr;

use app\src\application\usecase\PaginateVideos;
use yii\data\Pagination;
use yii\data\Sort;

class VideoController extends AbstractController
{
    private PaginateVideos $paginateVideosUseCase;

    public function __construct($id, $module, PaginateVideos $paginateVideosUseCase, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->paginateVideosUseCase = $paginateVideosUseCase;
    }

    public function actionIndex(): string
    {
        $paginatedResult = $this->paginateVideosUseCase->execute(
            $page = $this->getPage(),
            $perPage = $this->getPerPage(),
            $this->getSort('added_at', ['added_at', 'views']),
            $this->getDirection()
        );

        return $this->render('index', [
            'videos' => $paginatedResult->getElements(),
            'pages' => new Pagination([
                'totalCount' => $paginatedResult->getTotal(),
                'page' => $page,
                'pageSize' => $perPage,
            ]),
            'sort' => new Sort(['attributes' => ['added_at', 'views']])
        ]);
    }
}