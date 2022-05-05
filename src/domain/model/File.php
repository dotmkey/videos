<?php
declare(strict_types=1);

namespace app\src\domain\model;

use app\src\domain\model\common\ar\InstantiationTrait;

class File extends \yii\db\ActiveRecord
{
    use InstantiationTrait;

    private ?int $id = null;
    private string $url;
    private string $path;

    public function __construct(string $url, string $path)
    {
        $this->setUrl($url);
        $this->setPath($path);
        parent::__construct();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    private function setUrl(string $url): void
    {
        $this->url = $url;
    }

    private function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function afterFind()
    {
        $this->id = $this->getAttribute('id');
        $this->url = $this->getAttribute('url');
        $this->path = $this->getAttribute('path');
        parent::afterFind();
    }

    public function beforeSave($insert): bool
    {
        $this->setAttribute('id', $this->getId());
        $this->setAttribute('url', $this->getUrl());
        $this->setAttribute('path', $this->getPath());
        return parent::beforeSave($insert);
    }
}