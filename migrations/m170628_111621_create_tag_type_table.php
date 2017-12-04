<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tag_type`.
 */
class m170628_111621_create_tag_type_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tag_type', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->unique(),
        ]);
        
        $this->insert('tag_type', [
            'name' => 'عمومی',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tag_type');
    }
}
