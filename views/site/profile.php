<?php

use lo\widgets\modal\ModalAjax;
use richardfan\widget\JSRegister;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\web\View;

/** @var View $this */
$this->title = 'My Yii Application';
?>




<style>



</style>


<div class="site-index row " style="background: purple; padding: 10px;border-radius: 10px;background: rgb(127,71,221);
     background: linear-gradient(184deg, rgba(127,71,221,1) 45%, rgba(47,15,101,1) 100%, rgba(218,238,225,1) 100%);   ">
    <div class=" col-lg-6 col-lg-offset-3 " style="background: white; padding: 20px;border-radius: 10px; margin-bottom: 50px;
         align-items: center;;" >
        <div class=" center" style="text-align: -webkit-center;">
            <div style="     text-align: -webkit-center;
                 ">
                <img style="margin-top: 50px;; border: 5px solid  rgb(127,71,221); border-radius: 50%;" 
                     width="100" 
                     height="100" 
                     class="rounded-circle center" src="http://<?= Yii::$app->params['domain'] ?>/profilePicture/LbZFyvwd1Qgs5szxdTm2DJoKO635nXmn.jpeg">
            </div>
            <h3 class="center" style="color: black;
                font-weight: bold;
                font-size: 20px;
                font-family: Myriad Pro Bold;" ><?= $user['fullname'] ?> </h3>
            <h4 style="color: #515db4;
                font-weight: bold;
                font-size: 16px;
                font-family: Myriad Pro Bold;" ><?= $user['tags'] ?></h4>
            <h4 style="color: black;
                font-weight: bold;
                font-size: 16px;
                font-family: Myriad Pro Bold;" ><?= $user['bio'] ?></h4>


            <?php
//                                \yii\helpers\VarDumper::dump($user,3,3);
//                die();
            if (Yii::$app->user->id != $user['id']) {
                ?>
                <button  class="button button1 followAndUnfollow  <?php if ($following)
                echo 'unfollowBtn';
            else
                echo 'followBtn';
            ?>" style="  background-color: #04AA6D; /* Green */

                         border: none;
                         color: white;
                         background: linear-gradient(184deg, rgba(127,71,221,1) 45%, rgba(47,15,101,1) 100%, rgba(218,238,225,1) 100%);
                         width: 100px;
                         height: 30px;
                         text-align: center;
                         text-decoration: none;
                         display: inline-block;
                         font-size: 16px;


                         cursor: pointer;border-radius: 20px;
                         "
                         id="<?= $user["id"] ?>"
                         ><?php
//                \yii\helpers\VarDumper::dump($following,3,3);
//                die();
                             if ($following)
                                 echo 'Unfollow';
                             else
                                 echo 'Follow'
                                 ?>
                </button>
<?php } ?>
            <br><!-- comment -->
            <br>
            <div class="row" >
                <div class="col-sm-4">
                    <div class="" >
                        <p style=" font-weight: bold;
                           font-size: 16px;
                           font-family: Myriad Pro Bold;"><?= $user['numberOfPosts'] ?></p>
                        <p style=" font-weight: bold;
                           font-size: 16px;
                           font-family: Myriad Pro Bold;">Posts</p>


                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="">

                        <p style=" font-weight: bold;
                           font-size: 16px;
                           font-family: Myriad Pro Bold;"><?= $user['numberOfFollowers'] ?></p>

                        <p style=" font-weight: bold;
                           font-size: 16px;
                           font-family: Myriad Pro Bold;">Followers</p>


                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="">


                        <p style=" font-weight: bold;
                           font-size: 16px;
                           font-family: Myriad Pro Bold;"><?= $user['coins'] ?></p>

                        <p style=" font-weight: bold;
                           font-size: 16px;
                           font-family: Myriad Pro Bold;">TLC</p>



                    </div>
                </div>
            </div>

        </div>
    </div>



<?php
for ($i = 0; $i < sizeof($rooms); $i++) {


//       echo $roomss[$i]['files'];
    ?>

    <!--<a href="-->
    <?php
//                Url::to(['/site/post', 'postId' => $rooms[$i]["id"]]) 
    ?>
    <!--">view post</a>-->
    <?php
    if ($rooms[$i]["type"] == "pictures") {
        $imagesArray = explode(',', $rooms[$i]["files"]);
        ?>

        <div class="col-lg-6 col-lg-offset-3" style="background: white; padding: 2px;border-radius: 10px; margin-bottom: 10px;" >

            <div
                style="margin-top: 10px;margin-bottom: 10px; margin-left: 10px;
                ">
                  <a href="<?= Url::to(['/site/visit-profile', 'userId' => $rooms[$i]["r_admin"]]) ?>">
                <div style="display:inline-block;vertical-align:top;">
                    <img
                        width="50"
                        height="50"
                        class="rounded-circle"
                        style="border-radius: 50%;"
                        src="<?= "http://" . Yii::$app->params['domain'] . "/profilePicture/" . $rooms[$i]["profile_picture"] ?>"
                        />
                </div>
                  </a>
                <div style="display:inline-block;">
                    <div style="padding: 0px;"><span style="font-weight: bold; font-size: 14px;"><?= $rooms[$i]["fullname"] ?></span></div>
                    <div style="font-size: 14px;font-family:'Myriad Pro Regular';"><?= $rooms[$i]["challenge_coins"] ?></div>
                </div>

                <svg
                    style="float: right;
                    margin: 10px;
                    transform: rotate(-45deg);"
                    xmlns="http://w3.org/2000/svg" width="15.575" height="15.18" viewBox="0 0 15.575 15.18">
                    <path id="Path_13" data-name="Path 13" d="M14.654,6.121,2.343.163A1.632,1.632,0,0,0,.117,2.238L2.258,7.589.117,12.941a1.632,1.632,0,0,0,2.226,2.076L14.654,9.058a1.632,1.632,0,0,0,0-2.937ZM1.128,1.834a.53.53,0,0,1,.134-.6.527.527,0,0,1,.608-.092l12.2,5.9H3.212Zm.742,12.2a.544.544,0,0,1-.742-.692L3.212,8.133H14.069Z" fill="#909090"/>
                </svg>


            </div>

            <section id="splideId<?= $i ?>" class="splide" aria-label="" style="height: fit-content;">
                <div class="splide__track">
                    <ul class="splide__list">

                        <?php for ($j = 0; $j < sizeof($imagesArray); $j++) { ?>
                            <li class="splide__slide">
                                <img
                                    style="background: black;width: 100%; height: 500px;border-radius: 10px; object-fit: contain;"
                                    class=""
                                    src="<?= "http://" . Yii::$app->params['domain'] . "/postPictures/" . $imagesArray[$j] ?>"
                                    />
                            </li>
                        <?php } ?>
                    </ul>
                </div>



                <?php
                if ($rooms[$i]["category"] == "donate") {
                    ?>

                    <?php
                } else if ($rooms[$i]["category"] == "challenge") {
                    ?>

                    <?php
                } else {
//                    \yii\helpers\VarDumper::dump($rooms[$i],3,3);
//                    die();
                    if (!Yii::$app->user->isGuest) {
                        if ($rooms[$i]['room_id_liked'] == $rooms[$i]['id']) {
                            ?>    <svg
                                class="unlikeBtn likeAndUnlike"
                                id="<?= $rooms[$i]["id"] ?>"
                                style="position: absolute;
                                bottom: 120px;
                                left: 30px;"
                                xmlns="http://w3.org/2000/svg" xmlns:xlink="http://w3.org/1999/xlink" width="59" height="59" viewBox="0 0 59 59">
                                <defs>
                                    <filter id="Ellipse_18" x="0" y="0" width="59" height="59" filterUnits="userSpaceOnUse">
                                        <feOffset dy="3" input="SourceAlpha"/>
                                        <feGaussianBlur stdDeviation="5" result="blur"/>
                                        <feFlood flood-opacity="0.212"/>
                                        <feComposite operator="in" in2="blur"/>
                                        <feComposite in="SourceGraphic"/>
                                    </filter>
                                </defs>
                                <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#Ellipse_18)">
                                    <circle id="Ellipse_18-2" data-name="Ellipse 18" cx="14.5" cy="14.5" r="14.5" transform="translate(15 12)" fill="#f15a24"/>
                                </g>
                                <path id="Union_1" data-name="Union 1" d="M5.555,10.271C2.868,8.591,0,6.575,0,3.907,0,1.342,1.674,0,3.327,0A3.2,3.2,0,0,1,5.866,1.269,3.2,3.2,0,0,1,8.4,0c1.653,0,3.327,1.342,3.327,3.907,0,2.668-2.867,4.684-5.555,6.363a.587.587,0,0,1-.621,0Z" transform="translate(24.018 21.239)" fill="#fff"/>
                            </svg>
                            <?php
                        } else {
                            ?>
                            <svg
                                class="likeBtn likeAndUnlike"
                                id="<?= $rooms[$i]["id"] ?>"




                                style="position: absolute;
                                bottom: 120px;
                                left: 30px;"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="59" height="59" viewBox="0 0 59 59">
                                <defs>
                                    <filter id="Path_124" x="0" y="0" width="59" height="59" filterUnits="userSpaceOnUse">
                                        <feOffset dy="3" input="SourceAlpha"/>
                                        <feGaussianBlur stdDeviation="5" result="blur"/>
                                        <feFlood flood-opacity="0.212"/>
                                        <feComposite operator="in" in2="blur"/>
                                        <feComposite in="SourceGraphic"/>
                                    </filter>
                                </defs>
                                <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#Path_124)">
                                    <path id="Path_124-2" data-name="Path 124" d="M14.5,0A14.5,14.5,0,1,1,0,14.5,14.5,14.5,0,0,1,14.5,0Z" transform="translate(15 12)" fill="#f15a24"/>
                                </g>
                                <path id="Union_1" data-name="Union 1" d="M5.555,10.271C2.867,8.59,0,6.575,0,3.908,0,1.342,1.674,0,3.327,0A3.2,3.2,0,0,1,5.865,1.269,3.2,3.2,0,0,1,8.4,0c1.653,0,3.326,1.342,3.326,3.908,0,2.668-2.866,4.683-5.554,6.363a.587.587,0,0,1-.622,0ZM1.173,3.908c0,2.114,2.9,4.044,4.693,5.173,1.8-1.129,4.693-3.059,4.693-5.173,0-1.879-1.117-2.735-2.154-2.735A2.162,2.162,0,0,0,6.41,2.659a.587.587,0,0,1-1.089,0A2.161,2.161,0,0,0,3.327,1.173C2.29,1.173,1.173,2.029,1.173,3.908Z" transform="translate(24.018 21.239)" fill="#fff"/>
                            </svg>

                            <?php
                        }
                    }
                    ?>




                    <?php
                }
                ?>


                <a href="<?= Url::to(['/site/post', 'postId' => $rooms[$i]["id"]]) ?>">
                    <svg
                        style="position: absolute;
                        bottom: 120px;
                        right: 30px;"
                        xmlns="http://w3.org/2000/svg" xmlns:xlink="http://w3.org/1999/xlink" width="59" height="59" viewBox="0 0 59 59">
                        <defs>
                            <filter id="Ellipse_20" x="0" y="0" width="59" height="59" filterUnits="userSpaceOnUse">
                                <feOffset dy="3" input="SourceAlpha"/>
                                <feGaussianBlur stdDeviation="5" result="blur"/>
                                <feFlood flood-opacity="0.212"/>
                                <feComposite operator="in" in2="blur"/>
                                <feComposite in="SourceGraphic"/>
                            </filter>
                        </defs>
                        <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#Ellipse_20)">
                            <circle id="Ellipse_20-2" data-name="Ellipse 20" cx="14.5" cy="14.5" r="14.5" transform="translate(15 12)" fill="#fff"/>
                        </g>
                        <g id="noun_chat_1079099" transform="translate(22.655 19.191)">
                            <g id="Group_40" data-name="Group 40">
                                <path id="Path_3" data-name="Path 3" d="M15.374,11A6.779,6.779,0,0,0,8.4,17.538a6.779,6.779,0,0,0,6.974,6.538,7.331,7.331,0,0,0,3.319-.788l2.23,1.207a.752.752,0,0,0,.319.084.723.723,0,0,0,.4-.134.682.682,0,0,0,.251-.671l-.6-2.783a6.246,6.246,0,0,0,1.056-3.454A6.779,6.779,0,0,0,15.374,11Zm4.661,9.456a.679.679,0,0,0-.117.536l.352,1.643L19,21.948a.652.652,0,0,0-.654.017,5.976,5.976,0,0,1-2.967.771,5.437,5.437,0,0,1-5.633-5.2,5.437,5.437,0,0,1,5.633-5.2,5.437,5.437,0,0,1,5.633,5.2A4.917,4.917,0,0,1,20.035,20.456Z" transform="translate(-8.4 -11)" fill="#181818"/>
                            </g>
                        </g>
                    </svg>


                </a>
            </section>


            <div style="margin: 10px;">
                <label
                    style="font-weight: bold;font-family:'Myriad Pro Regular';"><?= $rooms[$i]['number_of_likes'] . " Likes" ?></label>
                <br/>
                <label
                    style="font-weight: bold;font-family:'Myriad Pro Regular';"><?= $rooms[$i]['title'] ?></label>
                <br/>
                <label style="font-family:'Myriad Pro Regular';"><?= $rooms[$i]['c_text'] ?></label>
                <?php if ($rooms[$i]['last_comment'] != null) {
                    ?>
                    <br/>
                    <label style="font-family:'Myriad Pro Regular';"><?= $rooms[$i]['last_comment'] ?></label>
                    <?php
                }
                ?>
            </div>


        </div>


        <?php
        JSRegister::begin([
            'id' => $i,
            'position' => View::POS_READY
        ])
        ?>
        <script>
            //            new Splide('.splide').mount();
            new Splide('#splideId<?= $i ?>').mount();
        </script>
        <?php JSRegister::end() ?>

        <?php
    }
    if ($rooms[$i]["type"] == "video") {
        ?>

        <div class="col-lg-6 col-lg-offset-3" style="background: white; padding: 2px;border-radius: 10px; margin-bottom: 10px;">

            <div
                style="margin-top: 10px;margin-bottom: 10px; margin-left: 10px;
                
                ">
                 <a href="<?= Url::to(['/site/visit-profile', 'userId' => $rooms[$i]["r_admin"]]) ?>">
                <div style="display:inline-block;vertical-align:top;">
                    <img
                        style="border-radius: 50%;"
                        width="50"
                        height="50"
                        class="rounded-circle"
                        src="<?= "http://" . Yii::$app->params['domain'] . "/profilePicture/" . $rooms[$i]["profile_picture"] ?>"
                        />
                </div>
                 </a>
                <div style="display:inline-block;">
                    <div style="padding: 0px;"><span style="font-weight: bold;font-family:'Myriad Pro Regular'; font-size: 14px;"><?= $rooms[$i]["fullname"] ?></span></div>
                    <div style="font-size: 14px;font-family:'Myriad Pro Regular';"></div>
                </div>

                <svg
                    style="float: right;
                    transform: rotate(-45deg);
                    margin: 10px;"
                    xmlns="http://w3.org/2000/svg" width="15.575" height="15.18" viewBox="0 0 15.575 15.18">
                    <path id="Path_13" data-name="Path 13" d="M14.654,6.121,2.343.163A1.632,1.632,0,0,0,.117,2.238L2.258,7.589.117,12.941a1.632,1.632,0,0,0,2.226,2.076L14.654,9.058a1.632,1.632,0,0,0,0-2.937ZM1.128,1.834a.53.53,0,0,1,.134-.6.527.527,0,0,1,.608-.092l12.2,5.9H3.212Zm.742,12.2a.544.544,0,0,1-.742-.692L3.212,8.133H14.069Z" fill="#909090"/>
                </svg>


            </div>





            <div class="splide__track">


                <video   style="background: black ;width: 100%; height: 500px;border-radius: 10px; object-fit: contain;" controls>
                    <source src="<?= "http://" . Yii::$app->params['domain'] . "/videoUploads/" . $rooms[$i]["files"] ?>" type="video/mp4">

                        Your browser does not support the video tag.
                </video>




                <?php
                if ($rooms[$i]["category"] == "donate") {
                    ?>
                    <?php
                } else if ($rooms[$i]["category"] == "challenge") {
                    ?>

                    <?php
                } else {

                    if (!Yii::$app->user->isGuest) {
                        if ($rooms[$i]['room_id_liked'] == $rooms[$i]['id']) {
                            ?>    <svg
                                class="unlikeBtn likeAndUnlike"
                                id="<?= $rooms[$i]["id"] ?>"
                                style="position: absolute;
                                bottom: 120px;
                                left: 30px;"
                                xmlns="http://w3.org/2000/svg" xmlns:xlink="http://w3.org/1999/xlink" width="59" height="59" viewBox="0 0 59 59">
                                <defs>
                                    <filter id="Ellipse_18" x="0" y="0" width="59" height="59" filterUnits="userSpaceOnUse">
                                        <feOffset dy="3" input="SourceAlpha"/>
                                        <feGaussianBlur stdDeviation="5" result="blur"/>
                                        <feFlood flood-opacity="0.212"/>
                                        <feComposite operator="in" in2="blur"/>
                                        <feComposite in="SourceGraphic"/>
                                    </filter>
                                </defs>
                                <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#Ellipse_18)">
                                    <circle id="Ellipse_18-2" data-name="Ellipse 18" cx="14.5" cy="14.5" r="14.5" transform="translate(15 12)" fill="#f15a24"/>
                                </g>
                                <path id="Union_1" data-name="Union 1" d="M5.555,10.271C2.868,8.591,0,6.575,0,3.907,0,1.342,1.674,0,3.327,0A3.2,3.2,0,0,1,5.866,1.269,3.2,3.2,0,0,1,8.4,0c1.653,0,3.327,1.342,3.327,3.907,0,2.668-2.867,4.684-5.555,6.363a.587.587,0,0,1-.621,0Z" transform="translate(24.018 21.239)" fill="#fff"/>
                            </svg>
                            <?php
                        } else {
                            ?>
                            <svg
                                class="likeBtn likeAndUnlike"
                                id="<?= $rooms[$i]["id"] ?>"




                                style="position: absolute;
                                bottom: 120px;
                                left: 30px;"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="59" height="59" viewBox="0 0 59 59">
                                <defs>
                                    <filter id="Path_124" x="0" y="0" width="59" height="59" filterUnits="userSpaceOnUse">
                                        <feOffset dy="3" input="SourceAlpha"/>
                                        <feGaussianBlur stdDeviation="5" result="blur"/>
                                        <feFlood flood-opacity="0.212"/>
                                        <feComposite operator="in" in2="blur"/>
                                        <feComposite in="SourceGraphic"/>
                                    </filter>
                                </defs>
                                <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#Path_124)">
                                    <path id="Path_124-2" data-name="Path 124" d="M14.5,0A14.5,14.5,0,1,1,0,14.5,14.5,14.5,0,0,1,14.5,0Z" transform="translate(15 12)" fill="#f15a24"/>
                                </g>
                                <path id="Union_1" data-name="Union 1" d="M5.555,10.271C2.867,8.59,0,6.575,0,3.908,0,1.342,1.674,0,3.327,0A3.2,3.2,0,0,1,5.865,1.269,3.2,3.2,0,0,1,8.4,0c1.653,0,3.326,1.342,3.326,3.908,0,2.668-2.866,4.683-5.554,6.363a.587.587,0,0,1-.622,0ZM1.173,3.908c0,2.114,2.9,4.044,4.693,5.173,1.8-1.129,4.693-3.059,4.693-5.173,0-1.879-1.117-2.735-2.154-2.735A2.162,2.162,0,0,0,6.41,2.659a.587.587,0,0,1-1.089,0A2.161,2.161,0,0,0,3.327,1.173C2.29,1.173,1.173,2.029,1.173,3.908Z" transform="translate(24.018 21.239)" fill="#fff"/>
                            </svg>

                            <?php
                        }
                    }
                    ?>
                    <?php
                }
                ?>



                <a href="<?= Url::to(['/site/post', 'postId' => $rooms[$i]["id"]]) ?>">
                    <svg
                        style="position: absolute;
                        bottom: 120px;
                        right: 30px;"
                        xmlns="http://w3.org/2000/svg" xmlns:xlink="http://w3.org/1999/xlink" width="59" height="59" viewBox="0 0 59 59">
                        <defs>
                            <filter id="Ellipse_20" x="0" y="0" width="59" height="59" filterUnits="userSpaceOnUse">
                                <feOffset dy="3" input="SourceAlpha"/>
                                <feGaussianBlur stdDeviation="5" result="blur"/>
                                <feFlood flood-opacity="0.212"/>
                                <feComposite operator="in" in2="blur"/>
                                <feComposite in="SourceGraphic"/>
                            </filter>
                        </defs>
                        <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#Ellipse_20)">
                            <circle id="Ellipse_20-2" data-name="Ellipse 20" cx="14.5" cy="14.5" r="14.5" transform="translate(15 12)" fill="#fff"/>
                        </g>
                        <g id="noun_chat_1079099" transform="translate(22.655 19.191)">
                            <g id="Group_40" data-name="Group 40">
                                <path id="Path_3" data-name="Path 3" d="M15.374,11A6.779,6.779,0,0,0,8.4,17.538a6.779,6.779,0,0,0,6.974,6.538,7.331,7.331,0,0,0,3.319-.788l2.23,1.207a.752.752,0,0,0,.319.084.723.723,0,0,0,.4-.134.682.682,0,0,0,.251-.671l-.6-2.783a6.246,6.246,0,0,0,1.056-3.454A6.779,6.779,0,0,0,15.374,11Zm4.661,9.456a.679.679,0,0,0-.117.536l.352,1.643L19,21.948a.652.652,0,0,0-.654.017,5.976,5.976,0,0,1-2.967.771,5.437,5.437,0,0,1-5.633-5.2,5.437,5.437,0,0,1,5.633-5.2,5.437,5.437,0,0,1,5.633,5.2A4.917,4.917,0,0,1,20.035,20.456Z" transform="translate(-8.4 -11)" fill="#181818"/>
                            </g>
                        </g>
                    </svg>

                </a>

            </div>



            <div style="margin: 10px;">
                <label
                    style="font-weight: bold;font-family:'Myriad Pro Regular';"><?= $rooms[$i]['number_of_likes'] . " Likes" ?></label>
                <br/>
                <label
                    style="font-weight: bold;font-family:'Myriad Pro Regular';"><?= $rooms[$i]['title'] ?></label>
                <br/>
                <label style="font-family:'Myriad Pro Regular';"><?= $rooms[$i]['c_text'] ?></label>
                <?php if ($rooms[$i]['last_comment'] != null) {
                    ?>
                    <br/>
                    <label style="font-family:'Myriad Pro Regular';"><?= $rooms[$i]['last_comment'] ?></label>
                    <?php
                }
                ?>

            </div>


        </div>
    <?php }
    ?>

    <?php
    if ($rooms[$i]["type"] == "text") {

        if ($rooms[$i]["category"] == "challenge") {


            $challengesVideosArray = (isset($rooms[$i]["challengesVideos"])) ? $rooms[$i]["challengesVideos"] : null;
            $videosArray = [];
            if ($challengesVideosArray) {
                for ($k = 0; $k < sizeof($challengesVideosArray); $k++) {
                    $challengeVideo = $challengesVideosArray[$k];
                    if ($challengeVideo["isChallenge"] == "1") {
                        array_push($videosArray, $challengeVideo["challenge"]["file_name"]);
                    }
                }
            }
            ?>
            <div class="col-lg-6 col-lg-offset-3" style="background: white; padding: 2px;border-radius: 10px; margin-bottom: 10px;">

                <div
                    style="margin-top: 10px;margin-bottom: 10px; margin-left: 10px;
                    ">
                      <a href="<?= Url::to(['/site/visit-profile', 'userId' => $rooms[$i]["r_admin"]]) ?>">
                    <div style="display:inline-block;vertical-align:top;">
                        <img
                            style="border-radius: 50%;"
                            width="50"
                            height="50"
                            class="rounded-circle"
                            src="<?= "http://" . Yii::$app->params['domain'] . "/profilePicture/" . $rooms[$i]["profile_picture"] ?>"
                            />
                    </div>
                      </a>
                    <div style="display:inline-block;">
                        <div style="padding: 0px;"><span style="font-weight: bold;font-family:'Myriad Pro Regular'; font-size: 14px;"><?= $rooms[$i]["fullname"] ?></span></div>
                        <div style="font-size: 14px;font-family:'Myriad Pro Bold';"><?= $rooms[$i]["challenge_coins"] ?></div>
                    </div>

                    <svg
                        style="float: right;
                        margin: 10px;
                        transform: rotate(-45deg);"
                        xmlns="http://w3.org/2000/svg" width="15.575" height="15.18" viewBox="0 0 15.575 15.18">
                        <path id="Path_13" data-name="Path 13" d="M14.654,6.121,2.343.163A1.632,1.632,0,0,0,.117,2.238L2.258,7.589.117,12.941a1.632,1.632,0,0,0,2.226,2.076L14.654,9.058a1.632,1.632,0,0,0,0-2.937ZM1.128,1.834a.53.53,0,0,1,.134-.6.527.527,0,0,1,.608-.092l12.2,5.9H3.212Zm.742,12.2a.544.544,0,0,1-.742-.692L3.212,8.133H14.069Z" fill="#909090"/>
                    </svg>


                </div>

                <section id="splideId<?= $i ?>" class="splide"  aria-label="Splide Basic HTML Example">
                    <div class="splide__track">
                        <ul class="splide__list">

                            <?php for ($j = 0; $j < sizeof($videosArray); $j++) { ?>
                                <li class="splide__slide">

                                    <video   style="background: black;width: 100%; height: 500px;border-radius: 10px; object-fit: contain;" controls>
                                        <source src="<?= "http://" . Yii::$app->params['domain'] . "/postChallengesFiles/" . $videosArray[$j] ?>" type="video/mp4">

                                            Your browser does not support the video tag.
                                    </video>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>











                    <a href="<?= Url::to(['/site/post', 'postId' => $rooms[$i]["id"]]) ?>">


                        <svg
                            style="position: absolute;
                            bottom: 120px;
                            right: 30px;"
                            xmlns="http://w3.org/2000/svg" xmlns:xlink="http://w3.org/1999/xlink" width="59" height="59" viewBox="0 0 59 59">
                            <defs>
                                <filter id="Ellipse_20" x="0" y="0" width="59" height="59" filterUnits="userSpaceOnUse">
                                    <feOffset dy="3" input="SourceAlpha"/>
                                    <feGaussianBlur stdDeviation="5" result="blur"/>
                                    <feFlood flood-opacity="0.212"/>
                                    <feComposite operator="in" in2="blur"/>
                                    <feComposite in="SourceGraphic"/>
                                </filter>
                            </defs>
                            <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#Ellipse_20)">
                                <circle id="Ellipse_20-2" data-name="Ellipse 20" cx="14.5" cy="14.5" r="14.5" transform="translate(15 12)" fill="#fff"/>
                            </g>
                            <g id="noun_chat_1079099" transform="translate(22.655 19.191)">
                                <g id="Group_40" data-name="Group 40">
                                    <path id="Path_3" data-name="Path 3" d="M15.374,11A6.779,6.779,0,0,0,8.4,17.538a6.779,6.779,0,0,0,6.974,6.538,7.331,7.331,0,0,0,3.319-.788l2.23,1.207a.752.752,0,0,0,.319.084.723.723,0,0,0,.4-.134.682.682,0,0,0,.251-.671l-.6-2.783a6.246,6.246,0,0,0,1.056-3.454A6.779,6.779,0,0,0,15.374,11Zm4.661,9.456a.679.679,0,0,0-.117.536l.352,1.643L19,21.948a.652.652,0,0,0-.654.017,5.976,5.976,0,0,1-2.967.771,5.437,5.437,0,0,1-5.633-5.2,5.437,5.437,0,0,1,5.633-5.2,5.437,5.437,0,0,1,5.633,5.2A4.917,4.917,0,0,1,20.035,20.456Z" transform="translate(-8.4 -11)" fill="#181818"/>
                                </g>
                            </g>
                        </svg>

                    </a>

                </section>


                <div style="margin: 10px;">
                    <label
                        style="font-weight: bold;font-family:'Myriad Pro Regular';"><?= $rooms[$i]['number_of_likes'] . " Likes" ?></label>
                    <br/>
                    <label
                        style="font-weight: bold;font-family:'Myriad Pro Regular';"><?= $rooms[$i]['title'] ?></label>
                    <br/>
                    <label style="font-family:'Myriad Pro Regular';"><?= $rooms[$i]['c_text'] ?></label>

                    <?php if ($rooms[$i]['last_comment'] != null) {
                        ?>
                        <br/>
                        <label style="font-family:'Myriad Pro Regular';"><?= $rooms[$i]['last_comment'] ?></label>
                        <?php
                    }
                    ?>
                </div>


            </div>


            <?php
            JSRegister::begin([
                'id' => $i,
                'position' => View::POS_READY
            ])
            ?>
            <script>
                //            new Splide('.splide').mount();
                new Splide('#splideId<?= $i ?>').mount();
            </script>
            <?php JSRegister::end() ?>




            <?php
        } else {

            $color = $rooms[$i]["color1"];

            if ($color[0] == '#') {
                $color = substr($color, 1);
            }

            //Check if color has 6 or 3 characters and get values
            if (strlen($color) == 6) {
                $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
            } elseif (strlen($color) == 3) {
                $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
            }

            //Convert hexadec to rgb
            $rgb = array_map('hexdec', $hex);

            //Check if opacity is set(rgba or rgb)

            $output = 'rgb(' . implode(",", $rgb) . ')';

            $color2 = $rooms[$i]["color2"];

            if ($color2[0] == '#') {
                $color2 = substr($color2, 1);
            }

            //Check if color has 6 or 3 characters and get values
            if (strlen($color2) == 6) {
                $hex2 = array($color2[0] . $color2[1], $color2[2] . $color2[3], $color2[4] . $color2[5]);
            } elseif (strlen($color) == 3) {
                $hex2 = array($color2[0] . $color2[0], $color2[1] . $color2[1], $color2[2] . $color2[2]);
            }

            //Convert hexadec to rgb
            $rgb2 = array_map('hexdec', $hex2);

            //Check if opacity is set(rgba or rgb)

            $output2 = 'rgb(' . implode(",", $rgb2) . ')';
            ?>

            <div class="col-lg-6 col-lg-offset-3" style="background: white; padding: 2px;border-radius: 10px; margin-bottom: 10px;">

                <div
                    style="margin-top: 10px;margin-bottom: 10px; margin-left: 10px;
                    ">
                      <a href="<?= Url::to(['/site/visit-profile', 'userId' => $rooms[$i]["r_admin"]]) ?>">
                    <div style="display:inline-block;vertical-align:top;">
                        <img
                            style="border-radius: 50%;"
                            width="50"
                            height="50"
                            class="rounded-circle"
                            src="<?= "http://" . Yii::$app->params['domain'] . "/profilePicture/" . $rooms[$i]["profile_picture"] ?>"
                            />
                    </div>
                      </a>
                    <div style="display:inline-block;">
                        <div style="padding: 0px;"><span style="font-weight: bold; font-size: 14px;font-family:'Myriad Pro Regular';"><?= $rooms[$i]["fullname"] ?></span></div>
                        <div style="font-size: 14px;font-family:'Myriad Pro Regular';"><?= $rooms[$i]["challenge_coins"] ?></div>
                    </div>

                    <svg
                        style="float: right;
                        transform: rotate(-45deg);
                        margin: 10px;"
                        xmlns="http://w3.org/2000/svg" width="15.575" height="15.18" viewBox="0 0 15.575 15.18">
                        <path id="Path_13" data-name="Path 13" d="M14.654,6.121,2.343.163A1.632,1.632,0,0,0,.117,2.238L2.258,7.589.117,12.941a1.632,1.632,0,0,0,2.226,2.076L14.654,9.058a1.632,1.632,0,0,0,0-2.937ZM1.128,1.834a.53.53,0,0,1,.134-.6.527.527,0,0,1,.608-.092l12.2,5.9H3.212Zm.742,12.2a.544.544,0,0,1-.742-.692L3.212,8.133H14.069Z" fill="#909090"/>
                    </svg>


                </div>

                <?php
                /* Convert hexdec color string to rgb(a) string */
                ?>

                <div>





                    <div class="" style="width: 100%; height: 500px;border-radius: 10px; object-fit: contain;padding: 10;
                         background: linear-gradient(184deg, <?= $output ?> 45%, <?= $output2 ?>  100%);">


                        <div  style="color:white ; font-weight: bold  ;font-family:'Myriad Pro Regular';text-align: center;font-size: 25px;   position: absolute;top: 50%;left: 50%;
                              transform: translate(-50%, -50%);"><?= $rooms[$i]["c_text"] ?></div>
                    </div>










                    <?php
                    if ($rooms[$i]["category"] == "donate") {
                        ?>


                        <?php
                    } else if ($rooms[$i]["category"] == "challenge") {
                        ?>


                        <?php
                    } else {


                        if (!Yii::$app->user->isGuest) {
                            if ($rooms[$i]['room_id_liked'] == $rooms[$i]['id']) {
                                ?>    <svg
                                    class="unlikeBtn likeAndUnlike"
                                    id="<?= $rooms[$i]["id"] ?>"
                                    style="position: absolute;
                                    bottom: 120px;
                                    left: 30px;"
                                    xmlns="http://w3.org/2000/svg" xmlns:xlink="http://w3.org/1999/xlink" width="59" height="59" viewBox="0 0 59 59">
                                    <defs>
                                        <filter id="Ellipse_18" x="0" y="0" width="59" height="59" filterUnits="userSpaceOnUse">
                                            <feOffset dy="3" input="SourceAlpha"/>
                                            <feGaussianBlur stdDeviation="5" result="blur"/>
                                            <feFlood flood-opacity="0.212"/>
                                            <feComposite operator="in" in2="blur"/>
                                            <feComposite in="SourceGraphic"/>
                                        </filter>
                                    </defs>
                                    <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#Ellipse_18)">
                                        <circle id="Ellipse_18-2" data-name="Ellipse 18" cx="14.5" cy="14.5" r="14.5" transform="translate(15 12)" fill="#f15a24"/>
                                    </g>
                                    <path id="Union_1" data-name="Union 1" d="M5.555,10.271C2.868,8.591,0,6.575,0,3.907,0,1.342,1.674,0,3.327,0A3.2,3.2,0,0,1,5.866,1.269,3.2,3.2,0,0,1,8.4,0c1.653,0,3.327,1.342,3.327,3.907,0,2.668-2.867,4.684-5.555,6.363a.587.587,0,0,1-.621,0Z" transform="translate(24.018 21.239)" fill="#fff"/>
                                </svg>
                                <?php
                            } else {
                                ?>
                                <svg
                                    class="likeBtn likeAndUnlike"
                                    id="<?= $rooms[$i]["id"] ?>"




                                    style="position: absolute;
                                    bottom: 120px;
                                    left: 30px;"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="59" height="59" viewBox="0 0 59 59">
                                    <defs>
                                        <filter id="Path_124" x="0" y="0" width="59" height="59" filterUnits="userSpaceOnUse">
                                            <feOffset dy="3" input="SourceAlpha"/>
                                            <feGaussianBlur stdDeviation="5" result="blur"/>
                                            <feFlood flood-opacity="0.212"/>
                                            <feComposite operator="in" in2="blur"/>
                                            <feComposite in="SourceGraphic"/>
                                        </filter>
                                    </defs>
                                    <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#Path_124)">
                                        <path id="Path_124-2" data-name="Path 124" d="M14.5,0A14.5,14.5,0,1,1,0,14.5,14.5,14.5,0,0,1,14.5,0Z" transform="translate(15 12)" fill="#f15a24"/>
                                    </g>
                                    <path id="Union_1" data-name="Union 1" d="M5.555,10.271C2.867,8.59,0,6.575,0,3.908,0,1.342,1.674,0,3.327,0A3.2,3.2,0,0,1,5.865,1.269,3.2,3.2,0,0,1,8.4,0c1.653,0,3.326,1.342,3.326,3.908,0,2.668-2.866,4.683-5.554,6.363a.587.587,0,0,1-.622,0ZM1.173,3.908c0,2.114,2.9,4.044,4.693,5.173,1.8-1.129,4.693-3.059,4.693-5.173,0-1.879-1.117-2.735-2.154-2.735A2.162,2.162,0,0,0,6.41,2.659a.587.587,0,0,1-1.089,0A2.161,2.161,0,0,0,3.327,1.173C2.29,1.173,1.173,2.029,1.173,3.908Z" transform="translate(24.018 21.239)" fill="#fff"/>
                                </svg>

                                <?php
                            }
                        }
                        ?>


                        <?php
                    }
                    ?>



                    <a href="<?= Url::to(['/site/post', 'postId' => $rooms[$i]["id"]]) ?>">

                        <svg
                            style="position: absolute;
                            bottom: 120px;
                            right: 30px;"
                            xmlns="http://w3.org/2000/svg" xmlns:xlink="http://w3.org/1999/xlink" width="59" height="59" viewBox="0 0 59 59">
                            <defs>
                                <filter id="Ellipse_20" x="0" y="0" width="59" height="59" filterUnits="userSpaceOnUse">
                                    <feOffset dy="3" input="SourceAlpha"/>
                                    <feGaussianBlur stdDeviation="5" result="blur"/>
                                    <feFlood flood-opacity="0.212"/>
                                    <feComposite operator="in" in2="blur"/>
                                    <feComposite in="SourceGraphic"/>
                                </filter>
                            </defs>
                            <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#Ellipse_20)">
                                <circle id="Ellipse_20-2" data-name="Ellipse 20" cx="14.5" cy="14.5" r="14.5" transform="translate(15 12)" fill="#fff"/>
                            </g>
                            <g id="noun_chat_1079099" transform="translate(22.655 19.191)">
                                <g id="Group_40" data-name="Group 40">
                                    <path id="Path_3" data-name="Path 3" d="M15.374,11A6.779,6.779,0,0,0,8.4,17.538a6.779,6.779,0,0,0,6.974,6.538,7.331,7.331,0,0,0,3.319-.788l2.23,1.207a.752.752,0,0,0,.319.084.723.723,0,0,0,.4-.134.682.682,0,0,0,.251-.671l-.6-2.783a6.246,6.246,0,0,0,1.056-3.454A6.779,6.779,0,0,0,15.374,11Zm4.661,9.456a.679.679,0,0,0-.117.536l.352,1.643L19,21.948a.652.652,0,0,0-.654.017,5.976,5.976,0,0,1-2.967.771,5.437,5.437,0,0,1-5.633-5.2,5.437,5.437,0,0,1,5.633-5.2,5.437,5.437,0,0,1,5.633,5.2A4.917,4.917,0,0,1,20.035,20.456Z" transform="translate(-8.4 -11)" fill="#181818"/>
                                </g>
                            </g>
                        </svg>


                    </a>
                </div>



                <div style="margin: 10px;">
                    <label
                        style="font-weight: bold;font-family: 'Myriad Pro Regular'"><?= $rooms[$i]['number_of_likes'] . " Likes" ?></label>
                    <br/>
                    <label
                        style="font-weight: bold;"><?= $rooms[$i]['title'] ?></label>

                    <?php if ($rooms[$i]['last_comment'] != null) {
                        ?>
                        <br/>
                        <label style="font-family:'Myriad Pro Regular';"><?= $rooms[$i]['last_comment'] ?></label>
                        <?php
                    }
                    ?>


                </div>


            </div>
            <?php
        }
    }
}
?>


<?php
JSRegister::begin([
    'id' => '1'
]);
?>
<script>
    $(".followAndUnfollow").on("click", function () {
        if ($(this).hasClass("followBtn")) {
            var btnTemp = $(this);
            var posrId = $(this).attr('id');
            $.ajax({
                url: '<?php echo Url::toRoute("/api/mobile/follow-streamer") ?>',
                type: "POST",
                data: {
                    'r_page': posrId,
                    'r_user': '<?= Yii::$app->getUser()->getId() ?>',

                },
                success: function (data) {
                    console.log(data);
                    if (data == true) {
                        btnTemp.removeClass("followBtn");
                        btnTemp.addClass("unfollowBtn");
                        btnTemp.text("UnFollow");
                    } else {
                    }
                },
                error: function (errormessage) {
                    console.log("not working");
                }
            });
        } else if ($(this).hasClass("unfollowBtn")) {
            var btnTemp = $(this);
            var posrId = $(this).attr('id');
            $.ajax({
                url: '<?php echo Url::toRoute("/api/mobile/unfollow-streamer") ?>',
                type: "POST",
                data: {
                    'r_page': posrId,
                    'r_user': '<?= Yii::$app->getUser()->getId() ?>',

                },
                success: function (data) {

                    console.log(data);
                    if (data == true) {
                        btnTemp.removeClass("unfollowBtn");
                        btnTemp.addClass("followBtn");
                        btnTemp.text("Follow");

                    } else {
                    }
                },
                error: function (errormessage) {
                    console.log("not working");
                }
            });
        }
    });




</script>

<?php JSRegister::end(); ?>



