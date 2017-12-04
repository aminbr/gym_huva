<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tag`.
 */
class m170628_095241_create_tag_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tag', [
            'id' => $this->primaryKey(),
            'tag_number' => $this->bigInteger()->notNull()->unique(),
            'created_at' => $this->string(50)->null(),
            'updated_at' => $this->string(50)->null(),
            'type' => $this->smallInteger()->notNull(), // مهمان یا عادی
            'status' => $this->boolean()->notNull()->defaultValue(0), // وضعیت کارت    زمانی که کارت به شخص اختصاص داده نشود صفر میباشد
        ]);
        
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tag');
    }
}
