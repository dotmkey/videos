<?php
declare(strict_types=1);

namespace app\src\application\usecase;

use app\src\application\usecase\paginatevideos\VideoOutput;
use app\src\domain\model\common\PaginatedResult;
use app\src\domain\model\FileRepositoryInterface;
use app\src\domain\model\Video;
use app\src\domain\model\VideoRepositoryInterface;

class PaginateVideos
{
    private VideoRepositoryInterface $videoRepository;
    private FileRepositoryInterface $fileRepository;

    public function __construct(VideoRepositoryInterface $videoRepository, FileRepositoryInterface $fileRepository)
    {
        $this->videoRepository = $videoRepository;
        $this->fileRepository = $fileRepository;
    }

    public function execute(int $page, int $perPage, string $orderBy, string $direction): PaginatedResult
    {
        $paginatedVideos = $this->videoRepository->paginate($page, $perPage, $orderBy, $direction);

        $fileIds = [];
        /** @var Video $video */
        foreach ($paginatedVideos->getElements() as $video) {
            $fileIds[] = $video->getThumbnailId();
        }

        $files = $this->fileRepository->ofIds(...array_filter($fileIds));
        $fileUrlsMap = [];
        foreach ($files as $file) {
            $fileUrlsMap[$file->getId()] = $file->getUrl();
        }

        return new PaginatedResult(
            array_map(
                fn(Video $video) => new VideoOutput($video, $fileUrlsMap[$video->getThumbnailId()] ?? null),
                $paginatedVideos->getElements()
            ),
            $paginatedVideos->getTotal()
        );
    }
}