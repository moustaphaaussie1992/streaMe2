<?php

namespace app\controllers\api;

use app\models\Comment;
use app\models\Follow;
use app\models\Followrooms;
use app\models\NotificationForm;
use app\models\Pageadmin;
use app\models\Rooms;
use app\models\StreamerGames;
use app\models\UserNotifications;
use app\models\Users;
use Yii;
use yii\db\Query;

class MobileController extends ApiController {

    public function actionCreateRoom() {
        $post = Yii::$app->request->post();
        $text = $post["text"];
//        // $image = $post["image"];
        $user = $post["userId"];
        $page_name = $post["page_name"];
        $page_link = $post["page_link"];
        $date = $post["date"];
        $room = new Rooms();
        $room->page_link = "page_link";
        $room->page_name = $page_name;
        $room->r_admin = $user;
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
        if ($room->save()) {
            return true;
        } else {
            return $room->errors;
        }
    }

    public function actionGetRooms() {

//        $posts = Rooms::find()
//                        // ->orderBy("creation_date ASC")
//                        // ->where(['>=', 'creation_date', new Expression('NOW()')])
//                        ->where(['>=', 'creation_date', date('Y-m-d H:i:s')])
//                        ->join("join", "users", Rooms::tableName() . ".r_admin = users.id")
//                        ->orderBy('creation_date')->all();

        $sql = "SELECT rooms.*, users.profile_picture
        FROM rooms
         JOIN users ON rooms.r_admin = users.id
        WHERE rooms.creation_date >= CURDATE();";
        $command = Yii::$app->db->createCommand($sql);
        $arrayList = $command->queryAll();
//


        return $arrayList;
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
        $role = $post["role"];

        $user = Users::find()
                ->where(['username' => $username])
                ->andWhere(['password' => $password])
                ->andWhere(['role' => $role])
                ->one();
        if ($user)
            return $user;
        else
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

    public function actionSendNotification() {

        $post = Yii::$app->request->post();
        $roomId = $post["roomId"];


        $tokens = (new Query)
                ->select("user_token")
                ->from("followrooms")
                ->where(["r_room" => $roomId])
                ->column();

        $notification = new NotificationForm();
        $notification->subject = "Streamer Ka2ed";
        $notification->message = "My Stream is Live Now";
//        $notification->notifyToUser(["", "cjUdLLWATVW4Keq1TQVgll:APA91bGHaFVuhRJx5pPTpMxhMDgbN88Apyf9eqUiV1_oiezAG0wzAKpddxiDjLb6D-4EhYIErV2bnl98jT-cO6iFAgXiEK5S1-SpKLMhMXezEJvad-Dr1dolcq8nim_97MvJ7mWsfrfZ"]);
        $notification->notifyToUser($tokens);
        return true;
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
                ->select(Comment::tableName() . ".*,users.fullname  ")
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

    public function actionGetProfileDataWithFollowers() {
        $post = Yii::$app->request->post();

        $userId = $post["userId"];
        $visitorId = $post["visitorId"];
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
//        die();

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


        $addNotificationsRemaining = 0;
        if ($productId == "10_notifications") {
            $addNotificationsRemaining = 10;
        } else if ($productId == "20_notifications") {
            $addNotificationsRemaining = 20;
        }

        $userNotifications = UserNotifications::findOne(["user_id" => $userId]);
        if ($userNotifications) {
            $userNotifications->number_remaining = $userNotifications->number_remaining + $addNotificationsRemaining;
        } else {
            $userNotifications = new UserNotifications();
            $userNotifications->user_id = $userId;
            $userNotifications->number_remaining = $addNotificationsRemaining;
        }
        if ($userNotifications->save()) {

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
