<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%offer_cart}}`.
 */
class m191113_011455_create_offer_cart_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%offer_cart}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->comment('用户ID'),
            'goods_id' => $this->integer()->notNull()->comment('商品ID'),
            'count' => $this->integer()->notNull()->unsigned()->comment('商品数量'),
            'price' => $this->decimal(10, 2)->notNull()->comment('报价'),
            'remark' => $this->string()->comment('备注'),
            'created_at' => $this->dateTime()->comment('创建时间')
        ]);
        $this->createIndex('user_id', '{{%offer_cart}}', 'user_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%offer_cart}}');
    }
}
