<?php

use yii\db\Migration;

/**
 * Handles the creation of table `relay`.
 */
class m170805_091838_create_relay_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('relay', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'number' => $this->integer()->unique()->notNull(), // شماره منطقی رله برای نمایش
            'number_relay' => $this->string(50)->notNull(), //  شماره فیزیکی رله برای باز کردن
            'ip_relay' => $this->string(50)->notNull(), // ای پی رله برای دسترسی به رله
            'type' => $this->string(50)->notNull(),
            'alocation' => $this->string(50)->notNull()->defaultValue(0), // تخصیص دادن = 1
            'damage' => $this->string(50)->notNull(0)->defaultValue(0), // خرابی
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('relay');
    }
}
