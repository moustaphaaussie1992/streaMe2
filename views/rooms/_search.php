<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RoomsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rooms-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'c_text') ?>

    <?= $form->field($model, 'r_admin') ?>

    <?= $form->field($model, 'creation_date') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'game') ?>

    <?php // echo $form->field($model, 'category') ?>

    <?php // echo $form->field($model, 'mention') ?>

    <?php // echo $form->field($model, 'mention2') ?>

    <?php // echo $form->field($model, 'mention3') ?>

    <?php // echo $form->field($model, 'accept1') ?>

    <?php // echo $form->field($model, 'accept2') ?>

    <?php // echo $form->field($model, 'accept3') ?>

    <?php // echo $form->field($model, 'color1') ?>

    <?php // echo $form->field($model, 'color2') ?>

    <?php // echo $form->field($model, 'video_thumbnail') ?>

    <?php // echo $form->field($model, 'challenge_coins') ?>

    <?php // echo $form->field($model, 'is_challenge_finished') ?>

    <?php // echo $form->field($model, 'challenge_winner') ?>

    <?php // echo $form->field($model, 'streamer_response') ?>

    <?php // echo $form->field($model, 'invitation_response') ?>

    <?php // echo $form->field($model, 'challenge_date') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
