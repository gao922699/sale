<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%price_goods}}`.
 */
class m191113_011727_create_offer_goods_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%offer_goods}}', [
            'id' => $this->primaryKey(),
            'offer_id' => $this->integer()->notNull()->comment('报价单ID'),
            'goods_id' => $this->integer()->notNull()->comment('商品ID'),
            'count' => $this->integer()->notNull()->unsigned()->comment('商品数量'),
            'remark' => $this->string()->comment('备注'),
            'offer_price' => $this->decimal(10, 2)->notNull()->comment('报价'),
            'cost_price' => $this->decimal(10, 2)->notNull()->comment('成本价'),
            'created_at' => $this->dateTime()->comment('创建时间')
        ]);
        $this->createIndex('offer_id', '{{%offer_goods}}', 'offer_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%offer_goods}}');
    }
}
