<?php

use app\models\Application;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Личный кабинет';
?>
<div class="application-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'date',
            'car',
            [
                'class' => 'yii\grid\DataColumn',
                'value' => function (Application $model) {
                    switch ($model->status) {
                        case 1:
                            return 'Новая';
                        case 2:
                            return 'Принята';
                        case 3:
                            return 'Отклонена';
                        default:
                            return 'Неизвестный статус';
                    }
                },
                'label' => 'Статус'

            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Application $model, $key, $index, $column) {
                    return Url::toRoute(['application/' . $action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>
</div>
