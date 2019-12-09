<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://cdn.jsdelivr.net/npm/@nutui/nutui@2.1.7/dist/nutui.css',
    ];
    public $js = [
        'https://cdn.jsdelivr.net/npm/vue/dist/vue.js',
        'https://cdn.jsdelivr.net/npm/@nutui/nutui@2.1.7/dist/nutui.js'
    ];
    public $jsOptions=[
        'position'=>View::POS_HEAD
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
