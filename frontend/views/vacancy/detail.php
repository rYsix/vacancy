<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\VacancyResponseForm;

/** @var yii\web\View $this */
/** @var app\models\Vacancy $vacancy */
/** @var frontend\models\VacancyResponceForm $responseForm */

$this->title = $vacancy->position_name;

$responseForm = new VacancyResponseForm(); // Создаем экземпляр модели формы

?>



<div class="site-vacancy">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Информация о компании</h5>
                        <p class="card-text"><?= Html::encode($vacancy->company) ?></p>
                        <hr>
                        <h6 class="card-subtitle mb-2 text-muted"><i class="fa fa-envelope"></i> Контактная информация</h6>
                        <p class="card-text">
                             <?= Html::encode($vacancy->contact_info) ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <i class="fa fa-briefcase"></i> <?= Html::encode($vacancy->position_name) ?> 
                                    <?php if ($vacancy->is_active): ?>
                                        <span class="badge bg-success">Активно</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Закрыта</span>
                                    <?php endif; ?>
                                </h4>
                                <hr>
                                <h6 class="card-subtitle mb-2 text-muted"><i class="fa fa-align-left"></i> Описание вакансии</h6>
                                <p class="card-text"><?= Html::encode($vacancy->description) ?></p>
                                <hr>
                                <h6 class="card-subtitle mb-2 text-muted"><i class="fa fa-list-ul"></i> Требования</h6>
                                <p class="card-text"><?= Html::encode($vacancy->requirements) ?></p>
                                <hr>
                                <h6 class="card-subtitle mb-2 text-muted"><i class="fa fa-tasks"></i> Обязанности</h6>
                                <p class="card-text"><?= Html::encode($vacancy->responsibilities) ?></p>
                                <hr>
                                <h6 class="card-subtitle mb-2 text-muted"><i class="fa fa-clock-o"></i> График работы</h6>
                                <p class="card-text"><?= Html::encode($vacancy->work_schedule) ?></p>
                                <hr>
                                <h6 class="card-subtitle mb-2 text-muted"><i class="fa fa-graduation-cap"></i> Образовательное направление</h6>
                                <p class="card-text"><?= Html::encode($vacancy->academic_direction) ?></p>
                                <hr>
                                <h6 class="card-subtitle mb-2 text-muted"><i class="fa fa-map-marker"></i> Местоположение</h6>
                                <p class="card-text"><?= Html::encode($vacancy->location) ?></p>
                                <hr>
                                
                            </div>
                        </div>
                    </div>
                    <?php if ($vacancy->is_active): ?>
                        <div class="col-md-5">
                            <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><i class="fa fa-paper-plane"></i> Откликнуться на вакансию</h5>
                                        <?php $form = ActiveForm::begin(); ?>
                                            <div class="mb-3">
                                                <?= $form->field($responseForm, 'full_name')->textInput(['maxlength' => true])->label('ФИО') ?>
                                            </div>
                                            <div class="mb-3">
                                                <?= $form->field($responseForm, 'email')->textInput(['maxlength' => true])->label('Email (@aues.kz)') ?>
                                            </div>
                                            <div class="mb-3">
                                                <?= $form->field($responseForm, 'about')->textarea(['rows' => 6])->label('О себе (курс, направление)') ?>
                                            </div>
                                            <div class="mb-3">
                                                <?= $form->field($responseForm, 'attachment_file')->fileInput()->label('Прикрепить резюме   ') ?>
                                            </div>
                                            <div class="form-group">
                                            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
                                    </div>
                                <?php ActiveForm::end(); ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>