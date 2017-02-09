<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post`.
 */
class m170208_004726_create_post_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'post'=>'text',
            'created_at'=>$this->dateTime(),
            'user_id'=>'int'            
        ]);
        $this->addForeignKey('post_user_id', 'post', 'user_id', 'user', 'id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('post');
    }
}
