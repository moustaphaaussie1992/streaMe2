<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'User Transactions';
?>
<div class="user-transactions-index"  style="background: white; padding-left: 20px;padding-right: 20px; padding-top: 5px;border-radius: 10px; margin-bottom: 10px;">

    <h2 class="pull-left"><?= Html::encode($this->title) ?></h2>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{items}\n{summary}\n{pager}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            [
                'label' => 'from',
                'value' => 'fromUser0.fullname'
            ],
            [
                'label' => 'to',
                'value' => 'user.fullname'
            ],
            [
                'label' => 'post',
                'value' => 'room.title'
            ],
//            'roomId',
            'coins',
            'type',
            'date',
//            ['class' => 'yii\grid\ActionColumn',
//                'contentOptions' => ['style' => 'width: 8.7%'],
//                'visible' => Yii::$app->user->isGuest ? false : true,
//                'template' => '{view}',
//                'buttons' => [
//                    'view' => function ($url, $model) {
//                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
//                                    'class' => 'btn btn-success btn-xs',
//                                    'style' => 'padding: 4px;'
//                        ]);
//                    },
//                ],
//            ]
        ],
    ]);
    ?>
</div>
