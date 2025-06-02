<?php

namespace app\controllers;

use app\components\CheckHelper;
use app\components\CodeHelper;
use Yii;
use yii\web\Controller;

class PhoneNumberController extends Controller
{
    public function actionSendCode()
    {
        $code = CodeHelper::generateCode();
        $requestToken = Yii::$app->request->headers->get('requestToken');
        $phoneNumber =  Yii::$app->request->headers->get('phone_number');
        if (CheckHelper::chechAccess($requestToken)) {
            //место для вызова PhoneNumberService
            return \Yii::$app->response->data = json_encode(['status' => 200, 'code' => $code]);
        }
        return \Yii::$app->response->data = json_encode(['status' => 404]);
    }
}