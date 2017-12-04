<?php

use yii\db\Migration;

/**
 * Handles the creation of table `level`.
 */
class m170627_195347_create_level_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('level', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
        ]);
        
        $this->insert('level', [
            'name' => 'کاربر',
        ]);
        
        $this->insert('level', [
            'name' => 'حسابدار',
        ]);
        
        $this->insert('level', [
            'name' => 'مدیر',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('level');
    }
}
