<?php

/** @var yii\web\View $this */

$this->title = 'Вакансии';
?>
<div class="site-index">
    <div class=" bg-transparent rounded-3">
        <div class="container-fluid py-5 text-center">
            <h1 class="display-4">Вакантные Вакансии</h1>
            <p class="fs-5 fw-light">Только для студентов АУЭС</p>
        </div>
    </div>


    <div class="body-content">
        <div class="row justify-content-center">
            <?php foreach ($vacancy as $item): ?>
                <div class="col-md-6"> <!-- Определяем ширину колонки, где будут размещаться карточки -->
                    <a href="<?= \yii\helpers\Url::to(['vacancy/detail', 'id' => $item->id]) ?>" class="text-decoration-none vacancy-card-link">
                        <div class="card mb-4 vacancy-card">
                            <div class="card-body">
                                <h5 class="card-title"><?= $item->position_name?>
                                    <?php if ($item->is_active): ?>
                                        <span class="badge bg-success">Активно</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Закрыта</span>
                                    <?php endif; ?>
                                </h5>
                                <p class="card-text">Описание: <?= $item->description ?></p>
                                <p class="card-text">График работы: <?= $item->work_schedule ?></p>
                                <p class="card-text">Направление в университете: <?= $item->academic_direction ?></p>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Откликнуться</button>
                                    </div>
                                    <small class="text-muted">Публикация: <?= Yii::$app->formatter->asDate($item->publication_date) ?></small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<style>
    .vacancy-card-link:hover .vacancy-card {
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); /* Эффект тени */
    }
</style>