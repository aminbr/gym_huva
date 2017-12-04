<?php

use yii\db\Migration;

/**
 * Handles the creation of table `member_cash`.
 */
class m170702_082352_create_member_cash_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('member_cash', [
            'id' => $this->primaryKey(),
            'date_register' => $this->string(50)->notNull(),
            'member_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'class_id' => $this->integer()->notNull(),
            'price_class' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('member_cash');
    }
}
