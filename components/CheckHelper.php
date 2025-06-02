<?php

namespace app\components;

use Yii;

class CheckHelper
{
    public static function chechAccess($appToken)
    {
        return $appToken == Yii::$app->params['requestToken'];
    }
}