<?php

use yii\db\Migration;

/**
 * Handles the creation of table `member`.
 */
class m170626_215707_create_member_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('member', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'family' => $this->string(50)->notNull(),
            'nt_code' => $this->bigInteger()->notNull(),
            'gender' => $this->smallInteger()->notNull(),
            'job' => $this->string(50)->notNull(),
            'date_birth' => $this->string(20)->notNull(),
            'mobile' => $this->bigInteger()->null(),
            'telephone' => $this->bigInteger()->null(),
            'email' => $this->string(100)->null(),
            'address' => $this->string(100)->notNull(),
            'img' => $this->string(100)->null(),
            'tag_number' => $this->bigInteger()->notNull(),
            'is_deleted' => $this->boolean()->notNull()->defaultValue(0),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('member');
    }
}
