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
            'province' => $this->string()->comment('省份'),
            'city' => $this->string()->comment('城市'),
            'address' => $this->string()->comment('地址'),
            'tel' => $this->string()->comment('电话'),
            'contact' => $this->string()->comment('联系人'),
            'tax' => $this->decimal(3, 2)->defaultValue(0)->comment('税率'),
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
