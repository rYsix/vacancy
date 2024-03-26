<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Отклики на вакансии';
?>

<div class="site-responses">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>

        <div class="row">
            <?php foreach ($vacancyResponses as $response): ?>
                <div class="col-md-">
                    <div class="card mb-4">
                        <div class="card-body">
                            
                            <h5 class="card-title"><?= Html::encode($response->full_name) ?></h5><br>
                            <?php if (!empty($response->vacancy_id)): ?>
                                <?php $vacancy = \common\models\Vacancy::findOne($response->vacancy_id); ?>
                                <?php if ($vacancy !== null): ?>
                                    <p class="card-subtitle mb-2 text-muted"><i class="fa fa-briefcase"></i> <?= Html::a(Html::encode($vacancy->position_name), ['vacancy/detail', 'id' => $vacancy->id]) ?></p>
                                <?php endif; ?>
                            <?php endif; ?>
                            <hr>
                            <p class="card-subtitle mb-2 text-muted"><i class="fa fa-envelope"></i> Почта</p>
                            <p class="card-text"><?= Html::encode($response->email) ?></p>
                            <hr>
                            <h6 class="card-subtitle mb-2 text-muted"><i class="fa fa-align-left"></i> О себе</h6>
                            <p class="card-text"><?= Html::encode($response->about) ?></p>
                            <?php if (!empty($response->attachment_path)): ?>
                                <p class="card-text"><i class="fa fa-file-pdf-o"></i><a href="/frontend/web/<?= $response->attachment_path ?>" download>Скачать резюме</a></p>
                            <?php endif; ?>
                            <hr>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
