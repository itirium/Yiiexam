<?php

use yii\db\Migration;

class m170208_220417_add_ismanager_to_user_table extends Migration
{
    public function up()
    {
           $this->addColumn('user', 'ismanager', $this->boolean()->notNull()->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('user', 'ismanager');        
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
