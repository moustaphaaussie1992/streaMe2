<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Rooms */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rooms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="rooms-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        if (Yii::$app->user->identity) {
            echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
        }
        ?>
        <?php
        if (Yii::$app->user->identity) {
            echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]);
        }
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'c_text:ntext',
            'r_admin',
            'creation_date',
            'type',
            'game',
            'category',
            'mention',
            'mention2',
            'mention3',
            'accept1',
            'accept2',
            'accept3',
            'color1',
            'color2',
            'video_thumbnail',
            'challenge_coins',
            'is_challenge_finished',
            'challenge_winner',
            'streamer_response',
            'invitation_response',
            'challenge_date',
        ],
    ])
    ?>

</div>
