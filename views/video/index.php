<?php
use app\src\application\usecase\paginatevideos\VideoOutput;
use Carbon\CarbonImmutable;
use yii\bootstrap\Html;
use yii\bootstrap4\LinkPager;
use yii\data\Pagination;
use yii\data\Sort;

/** @var array<VideoOutput> $videos */
/** @var Pagination $pages */
/** @var Sort $sort */
?>

<main class="my-5">
    <div class="container">
        <section class="text-center">
            <h4 class="mb-5"><strong>Fascinating videos</strong></h4>
            <?= $sort->link('added_at') . ' | ' . $sort->link('views') ?>

            <?php if (count($videos) === 0): ?>
                <h5 class="mb-5"><strong>Stay tuned. There will be hot.</strong></h5>
            <?php endif; ?>

            <?php foreach ($videos as $key => $video): ?>
                <?php if ($key % 3 === 0): ?>
                    <div class="row">
                <?php endif; ?>
                        <div class="col-lg-4 col-md-12 mb-4">
                            <div class="card">
                                <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                    <img src="<?= $video->getThumbnailUrl() ?? '/images/default.png' ?>" class="img-fluid" />
                                    <a href="#!">
                                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?= Html::encode($video->getTitle()) ?></h5>
                                    <p class="card-text">Added at: <?= Html::encode($video->getAddedAt()) ?></p>
                                    <p class="card-text">Views: <?= Html::encode($video->getViews()) ?></p>
                                    <?php if ($video->getDuration() < 3600): ?>
                                        <p class="card-text">Duration: <?= Html::encode(CarbonImmutable::parse($video->getDuration())->format('i:s')) ?></p>
                                    <?php else: ?>
                                        <p class="card-text">Duration: <?= Html::encode(CarbonImmutable::parse($video->getDuration())->format('H:i:s')) ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                <?php if ($key % 3 === 2): ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

            <?= LinkPager::widget(['pagination' => $pages, 'firstPageLabel' => 'First', 'lastPageLabel' => 'Last',]) ?>
        </section>
    </div>
</main>