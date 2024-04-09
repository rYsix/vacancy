<?php

/** @var yii\web\View $this */

$this->title = 'Вакансии';
?>

<a href="/pps/pps" class="vacancy-card-link" style="text-decoration: none; color: inherit;">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-12">
                <div class="card vacancy-card">
                    <div class="card-body">
                        <h4 class="card-title text-center text-primary">Объявление!</h4>
                        <h5 class="card-text text-center">Некоммерческое акционерное общество «Алматинский университет энергетики и связи имени Гумарбека Даукеева» объявляет конкурс на должности заведующего кафедрой, профессорско-преподавательского состава на 2024-2025 учебный год.</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</a>






<div class="site-index">
    <div class=" bg-transparent rounded-3">
        <div class="container-fluid py-5 text-center">
            <h1 class="display-4">Вакантные Позиции</h1>
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
                                    <small class="text-muted">Публикация: <?= $item->publication_date ? date('Y-m-d', strtotime($item->publication_date)) : 'Дата не установлена' ?></small>
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

<style>
    .row.justify-content-center {
    display: flex;
    flex-wrap: wrap;
}

.card {
    flex: 1;
}

.card-body {
    display: flex;
    flex-direction: column;
    height: 100%;
}

.vacancy-card-link {
    display: flex;
    height: 100%;
}

.vacancy-card {
    width: 100%;
}

</style>
