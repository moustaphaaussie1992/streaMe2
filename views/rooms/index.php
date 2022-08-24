<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\RoomsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Rooms');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="rooms-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Rooms'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'c_text:ntext',
            'r_admin',
            'creation_date',
            //'type',
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
