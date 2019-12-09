<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Banner */
/* @var $form yii\widgets\ActiveForm */
if($model->isNewRecord){
    $model->order = 1000;
}

?>

<div class="banner-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'src')->textInput(['maxlength' => true, 'readonly' => 'readonly','id'=>'src']) ?>
    <div id="uploader-demo">
        <!--用来存放item-->
        <div id="fileList" class="uploader-list">
            <div>
                <img id="picPreview" style="width:150px;height:auto;" src="<?php if ($model->src) {
                    echo $model->src;
                } ?>">
                <span id="message" style="color:red;"></span></div>
        </div>
        <br>
        <div id="upload">选择图片</div>
    </div>

    <?= $form->field($model, 'alt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php \app\widgets\JsBlock::begin() ?>
    <script type="javascript">
        var ratio = window.devicePixelRatio || 1,
            // 缩略图大小
            thumbnailWidth = 180 * ratio,
            thumbnailHeight = 100 * ratio;
        var uploader = new WebUploader.Uploader({
            // 自动上传。
            auto: true,
            // 文件接收服务端。
            server: '<?=Url::to(['/admin/upload/img'])?>',
            sendAsBinary: false,
            // 允许Coolie
//        withCredentials: true,
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: {
                id: '#upload',
                multiple: false
            },
            method: 'POST',
            // 只允许选择文件，可选。
            accept: {
                title: 'Images',
                extensions: 'jpg,jpeg,png',
                mimeTypes: 'image/jpg,image/jpeg,image/png',
            },
            formData: {'path': 'cate'},
            //是否允许重复上传
            duplicate: true,
            //单个文件的大小 500KB
            fileSingleSizeLimit: 0.5 * 1024 * 1024

        });
        uploader.on('fileQueued', function (file) {
            // 创建缩略图
            uploader.makeThumb(file, function (error, src) {
                if (error) {
                    $('#message').text('不能预览');
                    return;
                }
                $('#picPreview').attr('src', src);
            }, thumbnailWidth, thumbnailHeight);
        });
        uploader.on('error', function (error) {
            console.log(error);
            if (error == 'F_EXCEED_SIZE') {
                $('#message').text('文件最大限制为500KB');
            } else {
                $('#message').text(error);
            }
        });
        uploader.on('uploadSuccess', function (file, response) {
            if (response.code == 200) {
                $('#src').val(response.url);
                $('#message').text('');
            }
        });
    </script>
<?php \app\widgets\JsBlock::end() ?>