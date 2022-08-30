<?php

use app\models\UsersSearch;
use richardfan\widget\JSRegister;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;

/* @var $this View */
/* @var $searchModel UsersSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index"  style="background: white; padding-left: 20px;padding-right: 20px; padding-top: 5px;border-radius: 10px; margin-bottom: 10px;">

    <h2 class="pull-left"><?= Html::encode($this->title) ?></h2>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>


    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{items}\n{summary}\n{pager}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'fullname',
//            'password:ntext',
            'username',
            'phone',
            //'email:email',
            //'address',
            //'birthday',
            //'gender',
            //'work',
            //'hashtags',
            //'role',
            //'token',
            //'link_facebook',
            //'link_youtube',
            //'link_instagram',
            //'link_tiktok',
            //'profile_picture',
            //'is_approved',
            'coins',
            //'bio:ntext',
            //'tags:ntext',
            //'created_at',
            //'updated_at',
            //'status',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            //'access_token',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($model) {
                    if ($model->status == 10) {
                        return '<button id="' . $model->id . '" class="btn btn-success activeAndInactive activeBtn">Active</button>';
                    } else {
                        return '<button id="' . $model->id . '" class="btn btn-danger activeAndInactive inactiveBtn">Inactive</button>';
                    }
                }
            ]
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>

<?php
JSRegister::begin([
    'id' => '1'
]);
?>
<script>
    $(".activeAndInactive").on('click', function () {
        var activeAndInactive = $(this);
        var id = $(this).attr('id');
        let text = "Are you sure?";
        if (confirm(text) == true) {
            if ($(this).hasClass('activeBtn')) {


                $.ajax({
                    url: '<?php echo Url::toRoute("/api/mobile/make-user-inactive") ?>',
                    type: "POST",
                    data: {
                        'id': id,
                    },
                    success: function (data) {
                        console.log(data);
                        if (data == true) {
                            activeAndInactive.removeClass("activeBtn");
                            activeAndInactive.addClass("inactiveBtn");
                            activeAndInactive.removeClass("btn-success");
                            activeAndInactive.addClass("btn-danger");
                            activeAndInactive.text("Inactive");
                        } else {
                        }
                    },
                    error: function (errormessage) {
                        console.log("not working");
                    }
                });
            } else if ($(this).hasClass('inactiveBtn')) {
                $.ajax({
                    url: '<?php echo Url::toRoute("/api/mobile/make-user-active") ?>',
                    type: "POST",
                    data: {
                        'id': id,
                    },
                    success: function (data) {
                        console.log(data);
                        if (data == true) {
                            activeAndInactive.removeClass("inactiveBtn");
                            activeAndInactive.addClass("activeBtn");
                            activeAndInactive.removeClass("btn-danger");
                            activeAndInactive.addClass("btn-success");
                            activeAndInactive.text("Active");
                        } else {
                        }
                    },
                    error: function (errormessage) {
                        console.log("not working");
                    }
                });
            }
        } else {
        }
    });



</script>

<?php
JSRegister::end();
?>
