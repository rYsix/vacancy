<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vacancy_responce}}`.
 */
class m240325_162407_create_vacancy_responce_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vacancy_response}}', [
            'id' => $this->primaryKey(),
            'full_name' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull(),
            'about' => $this->text()->notNull(),
            'attachment_path' => $this->string(255),
            'vacancy_id' => $this->integer(),
        ]);

        // Создание внешнего ключа для поля vacancy_id
        $this->addForeignKey(
            'fk-vacancy_response-vacancy_id',
            '{{%vacancy_response}}',
            'vacancy_id',
            '{{%vacancy}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Удаление внешнего ключа
        $this->dropForeignKey('fk-vacancy_response-vacancy_id', '{{%vacancy_response}}');

        $this->dropTable('{{%vacancy_response}}');
    }
}
