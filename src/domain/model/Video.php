<?php
declare(strict_types=1);

namespace app\src\domain\model;

use app\src\domain\model\common\ar\InstantiationTrait;
use Carbon\CarbonImmutable;

class Video extends \yii\db\ActiveRecord
{
    use InstantiationTrait;

    private ?int $id = null;
    private string $title;
    private ?int $thumbnailId;
    private int $duration;
    private int $views = 0;
    private CarbonImmutable $addedAt;

    public function __construct(string $title, int $thumbnailId, int $duration)
    {
        $this->setTitle($title);
        $this->setThumbnailId($thumbnailId);
        $this->setDuration($duration);
        $this->setAddedAt(CarbonImmutable::now());
        parent::__construct();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getThumbnailId(): ?int
    {
        return $this->thumbnailId;
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

    private function setTitle(string $title): void
    {
        $this->title = $title;
    }

    private function setThumbnailId(int $thumbnailId): void
    {
        $this->thumbnailId = $thumbnailId;
    }

    private function setDuration(int $duration): void
    {
        $this->duration = $duration;
    }

    private function setViews(int $views): void
    {
        $this->views = $views;
    }

    private function setAddedAt(CarbonImmutable $addedAt): void
    {
        $this->addedAt = $addedAt;
    }

    public function afterFind(): void
    {
        $this->id = $this->getAttribute('id');
        $this->title = $this->getAttribute('title');
        $this->thumbnailId = $this->getAttribute('thumbnail_id');
        $this->duration = $this->getAttribute('duration');
        $this->views = $this->getAttribute('views');
        $this->addedAt = new CarbonImmutable($this->getAttribute('added_at'));
        parent::afterFind();
    }

    public function beforeSave($insert): bool
    {
        $this->setAttribute('id', $this->getId());
        $this->setAttribute('title', $this->getTitle());
        $this->setAttribute('thumbnail_id', $this->getThumbnailId());
        $this->setAttribute('duration', $this->getDuration());
        $this->setAttribute('views', $this->getViews());
        $this->setAttribute('added_at', $this->getAddedAt()->toRfc3339String());
        return parent::beforeSave($insert);
    }
}