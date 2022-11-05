<?php
/* @var $this View */
/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use lo\widgets\modal\ModalAjax;
use mdm\admin\components\MenuHelper;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);

Yii::$app->name = "The Leader World of Talents";

echo ModalAjax::widget([
    'id' => 'my-ajax',
    'selector' => '.my-ajax', // all buttons in grid view with href attribute
    'options' => ['class' => 'header-default', 'tabindex' => false],
    'pjaxContainer' => '#grid-pjax',
    'autoClose' => true,
    'size' => ModalAjax::SIZE_LARGE,
]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
    <!--    <head>
            <script data-ad-client="ca-pub-4259799291168125" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <meta charset="<?= Yii::$app->charset ?>">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
            <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>


        </head>-->

    <header>
        <?php $this->head() ?>

        <?php
        NavBar::begin([
//            'brandLabel' => Yii::$app->name,
            'brandOptions' => [
                'style' => 'padding-top:0px;!important'
            ],
            'brandLabel' => '
                    <svg
                        style="height: 50px;width: 30px;    margin-left: 0px;
                        "
                        xmlns="http://www.w3.org/2000/svg" width="76.867" height="62.679" viewBox="0 0 76.867 62.679">
                    <g id="Group_73" data-name="Group 73" transform="translate(0 0)">
                    <g id="Group_72" data-name="Group 72" transform="translate(0 0)">
                    <g id="Group_71" data-name="Group 71">
                    <path id="Path_90" data-name="Path 90" d="M-7185.074,2139.162l-4.484-4.44a43.9,43.9,0,0,0-.127,54.736l4.5-4.418a37.942,37.942,0,0,1-7.727-22.958A37.933,37.933,0,0,1-7185.074,2139.162Z" transform="translate(7199.196 -2130.838)" fill="#fff"/>
                    <path id="Path_91" data-name="Path 91" d="M-7097.354,2133.554a32.053,32.053,0,0,0-21.771-8.555h0a31.717,31.717,0,0,0-21.785,8.458l23.12,22.877-23.226,22.789a32.127,32.127,0,0,0,44.951-1.266A31.022,31.022,0,0,0-7097.354,2133.554Zm-7.111,29.689a6.918,6.918,0,0,1-6.96-6.874,6.917,6.917,0,0,1,6.975-6.859,6.917,6.917,0,0,1,6.959,6.873A6.92,6.92,0,0,1-7104.465,2163.243Z" transform="translate(7164.254 -2124.999)" fill="#fff"/>
                    <path id="Path_92" data-name="Path 92" d="M-7159.052,2176.5h0a24.424,24.424,0,0,1,4-13.361l-4.516-4.473a30.665,30.665,0,0,0-.083,35.665l4.537-4.451A24.385,24.385,0,0,1-7159.052,2176.5Z" transform="translate(7178.852 -2145.216)" fill="#fff"/>
                    <path id="Path_93" data-name="Path 93" d="M-7129.434,2182.956a17.382,17.382,0,0,0-.038,16.3l8.286-8.128Z" transform="translate(7158.527 -2159.807)" fill="#fff"/>
                    </g>
                    </g>
                    </g>
                    </svg>

                    <label style="color: white;
                           font-weight: bold;
                           font-size: 20px;
                           font-family: Myriad Pro Bold;
                           margin-top: 15px;
                           vertical-align: top;
                           margin-left: 11px;">StreaMe</label>',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-fixed-top navbar navbar-expand-md navbar-dark bg-dark fixed-top',
                'style' => "background: rgb(127,71,221);background: linear-gradient(184deg, rgba(127,71,221,1) 45%, rgba(47,15,101,1) 100%, rgba(218,238,225,1) 100%)"
            ],
        ]);
        echo
        Nav::widget([
            'options' => ['class' => 'navbar-nav pull-left'],
            'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id)
        ]);
        echo
        Nav::widget([
            'options' => ['class' => 'navbar-nav pull-right'],
            'items' => [
                '<a style="vertical-align: sub;" class="my-ajax" title="Create" href="' . \yii\helpers\Url::to(['rooms/create']) . '"><svg xmlns="http://www.w3.org/2000/svg" width="41.144" height="41.144" viewBox="0 0 30 30">
  <g id="noun_Plus_201304" transform="translate(-2 -2)">
    <g id="Group_42" data-name="Group 42" transform="translate(2 2)">
      <g id="Group_41" data-name="Group 41">
        <path id="Path_4" data-name="Path 4" d="M10,14a1,1,0,0,0,1-1V11h2a1,1,0,0,0,0-2H11V7A1,1,0,0,0,9,7V9H7a1,1,0,0,0,0,2H9v2A1,1,0,0,0,10,14Z" transform="translate(0.677 0.677)" fill="#fff"/>
        <path id="Path_5" data-name="Path 5" d="M12.677,2a10.677,10.677,0,1,0,5.489,19.825,1.335,1.335,0,0,0-1.376-2.288,8.035,8.035,0,1,1,2.745-2.745,1.335,1.335,0,0,0,2.289,1.375A10.664,10.664,0,0,0,12.677,2Z" transform="translate(-2 -2)" fill="#fff"/>
      </g>
    </g>
  </g>
</svg>
</a>'
                ,
//                '<a href="/streame2/web/index.php">
                '<a href="' . \yii\helpers\Url::to(['site/index']) . '">
                    <svg


                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="41.144" height="45" viewBox="0 0 41.144 45">
                    <defs>
                    <filter id="Path_1" x="0" y="0" width="41.144" height="45" filterUnits="userSpaceOnUse">
                        <feOffset dy="3" input="SourceAlpha"/>
                        <feGaussianBlur stdDeviation="3" result="blur"/>
                        <feFlood flood-opacity="0.161"/>
                        <feComposite operator="in" in2="blur"/>
                        <feComposite in="SourceGraphic"/>
                    </filter>
                    </defs>
                    <g id="Group_2" data-name="Group 2" transform="translate(9 6)">
                    <g id="Group_1" data-name="Group 1">
                    <g transform="matrix(1, 0, 0, 1, -9, -6)" filter="url(#Path_1)">
                    <path id="Path_1-2" data-name="Path 1" d="M48.717,53.43h3.211a.646.646,0,0,0,.645-.638V41.852a3.567,3.567,0,0,0-.913-2.192l-7.629-7.629a.648.648,0,0,0-.917,0L35.484,39.66a3.573,3.573,0,0,0-.913,2.192l-.006,11.572C34.565,53.776,48.354,53.43,48.717,53.43ZM34.565,56A2.567,2.567,0,0,1,32,53.424V42.084a7.135,7.135,0,0,1,1.821-4.4l7.93-7.93a2.574,2.574,0,0,1,3.642,0l7.93,7.93a7.124,7.124,0,0,1,1.821,4.4v11.34A2.571,2.571,0,0,1,52.578,56Z" transform="translate(-23 -23)" fill="#f15a24"/>
                    </g>
                    </g>
                    </g>
                    </svg>
                    </a>',
                '<a href="' . \yii\helpers\Url::to(['site/login']) . '">
                    <svg


                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="46.252" height="45" viewBox="0 0 46.252 45">
                    <defs>
                    <filter id="Path_88" x="0" y="0" width="46.252" height="45" filterUnits="userSpaceOnUse">
                        <feOffset dy="3" input="SourceAlpha"/>
                        <feGaussianBlur stdDeviation="3" result="blur"/>
                        <feFlood flood-opacity="0.161"/>
                        <feComposite operator="in" in2="blur"/>
                        <feComposite in="SourceGraphic"/>
                    </filter>
                    </defs>
                    <g id="Group_70" data-name="Group 70" transform="translate(9 6)">
                    <g transform="matrix(1, 0, 0, 1, -9, -6)" filter="url(#Path_88)">
                    <path id="Path_88-2" data-name="Path 88" d="M287.768,811.424h9.891c.065,0,.13,0,.195,0a1.1,1.1,0,0,1,1.163.764c.278.676.584,1.341.881,2.009.517,1.164,1.044,2.324,1.553,3.492a4.376,4.376,0,0,1,.183,3.294,4.474,4.474,0,0,1-1.76,2.2c-.453.315-.379.15-.38.716q0,5.866,0,11.732a2.969,2.969,0,0,1-.4,1.593,2.386,2.386,0,0,1-1.944,1.16c-.522.042-1.049.033-1.573.033q-8.263,0-16.527,0a5.162,5.162,0,0,1-1.02-.08,2.452,2.452,0,0,1-1.979-2.343c-.025-.618-.026-1.238-.026-1.857q0-5.167,0-10.334a.506.506,0,0,0-.18-.412,14.658,14.658,0,0,1-1.262-1.237,3.83,3.83,0,0,1-.6-4.2c.815-1.954,1.7-3.879,2.54-5.822a1.1,1.1,0,0,1,1.122-.717Q282.707,811.429,287.768,811.424Zm-10.193,18.613q0,2.256,0,4.512c0,.442-.007.885.005,1.327a.956.956,0,0,0,.853.973,2.332,2.332,0,0,0,.388.021q2.318,0,4.636,0c.273,0,.274,0,.274-.27q0-4.3,0-8.6a3.429,3.429,0,0,1,.026-.511.669.669,0,0,1,.639-.645,1.688,1.688,0,0,1,.281-.027q3.052,0,6.1,0a2.172,2.172,0,0,1,.438.052.594.594,0,0,1,.5.492,3.1,3.1,0,0,1,.056.579q.005,3.734,0,7.468c0,.424.021.849.025,1.273,0,.143.055.193.2.193,1.575,0,3.15,0,4.724-.005.9,0,1.236-.353,1.236-1.256q0-5.1,0-10.193c0-.383,0-.767-.006-1.15,0-.243-.023-.259-.258-.285-.211-.023-.422-.05-.633-.07a4.437,4.437,0,0,1-1.974-.617c-.245-.153-.5-.293-.744-.446a.247.247,0,0,0-.319.011,6.2,6.2,0,0,1-.608.395,4.491,4.491,0,0,1-3.5.549,5.45,5.45,0,0,1-1.956-1,.262.262,0,0,0-.392-.008,6.27,6.27,0,0,1-.811.535,4.422,4.422,0,0,1-2.843.578,5.177,5.177,0,0,1-2.324-.983.386.386,0,0,0-.5-.021,5.745,5.745,0,0,1-1.673.83c-.522.115-1.058.169-1.589.243-.255.036-.257.029-.257.287Q277.575,827.152,277.575,830.037Zm-1.642-12.73h23.653c-.027-.077-.043-.132-.066-.184-.585-1.315-1.173-2.628-1.752-3.945a.284.284,0,0,0-.306-.2q-9.7.006-19.409,0a.285.285,0,0,0-.307.2c-.477,1.1-.962,2.192-1.445,3.288C276.182,816.734,276.065,817,275.932,817.307Zm11.8,1.61h-7.2c-1.669,0-3.338,0-5.007,0-.18,0-.249.062-.277.233a2.589,2.589,0,0,0,.223,1.619,3.048,3.048,0,0,0,3.092,1.613,2.524,2.524,0,0,0,1.8-1c.09-.123.156-.263.234-.4a.675.675,0,0,1,1.077-.218,1.906,1.906,0,0,1,.331.364,3.042,3.042,0,0,0,4.415.576,4.742,4.742,0,0,0,.664-.705.768.768,0,0,1,1.376.043.639.639,0,0,0,.05.073,5.912,5.912,0,0,0,.595.625,2.973,2.973,0,0,0,2.484.588A2.86,2.86,0,0,0,293.632,821a1.052,1.052,0,0,1,.182-.215.676.676,0,0,1,1.016.063c.064.076.1.171.167.249.19.238.583.7.583.7s3.291.7,4.225-.629a2.453,2.453,0,0,0,.487-1.9c-.061-.341-.08-.352-.422-.352Zm2.476,13.715q0-1.99,0-3.979c0-.245,0-.246-.246-.246h-4.422c-.247,0-.248,0-.249.244q0,3.971,0,7.942c0,.244,0,.245.246.245h4.422c.247,0,.248,0,.248-.243Q290.21,834.613,290.209,832.632Z" transform="translate(-264.62 -805.42)" fill="#fff"/>
                    </g>
                    </g>
                    </svg>
                    </a>',
//                '<a href="/streame2/web/site/profile">
                '<a href="' . \yii\helpers\Url::to(['site/profile']) . '">
                    
                    <svg
                        style="
                        "
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="45" height="45" viewBox="0 0 45 45">
                    <defs>
                    <pattern id="pattern" preserveAspectRatio="xMidYMid slice" width="100%" height="100%" viewBox="0 0 1940 1946">
                     </pattern>
                    <filter id="_109943543_3420005031367562_7842161415506186964_o" x="0" y="0" width="45" height="45" filterUnits="userSpaceOnUse">
                        <feOffset dy="3" input="SourceAlpha"/>
                        <feGaussianBlur stdDeviation="3" result="blur"/>
                        <feFlood flood-opacity="0.161"/>
                        <feComposite operator="in" in2="blur"/>
                        <feComposite in="SourceGraphic"/>
                    </filter>
                    </defs>
                    <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#_109943543_3420005031367562_7842161415506186964_o)">
                    <g id="_109943543_3420005031367562_7842161415506186964_o-2" data-name="109943543_3420005031367562_7842161415506186964_o" transform="translate(9 6)" stroke="#fff" stroke-width="1" fill="url(#pattern)">
                    <circle cx="13.5" cy="13.5" r="13.5" stroke="none"/>
                    <circle cx="13.5" cy="13.5" r="13" fill="none"/>
                    </g>
                    </g>
                    </svg>
                    </a>',
                //                ['label' => 'Home', 'url' => ['/site/index']],
//                ['label' => 'About', 'url' => ['/site/about']],
//                ['label' => 'Contact', 'url' => ['/site/contact']],
//                Yii::$app->user->isGuest ? (
//                        []
//                        ) : (
//                        '<li>'
//                        . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
//                        . Html::submitButton(
//                                'Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout']
//                        )
//                        . Html::endForm()
//                        . '</li>'
//                        )
//            ,
                Yii::$app->user->isGuest ? (
                        ['label' => 'Login', 'url' => ['/site/login']]
                        ) : (
                        '<li style="font-size:0px;">'
                        . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                        . Html::submitButton(
                                'Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm()
                        . '</li>'
                        )
            ],
        ]);
        NavBar::end();
        ?>
        <header>
            <?php $this->head() ?>

            <?php
            ?>
        </header>
        <body style="background: #dadada;">
            <?php $this->beginBody() ?>

            <div class="wrap">

                <div class="container col-lg-10 col-lg-offset-1" style="margin-top: 60px;">
                    <?=
                    Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ])
                    ?>
                    <?= Alert::widget() ?>
                    <?= $content ?>
                                    <!--<a  href=https://play.google.com/store/apps/details?id=com.hadi.room><img width="50%" src="-->
                    <?php
//                                    echo Url::base() . '/google-play-badge.png'
                    ?>
                    <!--"></a>-->

                </div>
            </div>

            <?php $this->endBody() ?>
        </body>
</html>
<?php $this->endPage() ?>
