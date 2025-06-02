<?php

namespace app\controllers;

use app\components\CheckHelper;
use app\components\CodeHelper;
use app\services\MailService;
use app\services\ApiService;
use Yii;
use yii\web\Controller;

class EmailController extends Controller
{
    private MailService $mailService;
    public function __construct(
        $id,
        $module,
        MailService $mailService,
        $config = []
    )
    {
        $this->mailService = $mailService;
        parent::__construct($id, $module, $config);
    }

    public function actionSendCode()
    {
        $code = CodeHelper::generateCode();
        $requestToken = Yii::$app->request->headers->get('requestToken');
        $email =  Yii::$app->request->headers->get('email');
        if (CheckHelper::chechAccess($requestToken)) {
            $this->mailService->send(
                $email,
                'Тема сообщения',
                'code',
                ['code' => $code]
            );
            return \Yii::$app->response->data = json_encode(['status' => 200, 'code' => $code]);
        }
        return \Yii::$app->response->data = json_encode(['status' => 404]);
    }
}