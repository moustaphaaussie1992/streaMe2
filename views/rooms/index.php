<?php

use app\models\RoomsSearch;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;

/* @var $this View */
/* @var $searchModel RoomsSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = Yii::t('app', 'Posts');
//$this->params['breadcrumbs'][] = $this->title;
?>


<div class="rooms-index"  style="background: white; padding-left: 20px;padding-right: 20px; padding-top: 5px;border-radius: 10px; margin-bottom: 10px;" >

    <h2 class="pull-left"><?= Html::encode($this->title) ?></h2>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>
    <?php
//    echo Html::a(Yii::t('app', 'Create Rooms'), ['create'], ['class' => 'btn btn-success pull-right',
//        'style' => 'margin-top: 15px; background: linear-gradient(184deg, rgba(127,71,221,1) 45%, rgba(47,15,101,1) 100%, rgba(218,238,225,1) 100%);'])
    ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{items}\n{summary}\n{pager}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            'title',
            'c_text:ntext',
//            'r_admin',
            'rAdmin.fullname',
//            'creation_date',
            'type',
            //'game',
            //'category',
            //'mention',
            //'mention2',
            //'mention3',
            //'accept1',
            //'accept2',
            //'accept3',
            //'color1',
            //'color2',
            //'video_thumbnail',
            //'challenge_coins',
            //'is_challenge_finished',
            //'challenge_winner',
            //'streamer_response',
            //'invitation_response',
            //'challenge_date',
//            ['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width: 8.7%'],
                'visible' => Yii::$app->user->isGuest ? false : true,
                'template' => '{view} {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                    'class' => 'btn btn-success btn-xs',
                                    'style' => 'padding: 4px;'
                        ]);
                    },
//                    'update' => function ($url, $model) {
//                        return Html::a('<span class="glyphicon glyphicon-pencil "></span>', $url, [
//                                    'class' => 'btn btn-primary btn-xs my-ajax',
//                                    'style' => ' background-color: #20507B;padding: 4px;',
//                                    'title' => 'تعديل'
//                        ]);
//                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                    'class' => 'btn btn-danger btn-xs',
                                    'style' => ' background-color: #9F1E20;padding: 4px;',
                                    'data' => [
                                        'method' => 'post',
                                        'params' => [
                                            'id' => $model->id
                                        ],
                                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                        'title' => Yii::t('app', 'Confirmation'),
                                        'ok' => Yii::t('app', 'OK'),
                                        'cancel' => Yii::t('app', 'Cancel'),
                                    ]
                        ]);
                    }
                ],
            ]
        ]
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
