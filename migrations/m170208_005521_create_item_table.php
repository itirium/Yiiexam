<?php

use yii\db\Migration;

/**
 * Handles the creation of table `item`.
 */
class m170208_005521_create_item_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('item', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(),
            'price'=>$this->float(),
            'description'=>$this->string(),
            'imagesrc'=>$this->string()
        ]); 
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('item');
    }
}
