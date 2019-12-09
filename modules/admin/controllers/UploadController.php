<?php


namespace app\modules\admin\controllers;


use Yii;
use yii\web\UploadedFile;

class UploadController extends BaseController
{
    public $enableCsrfValidation = false;

    public function actionImg()
    {
        $file = UploadedFile::getInstanceByName('file');
        $path = Yii::$app->request->post('path', 'default');
        $mineType = explode('/', $file->type);
        $ext = isset($mineType[1]) ? $mineType[1] : 'jpg';
        $filePath = 'upload/' . $path;
        if (!is_dir($filePath)) {
            mkdir($filePath);
        }
        $fileName = $filePath . '/' . md5_file($file->tempName) . '.' . $ext;
        $re = $file->saveAs($fileName);
        Yii::$app->response->format = 'json';
        if ($re) {
            return [
                'code' => 200,
                'url' => '/'.$fileName,
                'message' => '上传成功'
            ];
        }
        return [
            'code' => 500,
            'message' => '上传失败'
        ];
    }
}