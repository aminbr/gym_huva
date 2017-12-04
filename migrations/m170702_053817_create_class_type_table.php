<?php

use yii\db\Migration;

/**
 * Handles the creation of table `class_type`.
 */
class m170702_053817_create_class_type_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('class_type', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->unique(),
        ]);
        
        $this->insert('class_type', [
            'name' => 'عادی',
        ]);
        
        $this->insert('class_type', [
            'name' => 'مهمان',
        ]);
        
        $this->insert('class_type', [
            'name' => 'قهرمان',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('class_type');
    }
}
