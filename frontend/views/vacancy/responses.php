<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

$this->title = 'Отклики на вакансии';
?>

<div class="site-responses">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'attribute' => 'full_name',
                    'label' => 'Полное имя',
                ],
                [
                    'attribute' => 'vacancy_id',
                    'label' => 'Вакансия',
                    'value' => function ($response) {
                        if (!empty($response->vacancy_id)) {
                            $vacancy = \common\models\Vacancy::findOne($response->vacancy_id);
                            if ($vacancy !== null) {
                                return Html::a(Html::encode($vacancy->position_name), ['vacancy/detail', 'id' => $vacancy->id]);
                            }
                        }
                        return null;
                    },
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'email',
                    'label' => 'Email',
                    'value' => function ($response) {
                        $email = Html::encode($response->email);
                        return $email;
                    },
                    'format' => 'raw',
                    'contentOptions' => ['style' => 'white-space: nowrap;'], // Добавляем стиль no-wrap
                ],                
                [
                    'attribute' => 'about',
                    'label' => 'О себе',
                ],
                [
                    'attribute' => 'attachment_path',
                    'label' => 'Резюме',
                    'value' => function ($response) {
                        if (!empty($response->attachment_path)) {
                            return Html::a('<i class="fa fa-file-pdf-o"></i> Скачать резюме', '/frontend/web/' . $response->attachment_path, ['download' => true]);
                        }
                        return null;
                    },
                    'format' => 'raw',
                ],
            ],
            'summary' => 'Показано {begin} - {end} из {totalCount} Откликов',
        ]); ?>

        <?= LinkPager::widget([
            'pagination' => $dataProvider->pagination,
            'options' => ['class' => 'pagination justify-content-center mt-4'],
            'linkOptions' => ['class' => 'page-link'],
            'disabledPageCssClass' => 'page-item-disabled',
            'prevPageCssClass' => 'page-item',
            'nextPageCssClass' => 'page-item',
            'prevPageLabel' => '&laquo;11',
            'nextPageLabel' => '&raquo;11',
            
        ]); ?>
    </div>
</div>


<style>
    .page-item-disabled {
        visibility: hidden;
    }
</style>
