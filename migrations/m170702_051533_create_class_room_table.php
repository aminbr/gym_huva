<?php

use yii\db\Migration;

/**
 * Handles the creation of table `class`.
 */
class m170702_051533_create_class_room_table extends Migration
{
    /**
     * @inheritdoc
     */ 
    public function up()
    {
        $this->createTable('class_room', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'class_type' => $this->smallInteger()->notNull(),
            'created_at' => $this->string(50)->null(),
            'updated_at' => $this->string(50)->null(),
            'price' => $this->integer()->notNull(),
            'number_day' => $this->integer()->notNull(), // اعتبار کلاس بر حسب تعداد روز
            'time_limit' => $this->string(50)->notNull(), // مدت ساعتی که فرد میتواند در باشگاه تمرین کند بر حسب ساعت
            'day_limit' => $this->integer()->notNull(), // محدودیت استفاده در زمان تعیین شده
            'paired_odd' => $this->integer()->notNull(), // زوج یا فرد بودن
            'is_deleted' => $this->boolean()->notNull()->defaultValue(0),
        ]);
        
//        $this->insert('class_room', [
//            'name' => 'روزانه',
//            'class_type' => '1',
//            'created_at' => '123456789',
//            'updated_at' => '',
//            'price' => 10000,
//            'number_day' => 1, // اعتبار کلاس بر حسب تعداد روز
//            'time_limit' => 2, // مدت ساعتی که فرد میتواند در باشگاه تمرین کند بر حسب ساعت
//        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('class_room');
    }
}
