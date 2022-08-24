<?php

use richardfan\widget\JSRegister;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;
?>
<?php
//       echo $rooms['files'];
?>

<!--<a href="-->
<?php
//                Url::to(['/site/post', 'postId' => $room["id"]]) 
?>
<!--">view post</a>-->
<?php
if ($room["type"] == "pictures") {
    $imagesArray = explode(',', $room["files"]);
    ?>

    <div class="col-lg-7" style="background: white; padding: 2px;border-radius: 10px; margin-bottom: 10px;" >

        <div
            style="margin-top: 10px;margin-bottom: 10px; margin-left: 10px;
            ">
            <a href="<?= Url::to(['/site/visit-profile', 'userId' => $room["r_admin"]]) ?>">
                <div style="display:inline-block;vertical-align:top;">
                    <img
                        width="50"
                        height="50"
                        class="rounded-circle"
                        style="border-radius: 50%;"
                        src="<?= "http://" . Yii::$app->params['domain'] . "/profilePicture/" . $room["profile_picture"] ?>"
                        />
                </div>
            </a>
            <div style="display:inline-block;">
                <div style="padding: 0px;"><span style="font-weight: bold; font-size: 14px;"><?= $room["fullname"] ?></span></div>
                <div style="font-size: 14px;font-family:'Myriad Pro Regular';"><?= $room["challenge_coins"] ?></div>
            </div>

            <svg
                style="float: right;
                margin: 10px;
                transform: rotate(-45deg);"
                xmlns="http://w3.org/2000/svg" width="15.575" height="15.18" viewBox="0 0 15.575 15.18">
                <path id="Path_13" data-name="Path 13" d="M14.654,6.121,2.343.163A1.632,1.632,0,0,0,.117,2.238L2.258,7.589.117,12.941a1.632,1.632,0,0,0,2.226,2.076L14.654,9.058a1.632,1.632,0,0,0,0-2.937ZM1.128,1.834a.53.53,0,0,1,.134-.6.527.527,0,0,1,.608-.092l12.2,5.9H3.212Zm.742,12.2a.544.544,0,0,1-.742-.692L3.212,8.133H14.069Z" fill="#909090"/>
            </svg>


        </div>

        <section id="splideId" class="splide" aria-label="" style="height: fit-content;">
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
            if ($room["category"] == "donate") {
                ?>

                <?php
            } else if ($room["category"] == "challenge") {
                ?>

                <?php
            } else {
//                    \yii\helpers\VarDumper::dump($room,3,3);
//                    die();
                if (!Yii::$app->user->isGuest) {
                    if ($room['room_id_liked'] == $room['id']) {
                        ?>    <svg
                            class="unlikeBtn likeAndUnlike"
                            id="<?= $room["id"] ?>"
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
                            id="<?= $room["id"] ?>"




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



        </section>


        <div style="margin: 10px;">
            <label
                style="font-weight: bold;font-family:'Myriad Pro Regular';"><?= $room['number_of_likes'] . " Likes" ?></label>
            <br/>
            <label
                style="font-weight: bold;font-family:'Myriad Pro Regular';"><?= $room['title'] ?></label>
            <br/>
            <label style="font-family:'Myriad Pro Regular';"><?= $room['c_text'] ?></label>

        </div>


    </div>


    <?php
    JSRegister::begin([
        'position' => View::POS_READY
    ])
    ?>
    <script>
        //            new Splide('.splide').mount();
        new Splide('#splideId').mount();
    </script>
    <?php JSRegister::end() ?>

    <?php
}
if ($room["type"] == "video") {
    ?>

    <div class="col-lg-7" style="background: white; padding: 2px;border-radius: 10px; margin-bottom: 10px;">

        <div
            style="margin-top: 10px;margin-bottom: 10px; margin-left: 10px;

            ">
            <a href="<?= Url::to(['/site/visit-profile', 'userId' => $room["r_admin"]]) ?>">
                <div style="display:inline-block;vertical-align:top;">
                    <img
                        style="border-radius: 50%;"
                        width="50"
                        height="50"
                        class="rounded-circle"
                        src="<?= "http://" . Yii::$app->params['domain'] . "/profilePicture/" . $room["profile_picture"] ?>"
                        />
                </div>
            </a>
            <div style="display:inline-block;">
                <div style="padding: 0px;"><span style="font-weight: bold;font-family:'Myriad Pro Regular'; font-size: 14px;"><?= $room["fullname"] ?></span></div>
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
                <source src="<?= "http://" . Yii::$app->params['domain'] . "/videoUploads/" . $room["files"] ?>" type="video/mp4">

                    Your browser does not support the video tag.
            </video>




            <?php
            if ($room["category"] == "donate") {
                ?>
                <?php
            } else if ($room["category"] == "challenge") {
                ?>

                <?php
            } else {

                if (!Yii::$app->user->isGuest) {
                    if ($room['room_id_liked'] == $room['id']) {
                        ?>    <svg
                            class="unlikeBtn likeAndUnlike"
                            id="<?= $room["id"] ?>"
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
                            id="<?= $room["id"] ?>"




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




        </div>



        <div style="margin: 10px;">
            <label
                style="font-weight: bold;font-family:'Myriad Pro Regular';"><?= $room['number_of_likes'] . " Likes" ?></label>
            <br/>
            <label
                style="font-weight: bold;font-family:'Myriad Pro Regular';"><?= $room['title'] ?></label>
            <br/>
            <label style="font-family:'Myriad Pro Regular';"><?= $room['c_text'] ?></label>


        </div>


    </div>
<?php }
?>

<?php
if ($room["type"] == "text") {

    if ($room["category"] == "challenge") {


        $challengesVideosArray = (isset($room["challengesVideos"])) ? $room["challengesVideos"] : null;
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
        <div class="col-lg-7" style="background: white; padding: 2px;border-radius: 10px; margin-bottom: 10px;">

            <div
                style="margin-top: 10px;margin-bottom: 10px; margin-left: 10px;
                ">
                <a href="<?= Url::to(['/site/visit-profile', 'userId' => $room["r_admin"]]) ?>">
                    <div style="display:inline-block;vertical-align:top;">
                        <img
                            style="border-radius: 50%;"
                            width="50"
                            height="50"
                            class="rounded-circle"
                            src="<?= "http://" . Yii::$app->params['domain'] . "/profilePicture/" . $room["profile_picture"] ?>"
                            />
                    </div>
                </a>
                <div style="display:inline-block;">
                    <div style="padding: 0px;"><span style="font-weight: bold;font-family:'Myriad Pro Regular'; font-size: 14px;"><?= $room["fullname"] ?></span></div>
                    <div style="font-size: 14px;font-family:'Myriad Pro Bold';"><?= $room["challenge_coins"] ?></div>
                </div>

                <svg
                    style="float: right;
                    margin: 10px;
                    transform: rotate(-45deg);"
                    xmlns="http://w3.org/2000/svg" width="15.575" height="15.18" viewBox="0 0 15.575 15.18">
                    <path id="Path_13" data-name="Path 13" d="M14.654,6.121,2.343.163A1.632,1.632,0,0,0,.117,2.238L2.258,7.589.117,12.941a1.632,1.632,0,0,0,2.226,2.076L14.654,9.058a1.632,1.632,0,0,0,0-2.937ZM1.128,1.834a.53.53,0,0,1,.134-.6.527.527,0,0,1,.608-.092l12.2,5.9H3.212Zm.742,12.2a.544.544,0,0,1-.742-.692L3.212,8.133H14.069Z" fill="#909090"/>
                </svg>


            </div>

            <section id="splideId" class="splide"  aria-label="Splide Basic HTML Example">
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













            </section>


            <div style="margin: 10px;">
                <label
                    style="font-weight: bold;font-family:'Myriad Pro Regular';"><?= $room['number_of_likes'] . " Likes" ?></label>
                <br/>
                <label
                    style="font-weight: bold;font-family:'Myriad Pro Regular';"><?= $room['title'] ?></label>
                <br/>
                <label style="font-family:'Myriad Pro Regular';"><?= $room['c_text'] ?></label>



            </div>


        </div>


        <?php
        JSRegister::begin([
            'position' => View::POS_READY
        ])
        ?>
        <script>
            //            new Splide('.splide').mount();
            new Splide('#splideId').mount();
        </script>
        <?php JSRegister::end() ?>




        <?php
    } else {

        $color = $room["color1"];

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

        $color2 = $room["color2"];

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

        <div class="col-lg-7" style="background: white; padding: 2px;border-radius: 10px; margin-bottom: 10px;">

            <div
                style="margin-top: 10px;margin-bottom: 10px; margin-left: 10px;
                ">
                <a href="<?= Url::to(['/site/visit-profile', 'userId' => $room["r_admin"]]) ?>">
                    <div style="display:inline-block;vertical-align:top;">
                        <img
                            style="border-radius: 50%;"
                            width="50"
                            height="50"
                            class="rounded-circle"
                            src="<?= "http://" . Yii::$app->params['domain'] . "/profilePicture/" . $room["profile_picture"] ?>"
                            />
                    </div>
                </a>
                <div style="display:inline-block;">
                    <div style="padding: 0px;"><span style="font-weight: bold; font-size: 14px;font-family:'Myriad Pro Regular';"><?= $room["fullname"] ?></span></div>
                    <div style="font-size: 14px;font-family:'Myriad Pro Regular';"><?= $room["challenge_coins"] ?></div>
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
                          transform: translate(-50%, -50%);"><?= $room["c_text"] ?></div>
                </div>










                <?php
                if ($room["category"] == "donate") {
                    ?>


                    <?php
                } else if ($room["category"] == "challenge") {
                    ?>


                    <?php
                } else {


                    if (!Yii::$app->user->isGuest) {
                        if ($room['room_id_liked'] == $room['id']) {
                            ?>    <svg
                                class="unlikeBtn likeAndUnlike"
                                id="<?= $room["id"] ?>"
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
                                id="<?= $room["id"] ?>"




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




            </div>



            <div style="margin: 10px;">
                <label
                    style="font-weight: bold;font-family: 'Myriad Pro Regular'"><?= $room['number_of_likes'] . " Likes" ?></label>
                <br/>
                <label
                    style="font-weight: bold;"><?= $room['title'] ?></label>




            </div>


        </div>
        <?php
    }
}
?>


<div class="col-lg-4" style="margin-left: 55px;background: white; padding: 2px;border-radius: 10px; margin-bottom: 10px;">

    <h4 style="margin-top: 10px;margin-bottom: 10px; margin-left: 10px; font-weight: bold">Comments</h4>
    <?php
    Pjax::begin(['id' => 'pjax-id']);
    for ($i = 0; $i < sizeof($commentsByPost); $i++) {
        $comment = $commentsByPost[$i];
        ?>

        <div
            style="margin-top: 10px;margin-bottom: 10px; margin-left: 10px;
            ">
            <div style="display:inline-block;vertical-align:top;">
                <img
                    width="50"
                    height="50"
                    class="rounded-circle"
                    src="<?= "http://" . Yii::$app->params['domain'] . "/profilePicture/" . $comment["profile_picture"] ?>"
                    />
            </div>
            <div style="display:inline-block;">
                <div style="padding: 0px;"><span style="font-weight: bold;font-family:'Myriad Pro Regular'; font-size: 14px;"><?= $comment["fullname"] ?></span><span style="font-size: 12px; margin-left: 10px;"><?= $comment["creation_date"] ?></span></div>
                <div style="font-size: 14px;font-family:'Myriad Pro Regular'; margin-top: 10px;"><?= $comment["c_text"] ?></div>
            </div>


        </div>

        <?php
    }
    Pjax::end();
    ?>

    <div style="margin-bottom: 10px;">
        <input id="commentText" class="form-control" placeholder="Comment" style="width: 83%;float: left;margin: 3px;" /> 
        <button id="snedComment"
                class="button button1" style="  background-color: #04AA6D; /* Green */
                border: none;
                color: white;
                width: 14%;
                background: linear-gradient(184deg, rgba(127,71,221,1) 45%, rgba(47,15,101,1) 100%, rgba(218,238,225,1) 100%);
                height: 30px;
                text-align: center;
                text-decoration: none;
                font-size: 16px;
                margin-top: 3px;
                cursor: pointer;border-radius: 20px;
                " id="6">Send                </button>
    </div>
</div>

<?php
JSRegister::begin([
    'id' => '1'
]);
?>
<script>

    $("#snedComment").on('click', function () {
        var commentText = $("#commentText").val();
        if (commentText && commentText !== "" && commentText !== null) {
            $.ajax({
                url: '<?php echo Url::toRoute("/api/mobile/add-comment") ?>',
                type: "POST",
                data: {
                    'postId': '<?= $room['id'] ?>',
                    'userId': '<?= Yii::$app->getUser()->getId() ?>',
                    'text': commentText
                },
                success: function (data) {

                    console.log(data);
                    if (data == "true") {
                        $("#commentText").val("");
                        $.pjax.reload({container: '#pjax-id', async: false});
                    } else {
                    }
                },
                error: function (errormessage) {
                    console.log("not working");

                }
            });

        }
    });


    $(".likeAndUnlike").on("click", function () {
        if ($(this).hasClass("likeBtn")) {
            var likeBtnTemp = $(this);
            var posrId = $(this).attr('id');
            $.ajax({
                url: '<?php echo Url::toRoute("/api/mobile/follow") ?>',
                type: "POST",
                data: {
                    'r_room': posrId,
                    'r_user': '<?= Yii::$app->getUser()->getId() ?>',
                    'token': '<?= Yii::$app->user->identity["token"] ?>'
                },
                success: function (data) {
                    console.log(data);
                    if (data == true) {
                        likeBtnTemp.removeClass("likeBtn");
                        likeBtnTemp.addClass("unlikeBtn");
                        likeBtnTemp.html('<defs>\
                                <filter id="Ellipse_18" x="0" y="0" width="59" height="59" filterUnits="userSpaceOnUse">\
                                    <feOffset dy="3" input="SourceAlpha"/>\
                                    <feGaussianBlur stdDeviation="5" result="blur"/>\
                                    <feFlood flood-opacity="0.212"/>\
                                    <feComposite operator="in" in2="blur"/>\
                                    <feComposite in="SourceGraphic"/>\
                                </filter>\
                            </defs>\
                            <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#Ellipse_18)">\
                                <circle id="Ellipse_18-2" data-name="Ellipse 18" cx="14.5" cy="14.5" r="14.5" transform="translate(15 12)" fill="#f15a24"/>\
                            </g>\
                            <path id="Union_1" data-name="Union 1" d="M5.555,10.271C2.868,8.591,0,6.575,0,3.907,0,1.342,1.674,0,3.327,0A3.2,3.2,0,0,1,5.866,1.269,3.2,3.2,0,0,1,8.4,0c1.653,0,3.327,1.342,3.327,3.907,0,2.668-2.867,4.684-5.555,6.363a.587.587,0,0,1-.621,0Z" transform="translate(24.018 21.239)" fill="#fff"/>');
                    } else {
                    }
                },
                error: function (errormessage) {
                    console.log("not working");
                }
            });
        } else if ($(this).hasClass("unlikeBtn")) {
            var likeBtnTemp = $(this);
            var posrId = $(this).attr('id');
            $.ajax({
                url: '<?php echo Url::toRoute("/api/mobile/unfollow") ?>',
                type: "POST",
                data: {
                    'r_room': posrId,
                    'r_user': '<?= Yii::$app->getUser()->getId() ?>',
                    'token': '<?= Yii::$app->user->identity["token"] ?>'
                },
                success: function (data) {

                    console.log(data);
                    if (data == true) {
                        likeBtnTemp.removeClass("unlikeBtn");
                        likeBtnTemp.addClass("likeBtn");
                        likeBtnTemp.html('<defs>\
                                <filter id="Path_124" x="0" y="0" width="59" height="59" filterUnits="userSpaceOnUse">\
                                    <feOffset dy="3" input="SourceAlpha"/>\
                                    <feGaussianBlur stdDeviation="5" result="blur"/>\
                                    <feFlood flood-opacity="0.212"/>\
                                    <feComposite operator="in" in2="blur"/>\
                                    <feComposite in="SourceGraphic"/>\
                                </filter>\
                            </defs>\
                            <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#Path_124)">\
                                <path id="Path_124-2" data-name="Path 124" d="M14.5,0A14.5,14.5,0,1,1,0,14.5,14.5,14.5,0,0,1,14.5,0Z" transform="translate(15 12)" fill="#f15a24"/>\
                            </g>\
                            <path id="Union_1" data-name="Union 1" d="M5.555,10.271C2.867,8.59,0,6.575,0,3.908,0,1.342,1.674,0,3.327,0A3.2,3.2,0,0,1,5.865,1.269,3.2,3.2,0,0,1,8.4,0c1.653,0,3.326,1.342,3.326,3.908,0,2.668-2.866,4.683-5.554,6.363a.587.587,0,0,1-.622,0ZM1.173,3.908c0,2.114,2.9,4.044,4.693,5.173,1.8-1.129,4.693-3.059,4.693-5.173,0-1.879-1.117-2.735-2.154-2.735A2.162,2.162,0,0,0,6.41,2.659a.587.587,0,0,1-1.089,0A2.161,2.161,0,0,0,3.327,1.173C2.29,1.173,1.173,2.029,1.173,3.908Z" transform="translate(24.018 21.239)" fill="#fff"/>')
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
