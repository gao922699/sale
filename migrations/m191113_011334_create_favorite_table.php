<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%favorite}}`.
 */
class m191113_011334_create_favorite_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%favorite}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->comment('用户ID'),
            'goods_id' => $this->integer()->notNull()->comment('商品ID'),
            'created_at' => $this->dateTime()->comment('创建时间')
        ]);
        $this->createIndex('user_id','{{%favorite}}','user_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%favorite}}');
    }
}
