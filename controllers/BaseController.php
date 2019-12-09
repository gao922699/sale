<?php


namespace app\controllers;


use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

class BaseController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'except' => ['login'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    public function jsonResponse($message, $data = [], $httpCode = 200)
    {
        Yii::$app->response->setStatusCode($httpCode);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'code' => $httpCode,
            'message' => $message,
            'data' => $data
        ];
    }
}