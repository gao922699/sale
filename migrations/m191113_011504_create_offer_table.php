<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%offer}}`.
 */
class m191113_011504_create_offer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%offer}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->comment('用户ID'),
            'name' => $this->string()->notNull()->comment('报价对象名称'),
            'tel' => $this->string()->notNull()->comment('报价对象电话'),
            'address' => $this->string()->notNull()->comment('报价对象地址'),
            'date' => $this->dateTime()->notNull()->comment('报价日期'),
            'created_at' => $this->dateTime()->comment('创建时间')
        ]);
        $this->createIndex('user_id','{{%offer}}','user_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%offer}}');
    }
}
