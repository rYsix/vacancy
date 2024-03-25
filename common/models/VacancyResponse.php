<?php
namespace common\models;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;


class VacancyResponse extends ActiveRecord
{
    public $uploaded_file;

    public function rules()
    {
        return [
            [['full_name', 'about', 'email'], 'required'],
            ['email', 'email'],
            ['attachment_path', 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, pdf'],
            ['vacancy_id', 'exist', 'targetClass' => Vacancy::className(), 'targetAttribute' => ['vacancy_id' => 'id']],
        ];
    }

    public static function tableName()
    {
        return 'yii2_vacancy_response';
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->uploaded_file->saveAs('uploads/' . $this->uploaded_file->baseName . '.' . $this->uploaded_file->extension);
            return true;
        } else {
            return false;
        }
    }
}
