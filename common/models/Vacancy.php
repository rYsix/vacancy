<?php
namespace common\models;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;


class Vacancy extends ActiveRecord
{


    public function rules()
    {
        return [
            [['position_name', 'description'], 'required'],
            [['description', 'requirements', 'responsibilities', 'work_schedule', 'academic_direction', 'location', 'contact_info', 'company'], 'string'],
            [['position_name'], 'string', 'max' => 255],
            [['salary'], 'number'],
            [['is_active'], 'boolean'],
            [['publication_date', 'application_deadline'], 'safe'],
        ];
    }


    public static function tableName()
    {
        return 'yii2_vacancy';
    }
}
