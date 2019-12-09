<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m191113_011008_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->comment('用户名'),
            'password' => $this->string()->notNull()->comment('密码'),
            'authKey' => $this->string()->comment('authKey'),
            'accessToken' => $this->string()->comment('accessToken'),
            'status' => $this->tinyInteger()->notNull()->comment('状态'),
            'created_at' => $this->dateTime()->comment('创建时间'),
            'updated_at' => $this->dateTime()->comment('更新时间'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
