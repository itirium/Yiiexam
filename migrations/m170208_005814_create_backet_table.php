<?php

use yii\db\Migration;

/**
 * Handles the creation of table `backet`.
 */
class m170208_005814_create_backet_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('backet', [
            'id' => $this->primaryKey(),
            'user_id'=>'int',
            'item_id'=>'int',
            'count'=>'int'
        ]);
        $this->addForeignKey('backet_user_id', 'backet', 'user_id', 'user', 'id');
        $this->addForeignKey('backet_item_id', 'backet', 'item_id', 'item', 'id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('backet');
    }
}
