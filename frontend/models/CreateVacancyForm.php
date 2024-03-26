<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

class CreateVacancyForm extends Model
{
    public $id;
    public $position_name;
    public $description;
    public $salary;
    public $requirements;
    public $responsibilities;
    public $work_schedule;
    public $academic_direction;
    public $location;
    public $contact_info;
    public $publication_date;
    public $application_deadline;
    public $is_active;
    public $company;

    public function rules()
    {
        return [
            [['position_name', 'description'], 'required', 'message' => 'Пожалуйста, заполните поле "{attribute}".'],
            [['salary'], 'number'],
            [['requirements', 'responsibilities'], 'string'],
            [['work_schedule', 'academic_direction', 'location', 'contact_info', 'company'], 'string', 'max' => 255],
            [['publication_date', 'application_deadline'], 'safe'],
            [['is_active'], 'boolean'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'position_name' => 'Название позиции',
            'description' => 'Описание',
            'salary' => 'Заработная плата',
            'requirements' => 'Требования',
            'responsibilities' => 'Обязанности',
            'work_schedule' => 'График работы',
            'academic_direction' => 'Научное направление',
            'location' => 'Местоположение',
            'contact_info' => 'Контактная информация',
            'publication_date' => 'Дата публикации',
            'application_deadline' => 'Крайний срок подачи заявок',
            'is_active' => 'Активно',
            'company' => 'Компания',
        ];
    }
}
