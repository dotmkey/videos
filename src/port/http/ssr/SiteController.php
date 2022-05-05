<?php
declare(strict_types=1);

namespace app\src\port\http\ssr;

class SiteController extends AbstractController
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
}