<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_cost}}`.
 */
class m191113_031930_create_user_cost_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_cost}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->comment('用户ID'),
            'goods_id' => $this->integer()->notNull()->comment('商品ID'),
            'cost' => $this->decimal(10,2)->notNull()->comment('成本价'),
            'created_at' => $this->dateTime()->comment('创建时间'),
            'updated_at' => $this->dateTime()->comment('更新时间'),
        ]);
        $this->createIndex('user_id','{{%user_cost}}','user_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_cost}}');
    }
}
