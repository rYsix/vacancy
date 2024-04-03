<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception $exception */



if ($exception->statusCode == 404) {
    $message = 'Ресурс не найден. Проверьте правильность ссылки';
    $name = 'Ошибочка';
    
}
$this->title = $name;
?>

<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-warning">
        <?= nl2br(Html::encode($message)) ?>
    </div>
    <p>
        Пожалуйста, свяжитесь с нами, если считаете, что возникла ошибка на нашей стороне.
        <br>
        r.malikov@aues.kz
    </p>

</div>
