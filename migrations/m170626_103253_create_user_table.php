<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m170626_103253_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'nickname' => $this->string(50)->notNull(),
            'username' => $this->string(50)->notNull()->unique(),
            'password' => $this->string(100)->notNull(),
            'email' => $this->string(50)->null(),
            'level' => $this->smallInteger()->notNull(),
            'status' => $this->boolean()->notNull(),
            'is_deleted' => $this->boolean()->notNull()->defaultValue(0),
            
        ]);
        $this->insert('user', [
            'nickname' => 'مدیر',
            'username' => 'admin',
            'password' => 'admin', //hash('sh1', 'admin')
            'email' => '',
            'level' => '3',
            'status' => '1',
        ]);
        $this->insert('user', [
            'nickname' => 'کاربر',
            'username' => 'user',
            'password' => 'user', //hash('sh1', 'user')
            'email' => '',
            'level' => '1',
            'status' => '1',
        ]);
        $this->insert('user', [
            'nickname' => 'کاربر سیستمی',
            'username' => 'installer',
            'password' => 'installer', //hash('sh1', 'user')
            'email' => '',
            'level' => '8',
            'status' => '1',
        ]);
        $this->insert('user', [
            'nickname' => 'هیوا',
            'username' => 'huva',
            'password' => 'huva', //hash('sh1', 'user')
            'email' => '',
            'level' => '6',
            'status' => '1',
        ]);
        
        
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
