<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cate}}`.
 */
class m191113_010928_create_cate_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cate}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('名称'),
            'photo' => $this->string()->notNull()->comment('图片'),
            'parent_id' => $this->integer()->defaultValue(0)->comment('父级分类ID'),
            'order' => $this->integer()->defaultValue(10000)->comment('排序'),
            'created_at' => $this->dateTime()->comment('创建时间'),
            'updated_at' => $this->dateTime()->comment('更新时间'),
        ]);
        $this->createIndex('order','{{%cate}}','order');
        $this->createIndex('parent_id','{{%cate}}','parent_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cate}}');
    }
}
