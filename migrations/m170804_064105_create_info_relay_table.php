<?php

use yii\db\Migration;

/**
 * Handles the creation of table `dresser`.
 */
class m170804_064105_create_info_relay_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('info_relay', [
            'id' => $this->primaryKey(), // name type number
            'name' => $this->string(50)->notNull()->unique(),
            'type' => $this->string(50)->notNull(),
            'number' => $this->integer()->notNull(),
            'ip_relay' => $this->string(50)->null(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('info_relay');
    }
}
