<?php
declare(strict_types=1);

namespace app\src\application\usecase\paginatevideos;

use app\src\domain\model\Video;
use Carbon\CarbonImmutable;

class VideoOutput
{
    private int $id;
    private string $title;
    private ?string $thumbnailUrl;
    private int $duration;
    private int $views;
    private CarbonImmutable $addedAt;

    public function __construct(Video $video, ?string $thumbnailUrl = null)
    {
        $this->id = $video->getId();
        $this->title = $video->getTitle();
        $this->thumbnailUrl = $thumbnailUrl;
        $this->duration = $video->getDuration();
        $this->views = $video->getViews();
        $this->addedAt = $video->getAddedAt();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getThumbnailUrl(): ?string
    {
        return $this->thumbnailUrl;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function getViews(): int
    {
        return $this->views;
    }

    public function getAddedAt(): CarbonImmutable
    {
        return $this->addedAt;
    }
}