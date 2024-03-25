<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vacancy}}`.
 */
class m240325_095235_create_vacancy_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vacancy}}', [
            'id' => $this->primaryKey(),
            'position_name' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'salary' => $this->decimal(10, 2),
            'requirements' => $this->text(),
            'responsibilities' => $this->text(),
            'work_schedule' => $this->string(100),
            'academic_direction' => $this->string(150),
            'location' => $this->string(100),
            'contact_info' => $this->string(255),
            'publication_date' => $this->dateTime(),
            'application_deadline' => $this->dateTime(),
            'is_active' => $this->boolean()->defaultValue(true),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%vacancy}}');
    }
}
