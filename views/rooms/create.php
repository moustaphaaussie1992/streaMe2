<?php

use app\models\Rooms;
use kartik\file\FileInput;
use richardfan\widget\JSRegister;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Rooms */

//$this->title = Yii::t('app', 'Add Post');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rooms'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rooms-create">

    <!--<h1 style="text-align: center;">-->
    <?php
//echo Html::encode($this->title)\
    ?>
    <!--</h1>-->


    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-12">
        <?=
        $form->field($model, 'title', ['labelOptions' => [
//            'style' => 'color:white'
    ]])->textInput(['maxlength' => true])
        ?>
    </div>
    <div class="col-lg-12">
        <?=
        $form->field($model, 'c_text', ['labelOptions' => [
//            'style' => 'color:white'
    ]])->textarea(['rows' => 6])->label("Description")
        ?>
    </div>
      <div class="col-lg-12">
          <?= $form->field($model, 'type')->dropDownList([ "pictures" => 'pictures',"video" => 'video'])->label("Post Type") ?>
            </div>
    <div class="col-lg-12">
        <?php
        echo $form->field($model, 'file[]')->widget(FileInput::classname(), [
            'options' => [
                   'id'=>'image',
                'accept' => 'image/*',
                'multiple' => true,
                'id'=>'image',
            ],
            'pluginOptions' => [
//            'previewFileType' => 'image',
                'overwriteInitial' => false,
                'maxFileSize' => 1000000,
                'removeClass' => 'btn btn-danger',
                'removeIcon' => '<i class="glyphicon glyphicon-trash"></i>'
            ]
        ]);
        ?>
    </div>
    
        <div class="col-lg-12">
        <?php
        echo $form->field($model, 'video[]')->widget(FileInput::classname(), [
            'options' => [
                   'id'=>'video',
                'accept' => 'video/*',
                'multiple' => false,
          
            ],
            'pluginOptions' => [
//            'previewFileType' => 'image',
                'overwriteInitial' => false,
                'maxFileSize' => 1000000,
                'removeClass' => 'btn btn-danger',
                'removeIcon' => '<i class="glyphicon glyphicon-trash"></i>'
            ]
        ]);
        ?>
    </div>

    <?PHP // $form->field($model, 'r_admin')->textInput() ?>

    <?PHP //$form->field($model, 'creation_date')->textInput() ?>

    <?PHP // $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?PHP // $form->field($model, 'game')->textInput() ?>

    <?PHP // $form->field($model, 'category')->textInput(['maxlength' => true]) ?>

    <?PHP // $form->field($model, 'mention')->textInput() ?>

    <?PHP // $form->field($model, 'mention2')->textInput() ?>

    <?PHP // $form->field($model, 'mention3')->textInput() ?>

    <?PHP // $form->field($model, 'accept1')->textInput() ?>

    <?PHP // $form->field($model, 'accept2')->textInput() ?>

    <?PHP // $form->field($model, 'accept3')->textInput() ?>

    <?PHP // $form->field($model, 'color1')->textInput(['maxlength' => true]) ?>

    <?PHP // $form->field($model, 'color2')->textInput(['maxlength' => true]) ?>

    <?PHP // $form->field($model, 'video_thumbnail')->textInput(['maxlength' => true]) ?>

    <?PHP // $form->field($model, 'challenge_coins')->textInput() ?>

    <?PHP // $form->field($model, 'is_challenge_finished')->textInput() ?>

    <?PHP // $form->field($model, 'challenge_winner')->textInput() ?>

    <?PHP // $form->field($model, 'streamer_response')->textInput() ?>

        <?PHP // $form->field($model, 'invitation_response')->textInput()  ?>

        <?PHP //  $form->field($model, 'challenge_date')->textInput() ?>

    <div class="form-group" style="text-align: center;">
        <?= Html::submitButton(Yii::t('app', 'POST'), ['class' => 'btn ', 'style' => 'background: rgb(127,71,221);
     background: linear-gradient(184deg, rgba(127,71,221,1) 45%, rgba(47,15,101,1) 100%, rgba(218,238,225,1) 100%);color:white;    padding: 12px;
    border-radius: 30px;
    padding-left: 30px;
    padding-right: 30px; 
        FONT-WEIGHT: bold;
    FONT-SIZE:15PX']) ?>
    </div>

<?php ActiveForm::end(); ?>



</div>
<?php
JSRegister::begin([
    'id' => '1'
]);
?>
<script>
      $(".field-video").hide();
    $("#rooms-type").on("change", function () {

        var type = $("#rooms-type").val();

        if (type == "pictures") {
          

            $(".field-video").hide();
            $(".field-image").show();
        } else  if (type == "video") {
           

                  $(".field-image").hide();
                    $(".field-video").show();
        }
//            $("#activities-c_executing_party").val(textSelected);
//            console.log("full");

        
    });
</script>

<?php JSRegister::end(); ?>