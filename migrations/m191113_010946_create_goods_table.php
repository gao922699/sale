<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%goods}}`.
 */
class m191113_010946_create_goods_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%goods}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('名称'),
            'thumb' => $this->string()->notNull()->comment('缩略图'),
            'carousel' => $this->text()->comment('轮播图'),
            'detail' => $this->text()->comment('详情'),
            'cate_id' => $this->integer()->notNull()->comment('分类'),
            'type' => $this->string(50)->notNull()->comment('型号'),
            'brand' => $this->string(50)->notNull()->comment('品牌'),
            'price' => $this->decimal(10, 2)->notNull()->comment('建议零售价'),
            'count' => $this->integer()->defaultValue(0)->comment('被报价次数'),
            'status' => $this->tinyInteger()->notNull()->comment('状态'),
            'admin_id' => $this->integer()->notNull()->comment('所属供应商'),
            'created_at' => $this->dateTime()->comment('创建时间'),
            'updated_at' => $this->dateTime()->comment('更新时间'),
        ]);
        $this->createIndex('name','{{%goods}}','name');
        $this->createIndex('cate_id','{{%goods}}','cate_id');
        $this->createIndex('count','{{%goods}}','count');
        $this->createIndex('status','{{%goods}}','status');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%goods}}');
    }
}
