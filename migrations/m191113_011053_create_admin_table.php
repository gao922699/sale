<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%admin}}`.
 */
class m191113_011053_create_admin_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%admin}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->comment('用户名'),
            'password' => $this->string()->notNull()->comment('密码'),
            'authKey' => $this->string()->comment('authKey'),
            'accessToken' => $this->string()->comment('accessToken'),
            'role' => $this->tinyInteger()->notNull()->comment('角色'),
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
        $this->dropTable('{{%admin}}');
    }
}
