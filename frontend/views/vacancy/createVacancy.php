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
    margin-bottom: 20px; /* Внешний отступ снизу */
}

/* Стили для заголовка формы */
.vacancy-form h1 {
    color: #333333; /* Цвет текста */
    margin-bottom: 20px; /* Внешний отступ снизу */
}

/* Стили для кнопки "Создать" */
.btn-success {
    background-color: #28a745; /* Цвет фона */
    border-color: #28a745; /* Цвет границы */
    width: 50%; /* Ширина кнопки */
}

.btn-success:hover {
    background-color: #218838; /* Цвет фона при наведении */
    border-color: #1e7e34; /* Цвет границы при наведении */
}

.btn-success:focus, .btn-success.focus {
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.5); /* Тень при фокусе */
}
.help-block{
    color: red;
    background-color: #ebe8e8;
    padding-left: 15px;
    border-radius: 2px;
}
</style>

<div class="vacancy-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="vacancy-form">
        <?php $form = ActiveForm::begin(); ?>

        <hr>
        <?= $form->field($model, 'is_active')->checkbox(['class' => 'form-check-input']) ?>

        <hr>

        <?= $form->field($model, 'position_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'salary')->textInput() ?>

        <?= $form->field($model, 'requirements')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'responsibilities')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'work_schedule')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'academic_direction')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

        
        <hr>
        <?= $form->field($model, 'publication_date')->widget(DatePicker::class, [
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control'],
            'language' => 'ru',
        ]) ?>

        <?= $form->field($model, 'application_deadline')->widget(DatePicker::class, [
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control'],
            'language' => 'ru',
        ]) ?>

        <?= $form->field($model, 'company')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'contact_info')->textInput(['maxlength' => true]) ?>
            
        <hr> <!-- Разделитель -->

        <div class="form-group text-center"> <!-- Контейнер для центрирования кнопки -->
            <?= Html::submitButton('Создать', ['class' => 'btn btn-success btn-lg mt-3']) ?> <!-- Добавлен отступ и классы для стилизации -->
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
