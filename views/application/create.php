<?php

use app\models\Car;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Application $model */
/** @var $cars */

$this->title = 'Создать заявку';
$this->params['breadcrumbs'][] = ['label' => 'Applications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="application-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cars' => Car::find()->all()
    ]) ?>

</div>
