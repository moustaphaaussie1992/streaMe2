<?php

namespace app\controllers\api;

use app\models\Comment;
use app\models\Follow;
use app\models\Followrooms;
use app\models\NotificationForm;
use app\models\Pageadmin;
use app\models\PostFiles;
use app\models\ProUserPosts;
use app\models\ProUserPostsViews;
use app\models\Rooms;
use app\models\StreamerGames;
use app\models\UserNotifications;
use app\models\UserPurchaseDetails;
use app\models\Users;
use app\models\UsersSpinSilver;
use Yii;
use yii\db\Query;
use yii\web\Response;
use function contains;

class MobileController extends ApiController {

    public function actionTest() {

//        $frame = 10;
//        $movie = 'test.mp4';
//        $thumbnail = 'thumbnail.png';
//        $mov = new ffmpeg_movie($movie);
//        $screenShotr = new \ScreenShotr\Core('http://streameapp.com/postVideos/jU5g93iiLen56VqJtxV2DbgPcdXRIwu2.mp4');
//        $screenShotr = new \ScreenShotr\Core('videoUploads/ddd.mp4');
//        $screenshot = $screenShotr->generateScreenshot(1);
//        return $screenshot;
//        $obj = new GenerateVideoScreenshots("videoUploads/ddd.mp4");
//        return $obj;
//        return $obj->setOutputPath('output_location');
//        $thumbnail = $obj->generateScreenshot('http://streameapp.com/postVideos/jU5g93iiLen56VqJtxV2DbgPcdXRIwu2.mp4');
//        return $thumbnail;
//        $video = $ffmpeg->open("http://streameapp.com/postVideos/jU5g93iiLen56VqJtxV2DbgPcdXRIwu2.mp4");
    }

    public function actionCreateRoom() {
        $post = Yii::$app->request->post();
        $title = $post["title"];
        $text = $post["text"];
        $user = $post["userId"];
        $type = $post["type"];
        $category = $post["category"];
        $mention = $post["mention"];
        $imageString = $post["imageString"];
        $coins = $post["challenge_coins"];


        $room = new Rooms();
        $room->title = $title;
        $room->c_text = $text;
        $room->r_admin = $user;
        $room->type = $type;
        $room->category = $category;
        $room->mention = $mention;
        $room->challenge_coins = $coins;
        $room->creation_date = date("Y-m-d H:i:s");

        if ($type == "video") {




            $file_name = $_FILES['myFile']['name'];
            $ext = pathinfo($file_name, PATHINFO_EXTENSION);
//            $file_size = $_FILES['myFile']['size'];
//            $file_type = $_FILES['myFile']['type'];
            $temp_name = $_FILES['myFile']['tmp_name'];
            $randomFileName = Yii::$app->security->generateRandomString() . "." . $ext;
            $location = "postVideos/";
            if (move_uploaded_file($temp_name, $location . $randomFileName)) {
                if ($room->save()) {
                    $postFiles = new PostFiles();
                    $postFiles->post_id = $room->primaryKey;
                    $postFiles->file_name = $randomFileName;
                    if ($postFiles->save()) {

                        //for image
                        $location = "postPictures/";
                        $uploads_dir = $location;
                        $imageName = Yii::$app->security->generateRandomString() . ".jpeg";
                        $percent = 1;

                        $data = base64_decode($imageString);

                        $im = imagecreatefromstring($data);
                        $width = imagesx($im);
                        $height = imagesy($im);
                        $newwidth = $width * $percent;
                        $newheight = $height * $percent;
                        $thumb = imagecreatetruecolor($newwidth, $newheight);
                        header('Content-type: image/jpeg');
                        // Resize
                        imagecopyresized($thumb, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

                        // Output
//                    imagejpeg($im, $uploads_dir . $imageName);
                        imagejpeg($thumb, $uploads_dir . $imageName);

                        //save record to database table 
                        $room = Rooms::findOne(["id" => $room->primaryKey]);
                        $room->video_thumbnail = $imageName;
                        if ($room->save()) {
//                            return "good everything is saved";
                        } else {
//                            return $postFiles->getErrors();
                        }
//                        return "good post only saved";
                        //////
                        return "true";
                    } else {
                        return $postFiles->getErrors();
                    }
                    return "good post only saved";
                } else {
                    return $room->getErrors();
                }
            } else {
                return "not upload";
            }
        } else if ($type == "pictures") {
            $color1 = $post["color1"];
            $color2 = $post["color2"];

            $imagesSize = $post["imagesSize"];
            $location = "postPictures/";
            if ($room->save()) {
                for ($i = 0; $i < $imagesSize; $i++) {
                    $image = $post["image" . ($i + 1)];

                    $uploads_dir = $location;
                    $imageName = Yii::$app->security->generateRandomString() . ".jpeg";
                    if ($image) {
                        $percent = 1;

                        $data = base64_decode($image);

                        $im = imagecreatefromstring($data);
                        $width = imagesx($im);
                        $height = imagesy($im);
                        $newwidth = $width * $percent;
                        $newheight = $height * $percent;
                        $thumb = imagecreatetruecolor($newwidth, $newheight);
                        header('Content-type: image/jpeg');
                        // Resize
                        imagecopyresized($thumb, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

                        // Output
//                    imagejpeg($im, $uploads_dir . $imageName);
                        imagejpeg($thumb, $uploads_dir . $imageName);

                        //save record to database table 
                        $postFiles = new PostFiles();
                        $postFiles->post_id = $room->primaryKey;
                        $postFiles->file_name = $imageName;
                        if ($postFiles->save()) {
//                            return "good everything is saved";
                        } else {
//                            return $postFiles->getErrors();
                        }
//                        return "good post only saved";
                    }
                }
            } else {
                return $room->getErrors();
            }

            return "true";
        } else if ($type == "text") {
            $room->color1 = $color1;
            $room->color2 = $color2;
//            return $room;
//            return $room->getErrors();
            if ($room->save()) {
                return "true";
            } else {
                return $room->getErrors();
            }
        } else {
            if ($room->save()) {
                return "true";
            } else {
                return $room->getErrors();
            }
        }


        return "https://www.streameapp.com/postVideos/" . $randomFileName;




        $post = Yii::$app->request->post();
        $title = $post["title"];
        $text = $post["text"];
        $user = $post["userId"];
        $type = $post["type"];
        $category = $post["category"];
        $mention = $post["mention"];

        $room = new Rooms();
        $room->title = $title;
        $room->c_text = $text;
        $room->r_admin = $user;
        $room->type = $type;
        $room->category = $category;
        $room->mention = $mention;
        $room->creation_date = date("Y-m-d H:i:s");




        if ($room->save()) {
            return true;
        } else {
            return $room->errors;
        }
    }

    public function actionUpdateRoom() {
        $post = Yii::$app->request->post();
        $text = $post["text"];
        $roomId = $post["roomId"];

        $page_link = $post["page_link"];
        $date = $post["date"];
        $room = Rooms::find()
                ->where(['id' => $roomId])
                ->one();
        $room->page_link = $page_link;

        $room->c_text = $text;
//
//        return $user;
        $room->creation_date = $date;
//        $post = new Rooms();
//        $post->page_link = "link";
//        $post->page_name = "name";
//        $post->r_admin = "12";
//        $post->c_text = "text";
// $post->creation_date = "date";
        if ($room->update()) {
            return true;
        } else {
            return $room->errors;
        }
    }

    public function actionGetRooms() {

        $post = Yii::$app->request->post();
        $userId = $post["userId"];
        $sql = "SELECT rooms.*, users.profile_picture,users.fullname,followrooms.r_room as room_id_liked,
            (SELECT COUNT(id) FROM followrooms WHERE r_room = rooms.id) as number_of_likes,type,
            (SELECT GROUP_CONCAT(file_name SEPARATOR ',') FROM post_files WHERE post_id = rooms.id) as files
             FROM rooms
             JOIN users ON rooms.r_admin = users.id
             LEFT JOIN followrooms ON followrooms.r_room = rooms.id AND followrooms.r_user = $userId
            
             ORDER BY rooms.creation_date DESC;";
        $command = Yii::$app->db->createCommand($sql);
        $arrayList = $command->queryAll();
// WHERE rooms.creation_date >= CURDATE()

        return $arrayList;
    }

    public function actionGetFollowedStreamers() {

        $post = Yii::$app->request->post();
        $userId = $post["userId"];

//
//        $sql = "SELECT * FROM `users`
//LEFT JOIN follow on users.id = follow.r_page
//WHERE follow.r_user = $userId";
//        $command = Yii::$app->db->createCommand($sql);
//        $arrayList = $command->queryAll();
//
        $streamers = Users::find()
                ->leftJoin('follow', 'users.id = follow.r_page')
                ->where(['follow.r_user' => $userId])
                ->all();



        return $streamers;
    }

    public function actionGetRoomsByUser() {

        $post = Yii::$app->request->post();
        $userId = $post["userId"];

//        $rooms = Rooms::find()
//                ->where(['r_admin' => $userId])
//                ->all();

        $sql = "SELECT rooms.*, users.profile_picture,users.fullname,followrooms.r_room as room_id_liked,
            (SELECT COUNT(id) FROM followrooms WHERE r_room = rooms.id) as number_of_likes,type,
            (SELECT GROUP_CONCAT(file_name SEPARATOR ',') FROM post_files WHERE post_id = rooms.id) as files
             FROM rooms
             JOIN users ON rooms.r_admin = users.id
             LEFT JOIN followrooms ON followrooms.r_room = rooms.id AND followrooms.r_user = $userId
             WHERE  rooms.r_admin = $userId ;";

        $command = Yii::$app->db->createCommand($sql);
        $arrayList = $command->queryAll();


        return $arrayList;
    }

    public function actionGetMyChallenges() {

        $post = Yii::$app->request->post();
        $userId = $post["userId"];

//        $rooms = Rooms::find()
//                ->where(['r_admin' => $userId])
//                ->all();





        $sql = "SELECT rooms.*, users.profile_picture,users.fullname,followrooms.r_room as room_id_liked,
            (SELECT COUNT(id) FROM followrooms WHERE r_room = rooms.id) as number_of_likes,type,
            (SELECT GROUP_CONCAT(file_name SEPARATOR ',') FROM post_files WHERE post_id = rooms.id) as files
             FROM rooms
             JOIN users ON rooms.r_admin = users.id
               LEFT JOIN followrooms ON followrooms.r_room = rooms.id AND followrooms.r_user = $userId
             WHERE  rooms.mention = $userId AND rooms.category = 'challenge' AND rooms.invitation_response is NULL  OR rooms.invitation_response=1";



        $command = Yii::$app->db->createCommand($sql);
        $arrayList = $command->queryAll();


        return $arrayList;
    }

    public function actionGetRelatedChallenges() {

        $post = Yii::$app->request->post();
        $userId = $post["userId"];

//        $rooms = Rooms::find()
//                ->where(['r_admin' => $userId])
//                ->all();





        $sql = "SELECT rooms.*, users.profile_picture,users.fullname,followrooms.r_room as room_id_liked,
            (SELECT COUNT(id) FROM followrooms WHERE r_room = rooms.id) as number_of_likes,type,
            (SELECT GROUP_CONCAT(file_name SEPARATOR ',') FROM post_files WHERE post_id = rooms.id) as files
             FROM rooms
             JOIN users ON rooms.r_admin = users.id
               LEFT JOIN followrooms ON followrooms.r_room = rooms.id AND followrooms.r_user = $userId
             WHERE  rooms.mention = $userId OR rooms.r_admin = $userId AND rooms.category = 'challenge' AND rooms.invitation_response is NULL  OR rooms.invitation_response=1";



        $command = Yii::$app->db->createCommand($sql);
        $arrayList = $command->queryAll();


        return $arrayList;
    }

    public function actionAcceptChallenge() {
        $post = Yii::$app->request->post();
        $roomId = $post["roomId"];
        $room = Rooms::find()
                ->where(['id' => $roomId])
                ->one();
        if ($room) {
            $room->invitation_response = 1;
            if ($room->save()) {
                return true;
            }
        }
    }

    public function actionDeclineChallenge() {
        $post = Yii::$app->request->post();
        $roomId = $post["roomId"];
        $room = Rooms::find()
                ->where(['id' => $roomId])
                ->one();
        if ($room) {
            $room->invitation_response = 0;
            if ($room->save()) {
                return true;
            }
        }
    }

    public function actionUserWinChallenge() {
        $post = Yii::$app->request->post();
        $roomId = $post["roomId"];
        $room = Rooms::find()
                ->where(['id' => $roomId])
                ->one();
        if ($room) {
            $room->challenge_result = 1;
            $room->challenge_user_result = 1;
            if ($room->save()) {
                return true;
            }
        }
    }

    public function actionUserLoseChallenge() {
        $post = Yii::$app->request->post();
        $roomId = $post["roomId"];
        $room = Rooms::find()
                ->where(['id' => $roomId])
                ->one();
        if ($room) {

            $room->challenge_user_result = 0;
            if ($room->save()) {
                return true;
            }
        }
    }

    public function actionStreamerAcceptLoseChallenge() {
        $post = Yii::$app->request->post();
        $roomId = $post["roomId"];
        $room = Rooms::find()
                ->where(['id' => $roomId])
                ->one();
        if ($room) {

            $room->streamer_response = 1;
            $room->challenge_result = $room->challenge_user_result;
            if ($room->save()) {
                return true;
            }
        }
    }

    public function actionStreamerDeclineLoseChallenge() {
        $post = Yii::$app->request->post();
        $roomId = $post["roomId"];
        $room = Rooms::find()
                ->where(['id' => $roomId])
                ->one();
        if ($room) {

            $room->streamer_response = 0;
            if ($room->save()) {
                return true;
            } else
                return $room->errors;
        }
    }

    public function actionGetProUsersPosts() {

        \Yii::$app->response->format = Response::FORMAT_JSON;

        $post = Yii::$app->request->post();
        $userId = $post["userId"];

//        $posts = (new Query)
//                ->select('pro_user_posts.*,users.fullname,users.profile_picture')
//                ->from("pro_user_posts")
//                ->join('join', 'users', 'users.id = pro_user_posts.user_id')
////                ->where(['>=', 'creation_date', new Expression('UNIX_TIMESTAMP(NOW() - INTERVAL 1 DAY)')])
//                ->where('creation_date >= now() - INTERVAL 1 DAY')
//                ->groupBy('pro_user_posts.user_id')
//                    ->orderBy('creation_date DESC')
//                ->all();
//        return $posts;

        $posts = (new Query)
                ->select("pro_user_posts.*,users.fullname,users.profile_picture,
                    COUNT(pro_user_posts.id) as count,
                    (SELECT COUNT(pro_user_posts_views.id) as count
                          FROM pro_user_posts_views 
                          JOIN pro_user_posts pup ON pup.id = pro_user_posts_views.pro_post_id
                          WHERE pro_user_posts_views.user_id = $userId AND pro_user_posts_views.creation_date >= now() - INTERVAL 1 DAY AND pup.user_id = pro_user_posts.user_id
                          ORDER BY pro_user_posts_views.creation_date DESC
                          ) as viewed_count")
                ->from("pro_user_posts")
                ->join('join', 'users', 'users.id = pro_user_posts.user_id')
//                ->where(['>=', 'creation_date', new Expression('UNIX_TIMESTAMP(NOW() - INTERVAL 1 DAY)')])
                ->where('creation_date >= now() - INTERVAL 1 DAY')
                ->groupBy('pro_user_posts.user_id')
                ->orderBy('creation_date DESC')
                ->all();

        return $posts;

        $temp_array1 = [];
        $temp_array2 = [];
        for ($i = 0; $i < sizeof($posts); $i++) {
            $post = $posts[$i];
            if ($post["count"] > $post["viewed_count"]) {
                array_push($temp_array1, $post);
            } else {
                array_push($temp_array2, $post);
            }
        }
        for ($j = 0; $j < sizeof($temp_array2); $j++) {
            array_push($temp_array1, $temp_array2[$j]);
        }

        return $temp_array1;
//        return json_decode(json_encode($temp_array1), FALSE);
        return $posts;
    }

    public function actionGetProUserPosts() {

        $post = Yii::$app->request->post();

        $userId = $post["userId"];

        $posts = ProUserPosts::find()
                ->where(['user_id' => $userId])
                ->andWhere('creation_date >= now() - INTERVAL 1 DAY')
                ->orderBy('creation_date DESC')
                ->all();
        return $posts;
    }

    public function actionCreateProUserPost() {
        $post = Yii::$app->request->post();
        $userId = $post["userId"];

        $file_name = $_FILES['myFile']['name'];
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $temp_name = $_FILES['myFile']['tmp_name'];
        $randomFileName = Yii::$app->security->generateRandomString() . "." . $ext;
        $location = "proUserPost/";
        if (move_uploaded_file($temp_name, $location . $randomFileName)) {

            $proUserPost = new ProUserPosts();
            $proUserPost->video = $randomFileName;
            $proUserPost->user_id = $userId;

            if ($proUserPost->save()) {

                $imageString = $post["imageString"];
                //for image
                $location = "postPictures/";
                $uploads_dir = $location;
                $imageName = Yii::$app->security->generateRandomString() . ".jpeg";
                $percent = 1;

                $data = base64_decode($imageString);

                $im = imagecreatefromstring($data);
                $width = imagesx($im);
                $height = imagesy($im);
                $newwidth = $width * $percent;
                $newheight = $height * $percent;
                $thumb = imagecreatetruecolor($newwidth, $newheight);
                header('Content-type: image/jpeg');
                // Resize
                imagecopyresized($thumb, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                // Output
//                    imagejpeg($im, $uploads_dir . $imageName);
                imagejpeg($thumb, $uploads_dir . $imageName);

                //save record to database table 
                $proUserPost = ProUserPosts::findOne(["id" => $proUserPost->primaryKey]);
                $proUserPost->image = $imageName;

                if ($proUserPost->save()) {
                    
                }
                return "true";
            } else {
                return $proUserPost->getErrors();
            }
        } else {
            return "not upload";
        }
    }

    public function actionGetOneRoom() {

        $post = Yii::$app->request->post();

        $roomId = $post["roomId"];

        $sql = "SELECT rooms.*, users.profile_picture
        FROM rooms
         JOIN users ON rooms.r_admin = users.id
        WHERE rooms.id = $roomId;";
        $command = Yii::$app->db->createCommand($sql);
        $result = $command->queryOne();

        return $result;
    }

    public function actionGetStreamers() {
        $streamers = Users::find()
                ->where(["role" => '1'])
                ->all();
        return $streamers;
    }

    public function actionSignup() {
        $post = Yii::$app->request->post();

        $fullname = $post["fullname"];

        $password = $post["password"];
        $username = $post["username"];
//        $pubgId = $post["pubgId"];
        $role = $post["role"];
//        $link = $post["link"];


        $linkFacebook = $post["linkFacebook"];
        $linkYoutube = $post["linkYoutube"];
        $linkInstagram = $post["linkInstagram"];
        $linkTiktok = $post["linkTiktok"];

        $userGames = $post["signupUserGames"];
        $userGamesDecode = json_decode($userGames);

        $user = new Users();
        $user->username = $username;
        $user->fullname = $fullname;
//        $user->pubgId = $pubgId;
        $user->password = $password;
//        $user->link = $link;
        $user->role = $role;

        if ($role . contains(1)) {
            $user->is_approved = 0;
        } else {
            $user->is_approved = 1;
        }

        $user->link_facebook = $linkFacebook;
        $user->link_youtube = $linkYoutube;
        $user->link_instagram = $linkInstagram;
        $user->link_tiktok = $linkTiktok;


        if ($user->save()) {
            for ($i = 0; $i < sizeof($userGamesDecode); $i++) {
                $userGame = $userGamesDecode[$i];
                $model = new StreamerGames();
                $model->user_id = $user->id;
                $model->game_id = $userGame->id;
                $model->game_account_id = $userGame->account_game_id;
                if ($model->save()) {
                    
                }
            }

            return true;
        } else
            return $user->errors;
    }

    public function actionSignup2() {
        $post = Yii::$app->request->post();
        $fullname = $post["fullname"];
        $url = $post["link"];
        $password = $post["password"];
        $username = $post["username"];
        $pubgId = $post["pubgId"];
        $user = new Users();
        $user->username = $username;
        $user->fullname = $fullname;
        $user->link = $url;
        $user->role = 1;
        $user->pubgid = $pubgId;
        $user->password = $password;

        if ($user->save()) {
            return true;
        } else
            return false;
    }

    public function actionLogin() {
        $post = Yii::$app->request->post();

        $password = $post["password"];
        $username = $post["username"];
//        $role = $post["role"];
        $token = $post["token"];

        $user = Users::findOne([
                    'username' => $username,
                    'password' => $password,
//                    'role' => $role
        ]);

//        return $user;

        if ($user) {
            $user->token = $token;
            $user->save();

            return $user;
        } else
            return $user->errors;
    }

    public function actionLogin2() {
        $post = Yii::$app->request->post();

        $password = $post["password"];
        $username = $post["username"];

        $user = Users::find()
                ->where(['username' => $username])
                ->andWhere(['password' => $password])
                ->one();
        if ($user)
            return $user;
        else
            return $user->errors;
    }

    public function actionAddComment() {
        $post = Yii::$app->request->post();
        $postId = $post["postId"];
        $text = $post["text"];
        $userId = $post["userId"];

        $comment = new Comment();
        $comment->r_room = $postId;
        $comment->r_user = $userId;
        $comment->c_text = $text;
        if ($comment->save()) {
            $userThatMakeComment = Users::findOne(["id" => $userId]);
            $notification = new NotificationForm();
            $notification->subject = $userThatMakeComment->fullname;
            $notification->message = $text;

            $room = Rooms::findOne(["id" => $postId]);
            $userRoomOwner = Users::findOne(["id" => $room->r_admin]);

            $firebaseTokenOfRoomOwner = $userRoomOwner->token;
            $commentsUsers = Comment::find()
                    ->select("DISTINCT(users.token)")
                    ->where([
                        "r_room" => $postId,
                    ])
                    ->andWhere("comment.r_user != $userRoomOwner->id")
                    ->join("join", "users", "users.id = comment.r_user")
                    ->asArray()
                    ->column();
            array_push($commentsUsers, $firebaseTokenOfRoomOwner);
            $notification->notifyToUserGoToAd($commentsUsers, $postId);
            return "true";
        } else {
            return "false";
        }
    }

    public function actionFollow() {
        $post = Yii::$app->request->post();
        $roomId = $post["r_room"];

        $userId = $post["r_user"];
        $token = $post["token"];

        $follow = new Followrooms();
        $follow->r_room = $roomId;
        $follow->r_user = $userId;
        $follow->user_token = $token;

        if ($follow->save()) {
            return true;
        } else {
            return $follow->errors;
        }
    }

    public function actionSendNotificationMyUsers() {

        $post = Yii::$app->request->post();
        $roomId = $post["roomId"];
        $userId = $post["userId"];


        $tokens = (new Query)
                ->select("users.token  ")
                ->from(Follow::tableName())
                ->where([
                    "r_page" => $userId
                ])
                ->join("join", "users", Follow::tableName() . ".r_user = users.id")
                ->column();

        $room = Rooms::find()
                ->where(['id' => $roomId])
                ->one();

        $pageName = $room["page_name"];
        $userNotifications = UserNotifications::find()->where(["user_id" => $userId])->one();

        if ($userNotifications) {

            $remainingNotifications = $userNotifications["number_remaining"];
            if ($remainingNotifications > 0) {

                $notification = new NotificationForm();
                $notification->subject = "Streamer " . $pageName;
                $notification->message = "My Stream is Live Now";
                $notification->notifyToUserGoToAd($tokens, $roomId);

                $userNotifications["number_remaining"] = $userNotifications["number_remaining"] - 1;

                $userNotifications->save();

                return "Notification Sent";
            } else
                return "Your Notification Balance is Empty Please recharge";
        } else
            return "You don't have Any purchase";
    }

    public function actionSendNotificationAllUsers() {

        $post = Yii::$app->request->post();
        $roomId = $post["roomId"];
        $userId = $post["userId"];


        $room = Rooms::find()
                ->where(['id' => $roomId])
                ->one();

        $pageName = $room["page_name"];



        $tokens = (new Query)
                ->select("token")
                ->from("users")
                ->column();

        $userNotifications = UserNotifications::find()->where(["user_id" => $userId])->one();

        if ($userNotifications) {

            $remainingNotifications = $userNotifications["number_remaining_for_all_users"];
            if ($remainingNotifications > 0) {

                $notification = new NotificationForm();
                $notification->subject = "Streamer " . $pageName;
                $notification->message = "My Stream is Live Now";
                $notification->notifyToUserGoToAd($tokens, $roomId);

                $userNotifications["number_remaining_for_all_users"] = $userNotifications["number_remaining_for_all_users"] - 1;
                $userNotifications->save();

                return "Notification For All Users Sent";
            } else
                return "Your Notification Balance is Empty Please recharge";
        } else
            return "You don't have Any purchase";



//        return ["room" => $room, "tokens" => $tokens, "notifications" => $userNotifications];
    }

    public function actionCheckIfHaveNotifications() {

        $post = Yii::$app->request->post();

        $userId = $post["userId"];




        $userNotifications = UserNotifications::find()->where(["user_id" => $userId])->one();

        if ($userNotifications) {

            $remainingNotifications = $userNotifications["number_remaining"];
            if ($remainingNotifications > 0) {

                return true;
            } else
                return false;
        } else
            return false;
    }

    public function actionCheckIfHaveNotificationsForAll() {
        $post = Yii::$app->request->post();

        $userId = $post["userId"];




        $userNotifications = UserNotifications::find()->where(["user_id" => $userId])->one();

        if ($userNotifications) {

            $remainingNotifications = $userNotifications["number_remaining_for_all_users"];
            if ($remainingNotifications > 0) {
                return true;
            } else
                return false;
        } else
            return false;
    }

    public function actionUnfollow() {
        $post = Yii::$app->request->post();
        $roomId = $post["r_room"];

        $userId = $post["r_user"];


        $unfollow = Followrooms::find()
                ->where(["r_room" => $roomId])
                ->andWhere(["r_user" => $userId])
                ->one();
        $unfollow->delete();

        if ($unfollow->delete()) {
            return true;
        } else {
            return false;
        }
    }

    public function actionChecked() {
        $post = Yii::$app->request->post();
        $roomId = $post["r_room"];

        $userId = $post["r_user"];

        $user = Followrooms::find()
                ->where(['r_room' => $roomId])
                ->andWhere(['r_user' => $userId])
                ->one();
        if ($user)
            return true;
        else
            return false;
    }

    public function actionGetCommentsByPost() {
        $post = Yii::$app->request->post();
        $postId = $post["postId"];

        $commentsByPost = (new Query)
                ->select(Comment::tableName() . ".*,users.fullname,users.profile_picture")
                ->from(Comment::tableName())
                ->where([
                    "r_room" => $postId
                ])
                ->join("join", "users", Comment::tableName() . ".r_user = users.id")
                ->orderBy("creation_date Desc")
                ->all();

        return $commentsByPost;
    }

    public function actionGetAdminNameAndLink() {
        $userId = Yii::$app->request->post();
        $userId = $userId["id"];

        $user = Pageadmin::find()
                ->where(['id' => $userId])
                ->one();
        if ($user)
            return $user;
        else
            return false;
    }

    public function actionRemoveRoomById() {
        $post = Yii::$app->request->post();
        $adId = $post["roomId"];

        $comments = Comment::find()
                ->where(["r_room" => $adId])
                ->one();
        while ($comments) {
            $comments->delete();
            $comments = Comment::find()
                    ->where(["r_room" => $adId])
                    ->one();
        }

        $follow = Followrooms::find()
                ->where(["r_room" => $adId])
                ->one();


        while ($follow) {
            $follow->delete();
            $follow = Followrooms::find()
                    ->where(["r_room" => $adId])
                    ->one();
        }

        $ad = Rooms::findOne(["id" => $adId]);

        if ($ad->delete()) {
            return "success";
        } else {
            return $ad->errors;
        }
    }

    public function actionRoomsByUser() {
        $post = Yii::$app->request->post();
        $id = $post["id"];
//        $id = 1;
//$client = \app\models\User::findOne(["id" => $id]);

        $adsQuery = (new Query)
                ->select("*")
                ->from("rooms")
                ->where([
                    "r_admin" => $id,
                ])
                ->orderBy("creation_date DESC")
                ->all();

        return $adsQuery;
    }

    public function actionUpdateProfile() {



        $post = Yii::$app->request->post();

        $id = $post["id"];
        $fullname = $post["fullname"];

        $linkFacebook = $post["linkFacebook"];
        $linkYoutube = $post["linkYoutube"];
        $linkInstagram = $post["linkInstagram"];
        $linkTiktok = $post["linkTiktok"];

        $userGames = $post["userGames"];
        $userGamesDecode = json_decode($userGames);

//        if (isset($userGamesDecode[1]->game_account_id)) {
//            return [
//                "status" => "0",
//                "message" => json_encode($userGamesDecode[1])
//            ];
//        } else {
//            return [
//                "status" => "0",
//                "message" => json_encode($userGamesDecode[1])
//            ];
//        }


        $model = Users::findOne(["id" => $id]);
        if ($model) {
            $model->fullname = $fullname;
            $model->link_facebook = $linkFacebook;
            $model->link_youtube = $linkYoutube;
            $model->link_instagram = $linkInstagram;
            $model->link_tiktok = $linkTiktok;

            if ($model->save()) {

                for ($i = 0; $i < sizeof($userGamesDecode); $i++) {
                    $userGame = $userGamesDecode[$i];
                    if (isset($userGame->game_account_id)) {
                        if (isset($userGame->streamerGameId)) {
                            $model = StreamerGames::findOne(["id" => $userGame->streamerGameId]);
                            if ($model) {
                                if ($userGame->game_account_id == "") {
                                    $model->delete();
                                } else {
                                    $model->user_id = $id;
                                    $model->game_id = $userGame->game_id;
                                    $model->game_account_id = $userGame->game_account_id;
                                    if ($model->save()) {
                                        
                                    } else {
                                        return [
                                            "status" => "0",
                                            "message" => "error in updating games"
                                        ];
                                    }
                                }
                            } else {
                                return [
                                    "status" => "0",
                                    "message" => "does not exists"
                                ];
                            }
                        } else {
                            if ($userGame->game_account_id != "") {
                                $model = new StreamerGames();
                                $model->user_id = $id;
                                $model->game_id = $userGame->id;
                                $model->game_account_id = $userGame->game_account_id;
                                if ($model->save()) {
                                    
                                } else {
                                    return [
                                        "status" => "0",
                                        "message" => "error in saving games"
                                    ];
                                }
                            } else {
                                
                            }
                        }
                    } else {




                        if (isset($userGame->id)) {

                            $model = StreamerGames::findOne([
                                        "user_id" => $id,
                                        "game_id" => $userGame->id
                            ]);
                            if ($model) {
                                $model->delete();
                            }
                        }
                    }
                }

                return [
                    "status" => "1",
                    "message" => "success"
                ];
            } else {
                return [
                    "status" => "0",
                    "message" => "error in saving data"
                ];
            }
        } else {

            return [
                "status" => "0",
                "message" => "no user exist"
            ];
        }
    }

    public function actionFollowStreamer() {

        $post = Yii::$app->request->post();

        $r_user = $post["r_user"];
        $r_page = $post["r_page"];
        $follow = new Follow();
        $follow->r_user = $r_user;
        $follow->r_page = $r_page;



        if ($follow->save()) {
            return true;
        } else {
            return $follow->errors;
        }
    }

    public function actionSliverSpinReward() {

        $post = Yii::$app->request->post();

        $userId = $post["userId"];
        $prizeId = $post["prizeId"];
        $reward = new UsersSpinSilver();
        $reward->userId = $userId;
        $reward->prizedId = $prizeId;
        $reward->date = date("Y-m-d H:i:s");




        if ($reward->save()) {
            return true;
        } else {
            return $reward->errors;
        }
    }

    public function actionCheckSpin() {

        $post = Yii::$app->request->post();

        $userId = $post["userId"];
        $date = date("Y-m-d H:i:s");
        $timestamp1 = strtotime($date);


        $reward = (new Query)
                ->select("*")
                ->from("users_spin_silver")
                ->where(['userId' => $userId])
                ->orderBy("id Desc")
                ->one();
        $timestamp2 = strtotime($reward['date']);

        if ((($timestamp1 - $timestamp2) / 3600) > 24) {

            return false;
//            return ["result" => "can",
//                "date" => $reward['date'],
//                "reward" => $reward,
//                "time1" => $timestamp1,
//                "time2" => $timestamp2,
//                "diff" => ($timestamp1 - $timestamp2) / 3600];
        } else {
            return true;
//            return ["result" => "can't",
//                "date" => $reward['date'],
//                "reward" => $reward,
//                "time1" => $timestamp1,
//                "time2" => $timestamp2,
//                "diff" => ($timestamp1 - $timestamp2) / 3600];
        }
    }

    public function actionUnfollowStreamer() {

        $post = Yii::$app->request->post();

        $r_user = $post["r_user"];
        $r_page = $post["r_page"];
        $follow = Follow::find()
                ->where(['r_user' => $r_user])
                ->andWhere(['r_page' => $r_page])
                ->one();




        if ($follow->delete()) {
            return true;
        } else {
            return $follow->errors;
        }
    }

    public function actionGetNumberOfFollowers() {


        $post = Yii::$app->request->post();

        $r_user = $post["r_user"];


        $count = Follow::find()
                ->where(['r_page' => $r_user])
                ->all();

        return sizeof($count);
    }

    public function actionUploadProfilePicture() {

        $post = Yii::$app->request->post();

        $image = $post["image"];
        $userId = $post["userId"];

        $user = Users::findOne(["id" => $userId]);

        if ($user) {

            if (!file_exists(\Yii::getAlias('@webroot/profilePicture'))) {
                mkdir(\Yii::getAlias('@webroot/profilePicture'), 0777, true);
            }
            if ($image != "" && $image != null && $image) {
                $uploads_dir = \Yii::getAlias('@webroot/profilePicture/');
                $imageName = Yii::$app->security->generateRandomString() . ".jpeg";
                $percent = 0.8;

                $data = base64_decode($image);
                $im = imagecreatefromstring($data);
                $width = imagesx($im);
                $height = imagesy($im);
                $newwidth = $width * $percent;
                $newheight = $height * $percent;
                $thumb = imagecreatetruecolor($newwidth, $newheight);

//                            header('Content-type: image/jpeg');
// Resize
                imagecopyresized($thumb, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

// Output
                imagejpeg($thumb, $uploads_dir . $imageName);
                if ($user->profile_picture && file_exists(\Yii::getAlias('@webroot/profilePicture/') . $user->profile_picture)) {
                    unlink(\Yii::getAlias('@webroot/profilePicture/') . $user->profile_picture);
                }

                $user->profile_picture = $imageName;
                if ($user->save()) {
                    return[
                        'status' => "1",
                        'message' => "success",
                        'data' => $imageName
                    ];
                } else {
                    return [
                        "status" => "0",
                        "message" => "error in uploading image",
                    ];
                }
            }
        } else {
            return [
                "status" => "0",
                "message" => "no user found",
            ];
        }
    }

    public function actionGetProfileData() {
        $post = Yii::$app->request->post();

        $userId = $post["userId"];
//        $userId = 13;
        $userProfile = Users::find()
                ->select("username,fullname,role,link_facebook,link_youtube,link_instagram,link_tiktok,profile_picture")
                ->where(['id' => $userId])
                ->asArray()
                ->one();




        $games = (new Query)
                ->select("games.id,games.name,streamer_games.user_id,streamer_games.game_id,streamer_games.game_account_id,streamer_games.id as streamerGameId")
                ->from("games")
                ->leftJoin("streamer_games", "games.id = streamer_games.game_id AND streamer_games.user_id = '" . $userId . "'")
                ->all();

        $userProfile["userGame"] = $games;

//        \yii\helpers\VarDumper::dump($userProfile, 10, true);
//
//          $post = Yii::$app->request->post();
//        die();

        return $userProfile;
    }

    public function actionGetPostData() {
        $post = Yii::$app->request->post();

        $roomId = $post["roomId"];
//        $userId = 13;
        $myPost = Rooms::find()
                ->select("*")
                ->where(['id' => $roomId])
                ->asArray()
                ->one();


        return $myPost;
    }

    public function actionGetProfileDataWithFollowers() {
        $post = Yii::$app->request->post();

        $userId = $post["userId"];
        $visitorId = $post["visitorId"];
//        $userId = 13;
        $userProfile = Users::find()
                ->select("username,fullname,role,link_facebook,link_youtube,link_instagram,link_tiktok,profile_picture,")
                ->where(['id' => $userId])
                ->asArray()
                ->one();


        $games = (new Query)
                ->select("games.id,games.name,streamer_games.user_id,streamer_games.game_id,streamer_games.game_account_id,streamer_games.id as streamerGameId")
                ->from("games")
                ->leftJoin("streamer_games", "games.id = streamer_games.game_id AND streamer_games.user_id = '" . $userId . "'")
                ->all();

        $userProfile["userGame"] = $games;
//        \yii\helpers\VarDumper::dump($userProfile, 10, true);
//
//          $post = Yii::$app->request->post();
        $following = Follow::find()
                ->where(['r_user' => $visitorId])
                ->andWhere(['r_page' => $userId])
                ->one();
        if ($following) {
            $userProfile["following"] = 1;
        } else {
            $userProfile["following"] = 0;
        }
        $countposts = Rooms::find()
                ->where(['r_admin' => $userId])
                ->all();

        $userProfile["numberOfPosts"] = sizeof($countposts);


        $count = Follow::find()
                ->where(['r_page' => $userId])
                ->asArray()
                ->all();


        $userProfile["numberOfFollowers"] = sizeof($count);

        $userNotifications = UserNotifications::find()
                        ->where(['user_id' => $userId])->one();

        if ($userNotifications) {
            $userProfile["userNotifications"] = $userNotifications;
        } else {
            $userProfile["userNotifications"] = null;
        }

        return $userProfile;
    }

    public function actionGetGames() {

        $games = (new Query)
                ->select("*")
                ->from("games")
                ->all();

        return $games;
    }

    public function actionHandlePurchase() {

        $post = Yii::$app->request->post();

        $userId = $post["userId"];
        $productId = $post["productId"];

        $orderId = $post["orderId"];
        $packageName = $post["packageName"];
        $purchaseTime = $post["purchaseTime"];
        $purchaseState = $post["purchaseState"];
        $purchaseToken = $post["purchaseToken"];
        $quantity = $post["quantity"];
        $acknowledged = $post["acknowledged"];


        if ($productId == "remove_ads" || $productId == "elite") {
            $userPurchace = new UserPurchaseDetails();
            $userPurchace->user_id = $userId;
            $userPurchace->orderId = $orderId;
            $userPurchace->packageName = $packageName;
            $userPurchace->productId = $productId;
            $userPurchace->purchaseTime = $purchaseTime;
            $userPurchace->purchaseState = $purchaseState;
            $userPurchace->purchaseToken = $purchaseToken;
            $userPurchace->quantity = $quantity;
            $userPurchace->acknowledged = $acknowledged;
            if ($userPurchace->save()) {
                return [
                    "status" => "2",
                    "message" => "Success",
                ];
            } else {
                return [
                    "status" => "0",
                    "message" => "error in saving purchase",
                ];
            }
        } else {

            $addNotificationsRemaining = 0;
            $addNotificationsToAllUsersRemaining = 0;
            if ($productId == "30_notifications") {
                $addNotificationsRemaining = 30;
            } else if ($productId == "60_notifications") {
                $addNotificationsRemaining = 60;
            } else if ($productId == "90_notifications_3_toall") {
                $addNotificationsRemaining = 90;
                $addNotificationsToAllUsersRemaining = 3;
            } else if ($productId == "120_notifications_10_toall") {
                $addNotificationsRemaining = 120;
                $addNotificationsToAllUsersRemaining = 10;
            }
//        else if ($productId == "") {
//            $addNotificationsRemaining = ;
//        }

            $userNotifications = UserNotifications::findOne(["user_id" => $userId]);
            if ($userNotifications) {
                $userNotifications->number_remaining = $userNotifications->number_remaining + $addNotificationsRemaining;
                $userNotifications->number_remaining_for_all_users = $userNotifications->number_remaining_for_all_users + $addNotificationsToAllUsersRemaining;
            } else {
                $userNotifications = new UserNotifications();
                $userNotifications->user_id = $userId;
                $userNotifications->number_remaining = $addNotificationsRemaining;
                $userNotifications->number_remaining_for_all_users = $addNotificationsToAllUsersRemaining;
            }
            if ($userNotifications->save()) {
                $userPurchace = new UserPurchaseDetails();
                $userPurchace->user_id = $userId;
                $userPurchace->orderId = $orderId;
                $userPurchace->packageName = $packageName;
                $userPurchace->productId = $productId;
                $userPurchace->purchaseTime = $purchaseTime;
                $userPurchace->purchaseState = $purchaseState;
                $userPurchace->purchaseToken = $purchaseToken;
                $userPurchace->quantity = $quantity;
                $userPurchace->acknowledged = $acknowledged;
                if ($userPurchace->save()) {
                    
                }
                return [
                    "status" => "1",
                    "message" => "Success",
                ];
            } else {

                return [
                    "status" => "0",
                    "message" => "error in saving notifications",
                ];
            }
        }
    }

    public function actionChangePassword() {

        $post = Yii::$app->request->post();

        $username = $post["username"];
        $password = $post["password"];

        $user = Users::findOne(["username" => $username]);
        if ($user) {
            $user->password = $password;
            if ($user->save()) {
                return [
                    "status" => "1",
                    "message" => "Success",
                ];
            } else {
                return [
                    "status" => "0",
                    "message" => "something went wrong when saving",
                ];
            }
        } else {
            return [
                "status" => "0",
                "message" => "user does not exist",
            ];
        }
    }

    public function actionTestUploadVideo() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST[""];
            $file_name = $_FILES['myFile']['name'];
            $ext = pathinfo($file_name, PATHINFO_EXTENSION);
//            $file_size = $_FILES['myFile']['size'];
//            $file_type = $_FILES['myFile']['type'];
            $temp_name = $_FILES['myFile']['tmp_name'];

            $randomFileName = Yii::$app->security->generateRandomString() . "." . $ext;
            $location = "postVideos/";


            move_uploaded_file($temp_name, $location . $randomFileName);


            return "https://www.streameapp.com/postVideos/" . $randomFileName;
        } else {
            return "Error";
        }
    }

    public function actionProPostViewed() {

        $post = Yii::$app->request->post();

        $userId = $post["userId"];
        $proPostId = $post["proPostId"];


        $model = new ProUserPostsViews();
        $model->user_id = $userId;
        $model->pro_post_id = $proPostId;
        if ($model->save()) {
            return [
                "status" => "true",
                "message" => "saved"
            ];
        } else {
            return [
                "status" => "true",
                "message" => "already Saved"
            ];
        }
    }

}
