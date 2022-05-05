<?php
declare(strict_types=1);

namespace app\src\domain\model\common\ar;

use yii\db\ActiveRecord;

trait InstantiationTrait
{
    private static ?ActiveRecord $instance = null;

    public static function instance($refresh = false)
    {
        if ($refresh || self::$instance === null) {
            self::$instance = self::instantiate([]);
        }

        return self::$instance;
    }

    public static function instantiate($row)
    {
        $class = get_called_class();
        $object = (new \ReflectionClass($class))->newInstanceWithoutConstructor();
        $object->init();
        return $object;
    }
}