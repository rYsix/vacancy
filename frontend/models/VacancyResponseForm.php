<?php

namespace frontend\models;

use yii\base\Model;

class VacancyResponseForm extends Model
{
    public $full_name;
    public $about;
    public $email;
    public $attachment_file; // Для хранения пути к загруженному файлу
    public $uploaded_file; // Для хранения объекта загруженного файла

    public function rules()
    {
        return [
            [['full_name', 'about', 'email'], 'required', 'message' => 'Пожалуйста, заполните поле "{attribute}".'],
            [['full_name', 'email'], 'string', 'max' => 255],
            ['email', 'email', 'message' => 'Введите корректный адрес электронной почты.'],
            ['about', 'string', 'max' => 1000],
            ['attachment_file', 'file', 'extensions' => ['pdf','png'], 'message' => 'Пожалуйста, прикрепите файл в формате PDF.'],
        ];
    }
    public static function tableName()
    {
        return 'yii2_vacancy_response';
    }

    public function attributeLabels()
    {
        return [
            'full_name' => 'ФИО',
            'about' => 'О себе',
            'email' => 'Email',
            'attachment_file' => 'Резюме',
        ];
    }
    public function upload($vacancyId)
{
    if ($this->validate()) {
        if ($this->attachment_file && $this->attachment_file->tempName !== null) {
            $fileName = '/uploads/vacancy_responces/' . str_replace(' ', '_', $this->full_name) . '_to_vacancy_' . $vacancyId . '/' . 'resume' . '.' . $this->attachment_file->extension;
            $directory = dirname($fileName);
            if (!is_dir($directory)) {
                mkdir($directory, 0777, true);
            }
            if ($this->attachment_file->saveAs($fileName)) {
                return $fileName;
            } else {
                return null;
            }
        } else {
            return null;
        }
    } else {
        return false; 
    }
}




}
