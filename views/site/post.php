<?php

use richardfan\widget\JSRegister;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;

$imagesArray = [Yii::getAlias('@web') . '/images/123.jpg', Yii::getAlias('@web') . '/images/face.png',
    'data:image/jpeg;base64,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'];

//       echo $rooms[$i]['files'];
?>
<?php
if ($room["type"] == "pictures") {
    $imagesArray = explode(',', $room["files"]);
    ?>

    <div class="col-lg-10 offset-lg-1" style="background: white; padding: 2px;border-radius: 10px; margin-bottom: 10px;">

        <div
            style="margin-top: 10px;margin-bottom: 10px; margin-left: 10px;
            ">
            <div style="display:inline-block;vertical-align:top;">
                <img
                    width="50"
                    height="50"
                    class="rounded-circle"
                    src="<?= "http://" . Yii::$app->params['domain'] . "/profilePicture/" . $room["profile_picture"] ?>"
                    />
            </div>
            <div style="display:inline-block;">
                <div style="padding: 0px;"><span style="font-weight: bold; font-size: 14px;"><?= $room["fullname"] ?></span></div>
                <div style="font-size: 14px;font-family:'Myriad Pro Regular';"><?= $room["challenge_coins"] ?></div>
            </div>

            <svg
                style="float: right;
                margin: 10px;
                transform: rotate(-45deg);"
                xmlns="http://www.w3.org/2000/svg" width="15.575" height="15.18" viewBox="0 0 15.575 15.18">
                <path id="Path_13" data-name="Path 13" d="M14.654,6.121,2.343.163A1.632,1.632,0,0,0,.117,2.238L2.258,7.589.117,12.941a1.632,1.632,0,0,0,2.226,2.076L14.654,9.058a1.632,1.632,0,0,0,0-2.937ZM1.128,1.834a.53.53,0,0,1,.134-.6.527.527,0,0,1,.608-.092l12.2,5.9H3.212Zm.742,12.2a.544.544,0,0,1-.742-.692L3.212,8.133H14.069Z" fill="#909090"/>
            </svg>


        </div>

        <section id="splideId" class="splide" aria-label="Splide Basic HTML Example" style="height: fit-content;">
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
                <!--                <svg     style="position: absolute;
                                         top: 380px ;
                                         left: 30px ;"     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="59" height="59" viewBox="0 0 59 59">

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



                                    <g id="Group_105" data-name="Group 105" transform="translate(23.5 16.99)">
                                        <path id="Path_104" data-name="Path 104" d="M1091.841,267.439a9.681,9.681,0,0,0-2.112-3.389.429.429,0,0,0-.579-.113,5.094,5.094,0,0,1-3.986.076.4.4,0,0,0-.358.056,9,9,0,0,0-2.146,3.445,2.591,2.591,0,0,0,1.652,3.419,7.6,7.6,0,0,0,2.9.474,8.563,8.563,0,0,0,2.908-.44A2.611,2.611,0,0,0,1091.841,267.439Zm-3.156,1.919a1.207,1.207,0,0,1-.521.435,1.75,1.75,0,0,1-.647.151v.254a.231.231,0,1,1-.462,0v-.268a1.919,1.919,0,0,1-.559-.139,1.249,1.249,0,0,1-.572-.473,1.312,1.312,0,0,1-.185-.435.245.245,0,0,1,.214-.3l.031,0a.245.245,0,0,1,.256.187.954.954,0,0,0,.125.283.892.892,0,0,0,.4.309,1.313,1.313,0,0,0,.29.089v-1.431a3.2,3.2,0,0,1-.635-.216,1.091,1.091,0,0,1-.424-.37.914.914,0,0,1-.139-.494,1.02,1.02,0,0,1,.17-.563,1.052,1.052,0,0,1,.5-.4,1.849,1.849,0,0,1,.529-.128v-.274a.231.231,0,1,1,.462,0v.28a1.845,1.845,0,0,1,.516.128,1.128,1.128,0,0,1,.519.419,1.17,1.17,0,0,1,.152.342.241.241,0,0,1-.217.3l-.031,0a.248.248,0,0,1-.253-.183.742.742,0,0,0-.236-.37.869.869,0,0,0-.452-.176v1.263a4.13,4.13,0,0,1,.672.2,1.2,1.2,0,0,1,.512.405.979.979,0,0,1,.166.564A1.092,1.092,0,0,1,1088.685,269.357Z" transform="translate(-1080.669 -256.983)" fill="#fff"/>
                                        <path id="Path_105" data-name="Path 105" d="M1130.84,304.689a3.546,3.546,0,0,0-.378-.111v1.341a1.342,1.342,0,0,0,.389-.083.745.745,0,0,0,.342-.246.564.564,0,0,0,.112-.34.517.517,0,0,0-.107-.327A.814.814,0,0,0,1130.84,304.689Z" transform="translate(-1123.613 -293.431)" fill="#FFF"/>
                                        <path id="Path_106" data-name="Path 106" d="M1119.43,287.8a.453.453,0,0,0,.155.353,1.485,1.485,0,0,0,.536.22v-1.159a.9.9,0,0,0-.473.165A.525.525,0,0,0,1119.43,287.8Z" transform="translate(-1113.735 -277.887)" fill="#fff"/>
                                        <path id="Path_107" data-name="Path 107" d="M1092.786,223.06a1.572,1.572,0,0,1,.908.178,3.313,3.313,0,0,0,2.264.781,3.808,3.808,0,0,0,2.148-.543,1.248,1.248,0,0,0,.5-.613,4.459,4.459,0,0,0,.171-1.378,2.7,2.7,0,0,0-.492-1.5.382.382,0,0,0-.468-.122,4.553,4.553,0,0,1-3.406-.028.866.866,0,0,0-.923.183,2.323,2.323,0,0,1-.742.391c-.2.062-.261.134-.258.334.01.677.014,1.354,0,2.031C1092.477,223.015,1092.56,223.051,1092.786,223.06Z" transform="translate(-1089.606 -217.491)" fill="#fff"/>
                                        <path id="Path_108" data-name="Path 108" d="M1066.989,223.071a.6.6,0,0,0-.6-.6h-.811a.6.6,0,0,0-.6.6v2.387a.6.6,0,0,0,.6.6h.811a.6.6,0,0,0,.6-.6Zm-.979.813a.386.386,0,0,1-.438-.405.4.4,0,0,1,.4-.436.4.4,0,0,1,.431.428A.383.383,0,0,1,1066.009,223.884Z" transform="translate(-1064.983 -219.914)" fill="#FFF"/>
                                        <path id="Path_109" data-name="Path 109" d="M1113.462,199.376a1.133,1.133,0,0,0,.748.5,2.245,2.245,0,0,0,.787,0,1.134,1.134,0,0,0,.748-.5l.4-.613a.154.154,0,0,0-.149-.236l-.4.054a.616.616,0,0,1-.558-.221l-.211-.258a.279.279,0,0,0-.432,0l-.211.258a.616.616,0,0,1-.558.221l-.4-.054a.154.154,0,0,0-.149.236Z" transform="translate(-1108.014 -198)" fill="#fff"/>
                                    </g>
                                </svg>-->

                <?php
            } else if ($room["category"] == "challenge") {
                ?>

                <!--                <svg style="position: absolute;
                                     top: 380px;
                                     left: 30px ;"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="59" height="59" viewBox="0 0 59 59">
                                    <defs>
                                        <filter id="Path_140" x="0" y="0" width="59" height="59" filterUnits="userSpaceOnUse">
                                            <feOffset dy="3" input="SourceAlpha"/>
                                            <feGaussianBlur stdDeviation="5" result="blur"/>
                                            <feFlood flood-opacity="0.212"/>
                                            <feComposite operator="in" in2="blur"/>
                                            <feComposite in="SourceGraphic"/>
                                        </filter>
                                    </defs>
                                    <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#Path_140)">
                                        <path id="Path_140-2" data-name="Path 140" d="M14.5,0A14.5,14.5,0,1,1,0,14.5,14.5,14.5,0,0,1,14.5,0Z" transform="translate(15 12)" fill="#f15a24"/>
                                    </g>
                                    <g id="Group_161" data-name="Group 161" transform="translate(20.99 16.99)">
                                        <path id="Path_134" data-name="Path 134" d="M133.756,273.412c-.063-.141-.127-.264-.173-.393a1.684,1.684,0,0,1,.124-1.475c.5-.846,1-1.686,1.512-2.525a1.755,1.755,0,0,1,.921-.735q2.154-.805,4.306-1.615l.059-.024a.97.97,0,0,1-.125-.283.42.42,0,0,1,.082-.272c.456-.583.921-1.159,1.385-1.737a.352.352,0,0,1,.462-.115l4.911,2.1a.369.369,0,0,1,.241.374c0,.539,0,1.078,0,1.616a1.062,1.062,0,0,1-1.527,1l-.05-.021c-.056.134-.11.267-.167.4a24.332,24.332,0,0,1-2.127,3.951,6.778,6.778,0,0,1-1.738,1.761.155.155,0,0,0-.064.1q0,1.616,0,3.233,0,.8,0,1.606c0,.146,0,.146.141.146h.893a.356.356,0,1,1,0,.708H130.832a.361.361,0,0,1-.387-.292.351.351,0,0,1,.232-.4.519.519,0,0,1,.157-.02c.3,0,.6-.006.893,0,.108,0,.136-.026.136-.135q-.005-3.265,0-6.53a.694.694,0,0,1,.015-.179.357.357,0,0,1,.375-.253h1.5Zm2.293,0a1.29,1.29,0,0,0-.1-.208c-.143-.2-.288-.4-.441-.595a.37.37,0,0,1-.086-.374.347.347,0,0,1,.3-.238.937.937,0,0,0,.234-.065,6.185,6.185,0,0,0,1.342-.79.561.561,0,0,0,.26-.359.294.294,0,0,1,.119-.155.34.34,0,0,1,.44.035,3.263,3.263,0,0,0,1.844.621.366.366,0,0,1,.266.652,7.469,7.469,0,0,0-1.168,1.6,1.55,1.55,0,0,0-.113.317.356.356,0,0,1-.252.261,1.2,1.2,0,0,0-.263.106c-.689.415-1.377.829-2.06,1.253a.942.942,0,1,0,.993,1.6q.862-.515,1.722-1.033a4.337,4.337,0,0,1,1.25-.615.193.193,0,0,0,.029-.013,5.825,5.825,0,0,0,2.658-2.193,22.969,22.969,0,0,0,2.094-3.932c.042-.1.08-.2.121-.3l-.059-.032q-1.848-.924-3.7-1.846a.22.22,0,0,0-.157,0q-2.482.926-4.963,1.859a1.051,1.051,0,0,0-.549.449q-.742,1.233-1.48,2.469a.869.869,0,0,0-.123.714,7.507,7.507,0,0,0,.332.778.087.087,0,0,0,.066.038C135.08,273.412,135.551,273.412,136.048,273.412Zm5.025,2.473c-.042.018-.07.032-.1.043-.241.093-.482.184-.723.278a1.4,1.4,0,0,0-.212.094q-1.149.686-2.3,1.377a1.655,1.655,0,0,1-1.764-2.8c.358-.229.72-.452,1.08-.678.025-.016.048-.034.088-.064h-4.572V280.5h8.5Zm.207-9.686c.033.019.053.033.074.044l4.852,2.426a.356.356,0,0,0,.544-.341c0-.436,0-.872,0-1.307a.136.136,0,0,0-.1-.147q-1.28-.544-2.557-1.095l-1.757-.752c-.044-.019-.083-.049-.129.009C141.906,265.421,141.6,265.8,141.28,266.2Zm-4.456,7.215h1.511a7.411,7.411,0,0,1,.945-1.482c-.041-.012-.067-.022-.094-.028a4.069,4.069,0,0,1-.967-.348c-.069-.035-.144-.1-.207-.094s-.114.1-.171.149a5.375,5.375,0,0,1-1.358.862l-.078.038Z" transform="translate(-130.44 -264.196)" fill="#fff"/>
                                    </g>
                                </svg>-->





                <?php
            } else {

                if (!Yii::$app->user->isGuest) {
                    if ($room['room_id_liked'] == $room['id']) {
                        ?>    <svg
                            class="unlikeBtn likeAndUnlike"
                            id="<?= $room["id"] ?>"
                            style="position: absolute;
                            top: 380px;
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
                            top: 380px;
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
            <?php if ($room['last_comment'] != null) {
                ?>
                <?php
            }
            ?>
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

    <div class="col-lg-10 offset-lg-1" style="background: white; padding: 2px;border-radius: 10px; margin-bottom: 10px;">

        <div
            style="margin-top: 10px;margin-bottom: 10px; margin-left: 10px;
            ">
            <div style="display:inline-block;vertical-align:top;">
                <img
                    width="50"
                    height="50"
                    class="rounded-circle"
                    src="<?= "http://" . Yii::$app->params['domain'] . "/profilePicture/" . $room["profile_picture"] ?>"
                    />
            </div>
            <div style="display:inline-block;">
                <div style="padding: 0px;"><span style="font-weight: bold;font-family:'Myriad Pro Regular'; font-size: 14px;"><?= $room["fullname"] ?></span></div>
                <div style="font-size: 14px;font-family:'Myriad Pro Regular';"></div>
            </div>

            <svg
                style="float: right;
                transform: rotate(-45deg);
                margin: 10px;"
                xmlns="http://www.w3.org/2000/svg" width="15.575" height="15.18" viewBox="0 0 15.575 15.18">
                <path id="Path_13" data-name="Path 13" d="M14.654,6.121,2.343.163A1.632,1.632,0,0,0,.117,2.238L2.258,7.589.117,12.941a1.632,1.632,0,0,0,2.226,2.076L14.654,9.058a1.632,1.632,0,0,0,0-2.937ZM1.128,1.834a.53.53,0,0,1,.134-.6.527.527,0,0,1,.608-.092l12.2,5.9H3.212Zm.742,12.2a.544.544,0,0,1-.742-.692L3.212,8.133H14.069Z" fill="#909090"/>
            </svg>


        </div>


        <div class="splide__track">


            <video   style="background: black ;width: 100%; height: 500px;border-radius: 10px; object-fit: contain;" controls>
                <source src="<?= "http://" . Yii::$app->params['domain'] . "/postVideos/" . $room["files"] ?>" type="video/mp4">

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
                ?>

                <svg
                    style="position: absolute;
                    bottom: 60 ;
                    left: 30 ;"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="59" height="59" viewBox="0 0 59 59">
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
            }
            ?>



            <svg
                style="position: absolute;
                bottom: 60;
                right: 30;"
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="59" height="59" viewBox="0 0 59 59">
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



        </div>



        <div style="margin: 10px;">
            <label
                style="font-weight: bold;font-family:'Myriad Pro Regular';"><?= $room['number_of_likes'] . " Likes" ?></label>
            <br/>
            <label
                style="font-weight: bold;font-family:'Myriad Pro Regular';"><?= $room['title'] ?></label>
            <br/>
            <label style="font-family:'Myriad Pro Regular';"><?= $room['c_text'] ?></label>
            <?php if ($room['last_comment'] != null) {
                ?>
                <br/>
                <label style="font-family:'Myriad Pro Regular';"><?= $room['last_comment'] ?></label>
                <?php
            }
            ?>

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
        <div class="col-lg-10 offset-lg-1" style="background: white; padding: 2px;border-radius: 10px; margin-bottom: 10px;">

            <div
                style="margin-top: 10px;margin-bottom: 10px; margin-left: 10px;
                ">
                <div style="display:inline-block;vertical-align:top;">
                    <img
                        width="50"
                        height="50"
                        class="rounded-circle"
                        src="<?= "http://" . Yii::$app->params['domain'] . "/profilePicture/" . $room["profile_picture"] ?>"
                        />
                </div>
                <div style="display:inline-block;">
                    <div style="padding: 0px;"><span style="font-weight: bold;font-family:'Myriad Pro Regular'; font-size: 14px;"><?= $room["fullname"] ?></span></div>
                    <div style="font-size: 14px;font-family:'Myriad Pro Bold';"><?= $room["challenge_coins"] ?></div>
                </div>

                <svg
                    style="float: right;
                    margin: 10px;
                    transform: rotate(-45deg);"
                    xmlns="http://www.w3.org/2000/svg" width="15.575" height="15.18" viewBox="0 0 15.575 15.18">
                    <path id="Path_13" data-name="Path 13" d="M14.654,6.121,2.343.163A1.632,1.632,0,0,0,.117,2.238L2.258,7.589.117,12.941a1.632,1.632,0,0,0,2.226,2.076L14.654,9.058a1.632,1.632,0,0,0,0-2.937ZM1.128,1.834a.53.53,0,0,1,.134-.6.527.527,0,0,1,.608-.092l12.2,5.9H3.212Zm.742,12.2a.544.544,0,0,1-.742-.692L3.212,8.133H14.069Z" fill="#909090"/>
                </svg>


            </div>

            <section id="splideId" class="splide" aria-label="Splide Basic HTML Example">
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





                <svg 
                    style="position: absolute;
                    bottom: 60;
                    left: 30;"


                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="59" height="59" viewBox="0 0 59 59">
                    <defs>
                        <filter id="Path_140" x="0" y="0" width="59" height="59" filterUnits="userSpaceOnUse">
                            <feOffset dy="3" input="SourceAlpha"/>
                            <feGaussianBlur stdDeviation="5" result="blur"/>
                            <feFlood flood-opacity="0.212"/>
                            <feComposite operator="in" in2="blur"/>
                            <feComposite in="SourceGraphic"/>
                        </filter>
                    </defs>
                    <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#Path_140)">
                        <path id="Path_140-2" data-name="Path 140" d="M14.5,0A14.5,14.5,0,1,1,0,14.5,14.5,14.5,0,0,1,14.5,0Z" transform="translate(15 12)" fill="#f15a24"/>
                    </g>
                    <g id="Group_161" data-name="Group 161" transform="translate(20.99 16.99)">
                        <path id="Path_134" data-name="Path 134" d="M133.756,273.412c-.063-.141-.127-.264-.173-.393a1.684,1.684,0,0,1,.124-1.475c.5-.846,1-1.686,1.512-2.525a1.755,1.755,0,0,1,.921-.735q2.154-.805,4.306-1.615l.059-.024a.97.97,0,0,1-.125-.283.42.42,0,0,1,.082-.272c.456-.583.921-1.159,1.385-1.737a.352.352,0,0,1,.462-.115l4.911,2.1a.369.369,0,0,1,.241.374c0,.539,0,1.078,0,1.616a1.062,1.062,0,0,1-1.527,1l-.05-.021c-.056.134-.11.267-.167.4a24.332,24.332,0,0,1-2.127,3.951,6.778,6.778,0,0,1-1.738,1.761.155.155,0,0,0-.064.1q0,1.616,0,3.233,0,.8,0,1.606c0,.146,0,.146.141.146h.893a.356.356,0,1,1,0,.708H130.832a.361.361,0,0,1-.387-.292.351.351,0,0,1,.232-.4.519.519,0,0,1,.157-.02c.3,0,.6-.006.893,0,.108,0,.136-.026.136-.135q-.005-3.265,0-6.53a.694.694,0,0,1,.015-.179.357.357,0,0,1,.375-.253h1.5Zm2.293,0a1.29,1.29,0,0,0-.1-.208c-.143-.2-.288-.4-.441-.595a.37.37,0,0,1-.086-.374.347.347,0,0,1,.3-.238.937.937,0,0,0,.234-.065,6.185,6.185,0,0,0,1.342-.79.561.561,0,0,0,.26-.359.294.294,0,0,1,.119-.155.34.34,0,0,1,.44.035,3.263,3.263,0,0,0,1.844.621.366.366,0,0,1,.266.652,7.469,7.469,0,0,0-1.168,1.6,1.55,1.55,0,0,0-.113.317.356.356,0,0,1-.252.261,1.2,1.2,0,0,0-.263.106c-.689.415-1.377.829-2.06,1.253a.942.942,0,1,0,.993,1.6q.862-.515,1.722-1.033a4.337,4.337,0,0,1,1.25-.615.193.193,0,0,0,.029-.013,5.825,5.825,0,0,0,2.658-2.193,22.969,22.969,0,0,0,2.094-3.932c.042-.1.08-.2.121-.3l-.059-.032q-1.848-.924-3.7-1.846a.22.22,0,0,0-.157,0q-2.482.926-4.963,1.859a1.051,1.051,0,0,0-.549.449q-.742,1.233-1.48,2.469a.869.869,0,0,0-.123.714,7.507,7.507,0,0,0,.332.778.087.087,0,0,0,.066.038C135.08,273.412,135.551,273.412,136.048,273.412Zm5.025,2.473c-.042.018-.07.032-.1.043-.241.093-.482.184-.723.278a1.4,1.4,0,0,0-.212.094q-1.149.686-2.3,1.377a1.655,1.655,0,0,1-1.764-2.8c.358-.229.72-.452,1.08-.678.025-.016.048-.034.088-.064h-4.572V280.5h8.5Zm.207-9.686c.033.019.053.033.074.044l4.852,2.426a.356.356,0,0,0,.544-.341c0-.436,0-.872,0-1.307a.136.136,0,0,0-.1-.147q-1.28-.544-2.557-1.095l-1.757-.752c-.044-.019-.083-.049-.129.009C141.906,265.421,141.6,265.8,141.28,266.2Zm-4.456,7.215h1.511a7.411,7.411,0,0,1,.945-1.482c-.041-.012-.067-.022-.094-.028a4.069,4.069,0,0,1-.967-.348c-.069-.035-.144-.1-.207-.094s-.114.1-.171.149a5.375,5.375,0,0,1-1.358.862l-.078.038Z" transform="translate(-130.44 -264.196)" fill="#fff"/>
                    </g>
                </svg>








                <svg
                    style="position: absolute;
                    bottom: 60;
                    right: 30;"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="59" height="59" viewBox="0 0 59 59">
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



            </section>


            <div style="margin: 10px;">
                <label
                    style="font-weight: bold;font-family:'Myriad Pro Regular';"><?= $room['number_of_likes'] . " Likes" ?></label>
                <br/>
                <label
                    style="font-weight: bold;font-family:'Myriad Pro Regular';"><?= $room['title'] ?></label>
                <br/>
                <label style="font-family:'Myriad Pro Regular';"><?= $room['c_text'] ?></label>

                <?php if ($room['last_comment'] != null) {
                    ?>
                    <br/>
                    <label style="font-family:'Myriad Pro Regular';"><?= $room['last_comment'] ?></label>
                    <?php
                }
                ?>
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

        <div class="col-lg-10 offset-lg-1" style="background: white; padding: 2px;border-radius: 10px; margin-bottom: 10px;">

            <div
                style="margin-top: 10px;margin-bottom: 10px; margin-left: 10px;
                ">
                <div style="display:inline-block;vertical-align:top;">
                    <img
                        width="50"
                        height="50"
                        class="rounded-circle"
                        src="<?= "http://" . Yii::$app->params['domain'] . "/profilePicture/" . $room["profile_picture"] ?>"
                        />
                </div>
                <div style="display:inline-block;">
                    <div style="padding: 0px;"><span style="font-weight: bold; font-size: 14px;font-family:'Myriad Pro Regular';"><?= $room["fullname"] ?></span></div>
                    <div style="font-size: 14px;font-family:'Myriad Pro Regular';"><?= $room["challenge_coins"] ?></div>
                </div>

                <svg
                    style="float: right;
                    transform: rotate(-45deg);
                    margin: 10px;"
                    xmlns="http://www.w3.org/2000/svg" width="15.575" height="15.18" viewBox="0 0 15.575 15.18">
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


                    <svg     style="position: relative;
                             bottom: 60 ;
                             left: 30 ;"     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="59" height="59" viewBox="0 0 59 59">

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



                        <g id="Group_105" data-name="Group 105" transform="translate(23.5 16.99)">
                            <path id="Path_104" data-name="Path 104" d="M1091.841,267.439a9.681,9.681,0,0,0-2.112-3.389.429.429,0,0,0-.579-.113,5.094,5.094,0,0,1-3.986.076.4.4,0,0,0-.358.056,9,9,0,0,0-2.146,3.445,2.591,2.591,0,0,0,1.652,3.419,7.6,7.6,0,0,0,2.9.474,8.563,8.563,0,0,0,2.908-.44A2.611,2.611,0,0,0,1091.841,267.439Zm-3.156,1.919a1.207,1.207,0,0,1-.521.435,1.75,1.75,0,0,1-.647.151v.254a.231.231,0,1,1-.462,0v-.268a1.919,1.919,0,0,1-.559-.139,1.249,1.249,0,0,1-.572-.473,1.312,1.312,0,0,1-.185-.435.245.245,0,0,1,.214-.3l.031,0a.245.245,0,0,1,.256.187.954.954,0,0,0,.125.283.892.892,0,0,0,.4.309,1.313,1.313,0,0,0,.29.089v-1.431a3.2,3.2,0,0,1-.635-.216,1.091,1.091,0,0,1-.424-.37.914.914,0,0,1-.139-.494,1.02,1.02,0,0,1,.17-.563,1.052,1.052,0,0,1,.5-.4,1.849,1.849,0,0,1,.529-.128v-.274a.231.231,0,1,1,.462,0v.28a1.845,1.845,0,0,1,.516.128,1.128,1.128,0,0,1,.519.419,1.17,1.17,0,0,1,.152.342.241.241,0,0,1-.217.3l-.031,0a.248.248,0,0,1-.253-.183.742.742,0,0,0-.236-.37.869.869,0,0,0-.452-.176v1.263a4.13,4.13,0,0,1,.672.2,1.2,1.2,0,0,1,.512.405.979.979,0,0,1,.166.564A1.092,1.092,0,0,1,1088.685,269.357Z" transform="translate(-1080.669 -256.983)" fill="#fff"/>
                            <path id="Path_105" data-name="Path 105" d="M1130.84,304.689a3.546,3.546,0,0,0-.378-.111v1.341a1.342,1.342,0,0,0,.389-.083.745.745,0,0,0,.342-.246.564.564,0,0,0,.112-.34.517.517,0,0,0-.107-.327A.814.814,0,0,0,1130.84,304.689Z" transform="translate(-1123.613 -293.431)" fill="#FFF"/>
                            <path id="Path_106" data-name="Path 106" d="M1119.43,287.8a.453.453,0,0,0,.155.353,1.485,1.485,0,0,0,.536.22v-1.159a.9.9,0,0,0-.473.165A.525.525,0,0,0,1119.43,287.8Z" transform="translate(-1113.735 -277.887)" fill="#fff"/>
                            <path id="Path_107" data-name="Path 107" d="M1092.786,223.06a1.572,1.572,0,0,1,.908.178,3.313,3.313,0,0,0,2.264.781,3.808,3.808,0,0,0,2.148-.543,1.248,1.248,0,0,0,.5-.613,4.459,4.459,0,0,0,.171-1.378,2.7,2.7,0,0,0-.492-1.5.382.382,0,0,0-.468-.122,4.553,4.553,0,0,1-3.406-.028.866.866,0,0,0-.923.183,2.323,2.323,0,0,1-.742.391c-.2.062-.261.134-.258.334.01.677.014,1.354,0,2.031C1092.477,223.015,1092.56,223.051,1092.786,223.06Z" transform="translate(-1089.606 -217.491)" fill="#fff"/>
                            <path id="Path_108" data-name="Path 108" d="M1066.989,223.071a.6.6,0,0,0-.6-.6h-.811a.6.6,0,0,0-.6.6v2.387a.6.6,0,0,0,.6.6h.811a.6.6,0,0,0,.6-.6Zm-.979.813a.386.386,0,0,1-.438-.405.4.4,0,0,1,.4-.436.4.4,0,0,1,.431.428A.383.383,0,0,1,1066.009,223.884Z" transform="translate(-1064.983 -219.914)" fill="#FFF"/>
                            <path id="Path_109" data-name="Path 109" d="M1113.462,199.376a1.133,1.133,0,0,0,.748.5,2.245,2.245,0,0,0,.787,0,1.134,1.134,0,0,0,.748-.5l.4-.613a.154.154,0,0,0-.149-.236l-.4.054a.616.616,0,0,1-.558-.221l-.211-.258a.279.279,0,0,0-.432,0l-.211.258a.616.616,0,0,1-.558.221l-.4-.054a.154.154,0,0,0-.149.236Z" transform="translate(-1108.014 -198)" fill="#fff"/>
                        </g>
                    </svg>


                    <?php
                } else if ($room["category"] == "challenge") {
                    ?>
                    <svg
                        style="position: absolute;
                        bottom: 60;
                        right: 30;"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="59" height="59" viewBox="0 0 59 59">
                        <defs>
                            <filter id="Path_140" x="0" y="0" width="59" height="59" filterUnits="userSpaceOnUse">
                                <feOffset dy="3" input="SourceAlpha"/>
                                <feGaussianBlur stdDeviation="5" result="blur"/>
                                <feFlood flood-opacity="0.212"/>
                                <feComposite operator="in" in2="blur"/>
                                <feComposite in="SourceGraphic"/>
                            </filter>
                        </defs>
                        <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#Path_140)">
                            <path id="Path_140-2" data-name="Path 140" d="M14.5,0A14.5,14.5,0,1,1,0,14.5,14.5,14.5,0,0,1,14.5,0Z" transform="translate(15 12)" fill="#f15a24"/>
                        </g>
                        <g id="Group_161" data-name="Group 161" transform="translate(20.99 16.99)">
                            <path id="Path_134" data-name="Path 134" d="M133.756,273.412c-.063-.141-.127-.264-.173-.393a1.684,1.684,0,0,1,.124-1.475c.5-.846,1-1.686,1.512-2.525a1.755,1.755,0,0,1,.921-.735q2.154-.805,4.306-1.615l.059-.024a.97.97,0,0,1-.125-.283.42.42,0,0,1,.082-.272c.456-.583.921-1.159,1.385-1.737a.352.352,0,0,1,.462-.115l4.911,2.1a.369.369,0,0,1,.241.374c0,.539,0,1.078,0,1.616a1.062,1.062,0,0,1-1.527,1l-.05-.021c-.056.134-.11.267-.167.4a24.332,24.332,0,0,1-2.127,3.951,6.778,6.778,0,0,1-1.738,1.761.155.155,0,0,0-.064.1q0,1.616,0,3.233,0,.8,0,1.606c0,.146,0,.146.141.146h.893a.356.356,0,1,1,0,.708H130.832a.361.361,0,0,1-.387-.292.351.351,0,0,1,.232-.4.519.519,0,0,1,.157-.02c.3,0,.6-.006.893,0,.108,0,.136-.026.136-.135q-.005-3.265,0-6.53a.694.694,0,0,1,.015-.179.357.357,0,0,1,.375-.253h1.5Zm2.293,0a1.29,1.29,0,0,0-.1-.208c-.143-.2-.288-.4-.441-.595a.37.37,0,0,1-.086-.374.347.347,0,0,1,.3-.238.937.937,0,0,0,.234-.065,6.185,6.185,0,0,0,1.342-.79.561.561,0,0,0,.26-.359.294.294,0,0,1,.119-.155.34.34,0,0,1,.44.035,3.263,3.263,0,0,0,1.844.621.366.366,0,0,1,.266.652,7.469,7.469,0,0,0-1.168,1.6,1.55,1.55,0,0,0-.113.317.356.356,0,0,1-.252.261,1.2,1.2,0,0,0-.263.106c-.689.415-1.377.829-2.06,1.253a.942.942,0,1,0,.993,1.6q.862-.515,1.722-1.033a4.337,4.337,0,0,1,1.25-.615.193.193,0,0,0,.029-.013,5.825,5.825,0,0,0,2.658-2.193,22.969,22.969,0,0,0,2.094-3.932c.042-.1.08-.2.121-.3l-.059-.032q-1.848-.924-3.7-1.846a.22.22,0,0,0-.157,0q-2.482.926-4.963,1.859a1.051,1.051,0,0,0-.549.449q-.742,1.233-1.48,2.469a.869.869,0,0,0-.123.714,7.507,7.507,0,0,0,.332.778.087.087,0,0,0,.066.038C135.08,273.412,135.551,273.412,136.048,273.412Zm5.025,2.473c-.042.018-.07.032-.1.043-.241.093-.482.184-.723.278a1.4,1.4,0,0,0-.212.094q-1.149.686-2.3,1.377a1.655,1.655,0,0,1-1.764-2.8c.358-.229.72-.452,1.08-.678.025-.016.048-.034.088-.064h-4.572V280.5h8.5Zm.207-9.686c.033.019.053.033.074.044l4.852,2.426a.356.356,0,0,0,.544-.341c0-.436,0-.872,0-1.307a.136.136,0,0,0-.1-.147q-1.28-.544-2.557-1.095l-1.757-.752c-.044-.019-.083-.049-.129.009C141.906,265.421,141.6,265.8,141.28,266.2Zm-4.456,7.215h1.511a7.411,7.411,0,0,1,.945-1.482c-.041-.012-.067-.022-.094-.028a4.069,4.069,0,0,1-.967-.348c-.069-.035-.144-.1-.207-.094s-.114.1-.171.149a5.375,5.375,0,0,1-1.358.862l-.078.038Z" transform="translate(-130.44 -264.196)" fill="#fff"/>
                        </g>
                    </svg>





                    <?php
                } else {
                    ?>

                    <svg
                        style="position: absolute;
                        bottom: 60 ;
                        left: 30 ;"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="59" height="59" viewBox="0 0 59 59">
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
                }
                ?>





                <svg
                    style="position: absolute;
                    bottom: 141px;
                    right: 30;"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="59" height="59" viewBox="0 0 59 59">
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



            </div>



            <div style="margin: 10px;">
                <label
                    style="font-weight: bold;font-family: 'Myriad Pro Regular'"><?= $room['number_of_likes'] . " Likes" ?></label>
                <br/>
                <label
                    style="font-weight: bold;"><?= $room['title'] ?></label>

                <?php if ($room['last_comment'] != null) {
                    ?>
                    <br/>
                    <label style="font-family:'Myriad Pro Regular';"><?= $room['last_comment'] ?></label>
                    <?php
                }
                ?>


            </div>


        </div>
        <?php
    }
}
?>

<div class="col-lg-10 offset-lg-1" style="background: white; padding: 2px;border-radius: 10px; margin-bottom: 10px;">

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


    <input id="commentText" class="form-control" placeholder="Comment" style="width: 85%;float: left;" /> 
    <button id="snedComment" class="btn btn-default" style="width: 14%">Send</button>
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
