<?php

use yii\db\Migration;

/**
 * Handles the creation of table `setting`.
 */
class m170629_083435_create_config_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('config', [
            'id' => $this->primaryKey(),
            'mode' => $this->string(50)->notNull(),
            'key_config' => $this->string(50)->notNull(),
            'value' => $this->string(50)->notNull(),
        ]);
        
        $this->insert('config', [
            'mode' => 'advance',
            'key_config' => 'name',
            'value' => 'باشگاه',
        ]);
        
//        $this->insert('config', [
//            'mode' => 'advance',
//            'key_config' => 'logo',
//            'value' => 'logo/logo.png',
//        ]);
        
//        $this->insert('config', [
//            'mode' => 'advance',
//            'key_config' => 'email',
//            'value' => 'amin.balavar@yahoo.com',
//        ]);
        
        $this->insert('config', [
            'mode' => 'advance',
            'key_config' => 'url_member_img',
            'value' => 'upload',
        ]);
        
        $this->insert('config', [
            'mode' => 'advance',
            'key_config' => 'ip_display',
            'value' => '0.0.0.0',
        ]);
        
        $this->insert('config', [
            'mode' => 'advance',
            'key_config' => 'delay_exit',
            'value' => '0',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('setting');
    }
}
