<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%banner}}`.
 */
class m191122_085338_create_banner_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%banner}}', [
            'id' => $this->primaryKey(),
            'src' => $this->string()->notNull()->comment('图片地址'),
            'alt' => $this->string()->notNull()->comment('图片说明'),
            'url' => $this->string()->comment('跳转地址'),
            'order' => $this->integer()->notNull()->defaultValue(0)->comment('排序'),
            'created_at' => $this->dateTime()->comment('创建时间'),
            'updated_at' => $this->dateTime()->comment('更新时间'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%banner}}');
    }
}
