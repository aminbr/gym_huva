<?php

use yii\db\Migration;

/**
 * Handles the creation of table `member_temporary`.
 */
class m171009_100630_create_member_temporary_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('member_temporary', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'tag_number' => $this->bigInteger()->notNull()->unique(),
            'day_limit' => $this->integer()->notNull(),
            'date_register' => $this->string(50)->null(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('member_temporary');
    }
}
