<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\CreateVacancyForm */

$this->title = 'Создать вакансию';
$this->params['breadcrumbs'][] = ['label' => 'Вакансии', 'url' => ['/site/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
/* Создание красивого контейнера для формы */
.vacancy-form {
    background-color: #ffffff; /* Цвет фона */
    border-radius: 8px; /* Закругленные углы */
    box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); /* Тень */
    padding: 20px; /* Внутренний отступ */
    margin-bottom: 20px;
}


.vacancy-form h1 {
    color: #333333; 
    margin-bottom: 20px; 
}


.btn-success {
    background-color: #28a745; 
    border-color: #28a745; 
    width: 50%;
}

.btn-success:hover {
    background-color: #218838;
    border-color: #1e7e34;
}

.btn-success:focus, .btn-success.focus {
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.5); 
}

.help-block{
    color: red;
    background-color: #ebe8e8;
    padding-left: 15px;
    border-radius: 2px;
}

.custom-hr hr {
    border: none;
    height: 1px;
    background-color: #ccc; 
    margin: 20px 0;
}

.form-check-input {
    height: 0.6cm;
    width: 0.6cm;
    border: 1px solid #ccc; 
    box-shadow: 0 0 35px rgba(0, 0, 0, 0.1);
}

.form-control {
    border: 1px solid #ccc; /* граница */
}

.form-group {
    padding-top: 10px;
    padding-bottom: 5px;
}

</style>

<div class="vacancy-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="vacancy-form">
        <?php $form = ActiveForm::begin(); ?>

        <hr>
        <?= $form->field($model, 'is_active')->checkbox(['class' => 'form-check-input'])->label('<i class="fa fa-check"></i>') ?>
        <hr>

        <?= $form->field($model, 'position_name')->textInput(['maxlength' => true])->label('<i class="fa fa-briefcase"></i> Название должности') ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6])->label('<i class="fa fa-file-text"></i> Описание') ?>

        <?= $form->field($model, 'salary')->textInput()->label('<i class="fa fa-money"></i> Заработная плата') ?>

        <?= $form->field($model, 'requirements')->textarea(['rows' => 6])->label('<i class="fa fa-list-ul"></i> Требования') ?>

        <?= $form->field($model, 'responsibilities')->textarea(['rows' => 6])->label('<i class="fa fa-tasks"></i> Обязанности') ?>

        <?= $form->field($model, 'work_schedule')->textInput(['maxlength' => true])->label('<i class="fa fa-calendar"></i> График работы') ?>

        <?= $form->field($model, 'academic_direction')->textInput(['maxlength' => true])->label('<i class="fa fa-graduation-cap"></i> Академическое направление') ?>

        <?= $form->field($model, 'location')->textInput(['maxlength' => true])->label('<i class="fa fa-map-marker"></i> Местоположение') ?>

        <hr>
        <?= $form->field($model, 'publication_date')->widget(DatePicker::class, [
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control'],
            'language' => 'ru',
        ])->label('<i class="fa fa-calendar"></i> Дата публикации') ?>

        <?= $form->field($model, 'application_deadline')->widget(DatePicker::class, [
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control'],
            'language' => 'ru',
        ])->label('<i class="fa fa-calendar"></i> Крайний срок подачи заявок') ?>

        <?= $form->field($model, 'company')->textInput(['maxlength' => true])->label('<i class="fa fa-building"></i> Компания') ?>

        <?= $form->field($model, 'contact_info')->textInput(['maxlength' => true])->label('<i class="fa fa-phone"></i> Контактная информация') ?>
            
        <hr> <!-- Разделитель -->

        <div class="form-group text-center"> <!-- Контейнер для центрирования кнопки -->
            <?= Html::submitButton('Создать', ['class' => 'btn btn-success btn-lg mt-3']) ?> <!-- Добавлен отступ и классы для стилизации -->
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
