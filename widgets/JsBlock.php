<?php
/**
 * User: yiqing
 * Date: 14-9-15
 * Time: 下午12:09
 * Url:  http://www.yiiframework.com/wiki/752/embedded-javascript-block-in-your-view-with-ide-checking-or-intellisense/
 */

namespace app\widgets;

use yii\web\View;
use yii\widgets\Block;

class JsBlock extends Block
{

    /**
     * @var null
     */
    public $key = null;
    /**
     * @var int
     */
    public $pos = View::POS_END;

    /**
     * Ends recording a block.
     * This method stops output buffering and saves the rendering result as a named block in the view.
     */
    public function run()
    {
        $block = ob_get_clean();
        if ($this->renderInPlace) {
            throw new \Exception("not implemented yet ! ");
        }
        $block = trim($block);
        $jsBlockPattern = '|^<script[^>]*>(?P<block_content>.+?)</script>$|is';
        if (preg_match($jsBlockPattern, $block, $matches)) {
            $block = $matches['block_content'];
        }

        $this->view->registerJs($block, $this->pos, $this->key);
    }
}