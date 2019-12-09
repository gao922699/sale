<?php

use app\models\Admin;
use app\models\Cate;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Goods */
/* @var $form yii\widgets\ActiveForm */
/* @var $topCates [] */
/* @var $childCates [] */
/* @var $topCateId int|null */
$topCates = Cate::getTopCates();
if ($model->isNewRecord) {
    $topCateId = null;
    $model->count = 0;
    $childCates = [];
    $carousels = [];
} else {
    $topCateId = $model->cate->getParentCate()->id;
    $childCates = Cate::getChildCates($topCateId);
    $carousels = explode(',', $model->carousel);
}
?>

    <div class="goods-form">

        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-md-5">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'thumb')->hiddenInput(['maxlength' => true, 'readonly' => 'readonly', 'id' => 'thumb']) ?>
                <div id="uploader-demo">
                    <!--用来存放item-->
                    <div id="upload">选择图片</div>
                    <div id="fileList" class="uploader-list">
                        <div>
                            <img id="picPreview" style="width:150px;height:auto;" src="<?php if ($model->thumb) {
                                echo $model->thumb;
                            } ?>">
                            <span id="message" style="color:red;"></span></div>
                    </div>
                </div>

                <div class="form-group field-goods-top_cate required has-success">
                    <label class="control-label" for="goods-top_cate">一级分类</label>
                    <?= Html::dropDownList('top_cate', $topCateId, $topCates, ['prompt' => '请选择一级分类', 'id' => 'top_cate', 'class' => 'form-control']) ?>
                    <div class="help-block"></div>
                </div>

                <?= $form->field($model, 'cate_id')->dropDownList($childCates, ['prompt' => '请先选择一级分类', 'id' => 'child_cate'])->label('二级分类') ?>

                <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'brand')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'count')->textInput() ?>

                <?= $form->field($model, 'admin_id')->dropDownList(Admin::getSuppliers()) ?>

                <div class="form-group">
                    <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
            <div class="col-md-7">
                <?= $form->field($model, 'carousel')->textInput(['readonly' => 'readonly', 'id' => 'carousel']) ?>
                <div id="uploader-carousel">
                    <!--用来存放item-->
                    <div id="fileList2" class="uploader-list">
                        <div>
                            <div id="picPreview2">
                                <?php foreach ($carousels as $carousel) { ?>
                                    <img class="preview" src="<?= $carousel ?>">
                                <?php } ?>
                            </div>
                            <span id="message2" style="color:red;"></span></div>
                    </div>
                    <div id="upload2">选择图片</div>
                </div>

                <?= $form->field($model, 'detail')->widget('kucha\ueditor\UEditor', ['clientOptions' => [
                    'initialFrameWidth' => '360'
                ]])->label('商品介绍（请按照手机端的展示大小填写，请勿从word文档直接复制！）'); ?>

            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
    <style>
        .preview {
            width: 150px;
            height: auto;
            margin-left: 10px;
        }
    </style>
<?php \app\widgets\JsBlock::begin() ?>
    <script type="javascript">
        $('#top_cate').change(function () {
            $.get('<?=Url::toRoute(['/admin/goods/get-child-cates'])?>', {
                id: $(this).val()
            }, function (res) {
                var html = '';
                for (var i in res) {
                    html += '<option value=' + i + '>' + res[i] + '</option>';
                }
                $('#child_cate').html(html);
            });
        });


        var ratio = window.devicePixelRatio || 1,
            // 缩略图大小
            thumbnailWidth = 100 * ratio,
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
            formData: {'path': 'goods_thumb'},
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
                $('#thumb').val(response.url);
                $('#message').text('');
            }
        });

        var ratio2 = window.devicePixelRatio || 1,
            // 缩略图大小
            thumbnailWidth2 = 100 * ratio,
            thumbnailHeight2 = 100 * ratio;
        var uploader2 = new WebUploader.Uploader({
            // 自动上传。
            auto: true,
            // 文件接收服务端。
            server: '<?=Url::to(['/admin/upload/img'])?>',
            sendAsBinary: false,
            // 允许Coolie
//        withCredentials: true,
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: {
                id: '#upload2',
                multiple: false
            },
            method: 'POST',
            // 只允许选择文件，可选。
            accept: {
                title: 'Images',
                extensions: 'jpg,jpeg,png',
                mimeTypes: 'image/jpg,image/jpeg,image/png',
            },
            formData: {'path': 'goods_carousel'},
            //是否允许重复上传
            duplicate: true,
            //单个文件的大小 500KB
            fileSingleSizeLimit: 0.5 * 1024 * 1024

        });
        uploader2.on('fileQueued', function (file) {
            // 创建缩略图
            uploader.makeThumb(file, function (error, src) {
                if (error) {
                    $('#message2').text('不能预览');
                    return;
                }
                $('#picPreview2').append('<img class="preview" src="' + src + '">');
            }, thumbnailWidth2, thumbnailHeight2);
        });
        uploader2.on('error', function (error) {
            console.log(error);
            if (error == 'F_EXCEED_SIZE') {
                $('#message2').text('文件最大限制为500KB');
            } else {
                $('#message2').text(error);
            }
        });
        uploader2.on('uploadSuccess', function (file, response) {
            if (response.code == 200) {
                var pics = $('#carousel').val();
                var picsArray = [];
                if (pics == '') {
                    picsArray.push(response.url);
                } else {
                    picsArray = pics.split(',');
                    picsArray.push(response.url);
                }

                $('#carousel').val(picsArray.join(','));
                $('#message2').text('');
            }
        });

    </script>
<?php \app\widgets\JsBlock::end() ?>