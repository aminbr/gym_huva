<?php

use yii\db\Migration;

/**
 * Handles the creation of table `enter_exit`.
 */
class m170629_101241_create_enter_exit_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('enter_exit', [
            'id' => $this->primaryKey(),
            'tag_number' =>  $this->bigInteger()->notNull(),
            'member_id' => $this->integer()->notNull(),
            'enter_date' => $this->string(50)->notNull(),
            'user_id' => $this->integer()->notNull(),
            'exit_date' => $this->string(50)->null(),
            'number_dresser' => $this->string(50)->null(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('enter_exit');
    }
}
