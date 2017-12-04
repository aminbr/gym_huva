<?php

use yii\db\Migration;

/**
 * Handles the creation of table `job`.
 */
class m170627_203636_create_job_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('job', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
        ]);
        
        $this->insert('job', [
            'name' => 'کارمند',
        ]);
        
        $this->insert('job', [
            'name' => 'دانشجو',
        ]);
        
        $this->insert('job', [
            'name' => 'خانه دار',
        ]);
        
        $this->insert('job', [
            'name' => 'آزاد',
        ]);
        
        $this->insert('job', [
            'name' => 'سایر',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('job');
    }
}
