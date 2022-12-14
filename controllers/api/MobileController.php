<?php

namespace app\controllers\api;

use app\models\ChallengesVideos;
use app\models\ChallengeVoting;
use app\models\Comment;
use app\models\Constants;
use app\models\Follow;
use app\models\Followrooms;
use app\models\LoginForm;
use app\models\Notificaion;
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
use app\models\UserTransactions;
use Yii;
use yii\db\Query;
use yii\web\UnauthorizedHttpException;
use function contains;
use function GuzzleHttp\json_decode;

class MobileController extends ApiController {

    public function actionTest() {

        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            return ['success' => true, 'test' => 'Hello World!'];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
    }

    public function actionGetCoins() {
        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            if (isset($_POST['userId'])) {
                $userId = $_POST["userId"];
                $user = Users::findOne([
                            'id' => $userId,
//                    'role' => $role
                ]);
                return ['success' => true, 'message' => $user->coins];
            }
            return ['success' => false, 'message' => 'missing params'];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
    }

//    public function actionChallengeCheck() {
//
//
//        $post = Yii::$app->request->post();
//        $userId = $post["userId"];
//        $sql = "SELECT * FROM `rooms` WHERE is_challenge_finished= 0
//and challenge_date < CURDATE();";
//        $command = Yii::$app->db->createCommand($sql);
//        $arrayList = $command->queryAll();
//
//        if ($arrayList) {
//
////            return $arrayList;
//            for ($i = 0; $i < sizeof($arrayList); $i++) {
//
//                $mention1 = $arrayList[$i]["mention"];
//                $mention2 = $arrayList[$i]["mention2"];
//                $mention3 = $arrayList[$i]["mention3"];
//                $room = Rooms::find()
//                        ->where(['id' => $arrayList[$i]["id"]])
//                        ->one();
//
//                $ids = array();
//                array_push($ids, $room->r_admin);
//
//                if ($room) {
//
//                    if ($mention3 == null && $mention2 == null) {
//
//                        $room->challenge_winner = $mention1;
//                        $room->is_challenge_finished = "1";
//                        $room->save();
//                        array_push($ids, $room->mention);
//                    } elseif ($mention3 == null) {
//                        array_push($ids, $room->mention);
//                        array_push($ids, $room->mention2);
//
//                        $sql_count_mention1query = " SELECT COUNT(*) AS count  FROM `challenge_voting`  WHERE r_streamer_voted = " . $mention1 . " and post_id=" . $arrayList[$i]["id"] . "";
//                        $sql_count_mention2query = " SELECT COUNT(*) AS count  FROM `challenge_voting`  WHERE r_streamer_voted = " . $mention2 . " and post_id=" . $arrayList[$i]["id"] . "";
//
//                        $command = Yii::$app->db->createCommand($sql_count_mention1query);
//                        $sql_count_mention1 = $command->queryOne();
//                        $command = Yii::$app->db->createCommand($sql_count_mention2query);
//                        $sql_count_mention2 = $command->queryOne();
//
//                        if ($sql_count_mention2["count"] > $sql_count_mention1["count"]) {
//                            $room->challenge_winner = $mention2;
//                            $room->is_challenge_finished = "1";
//                            $room->save();
//                            array_push($ids, $room->mention);
//                            $winner = $mention2;
//
////                           return $sql_count_mention1;
//                        } elseif ($sql_count_mention2["count"] < $sql_count_mention1["count"]) {
//                            $room->challenge_winner = $mention1;
//                            $room->is_challenge_finished = "1";
//                            $room->save();
//                            array_push($ids, $room->mention2);
//                            $winner = $mention1;
//
////                           return $sql_count_mention1;
//                        }
//                    } elseif ($mention3 != null && $mention2 != null && $mention1 != null) {
//
//
//
//                        $sql_count_mention1query = " SELECT COUNT(*) As count  FROM `challenge_voting`  WHERE r_streamer_voted = " . $mention1 . " and post_id=" . $arrayList[$i]["id"] . "";
//                        $sql_count_mention2query = " SELECT COUNT(*) As count   FROM `challenge_voting`  WHERE r_streamer_voted = " . $mention2 . " and post_id=" . $arrayList[$i]["id"] . "";
//                        $sql_count_mention3query = " SELECT COUNT(*) As count  FROM `challenge_voting`  WHERE r_streamer_voted = " . $mention3 . " and post_id=" . $arrayList[$i]["id"] . "";
//
//                        $command = Yii::$app->db->createCommand($sql_count_mention1query);
//                        $sql_count_mention1 = $command->queryOne();
//                        $command = Yii::$app->db->createCommand($sql_count_mention2query);
//                        $sql_count_mention2 = $command->queryOne();
//
//                        $command = Yii::$app->db->createCommand($sql_count_mention3query);
//                        $sql_count_mention3 = $command->queryOne();
//
//                        if ($sql_count_mention2["count"] > $sql_count_mention1["count"] && $sql_count_mention2["count"] > $sql_count_mention3["count"]) {
//                            $room->challenge_winner = $mention2;
//                            $room->is_challenge_finished = "1";
//                            $room->save();
//                            array_push($ids, $room->mention);
//                            $winner = $mention2;
//                            array_push($ids, $room->mention3);
//                        } elseif ($sql_count_mention2["count"] < $sql_count_mention1["count"] && $sql_count_mention3["count"] < $sql_count_mention1["count"]) {
//                            $room->challenge_winner = $mention1;
//                            $room->is_challenge_finished = "1";
//                            array_push($ids, $room->mention2);
//                            $winner = $mention1;
//                            array_push($ids, $room->mention3);
//                            $room->save();
//                        } elseif ($sql_count_mention2["count"] < $sql_count_mention3["count"] && $sql_count_mention1["count"] < $sql_count_mention3["count"]) {
//                            $room->challenge_winner = $mention3;
//                            $room->is_challenge_finished = "1";
//                            array_push($ids, $room->mention1);
//                            $winner = $mention3;
//                            array_push($ids, $room->mention2);
//                            $room->save();
//                        }
//                    }
//                }
//
//
//                $tokens = Users::find()
//                        ->select("token")
//                        ->where(["id" => $ids])
//                        ->asArray()
//                        ->all();
//                $winnerUser = Users::find()
//                        ->where(["id" => $winner])
//                        ->asArray()
//                        ->one();
//
//                $votersTokens = "SELECT  users.token as token FROM `challenge_voting`
//left join users on users.id = challenge_voting.r_user
//WHERE challenge_voting.post_id=" . $room->id;
//
//                $command = Yii::$app->db->createCommand($votersTokens);
//                $votersTokensArray = $command->queryAll();
//
//                for ($j = 0; $j < sizeof($votersTokensArray); $j++) {
//
//                    array_push($tokens, $votersTokensArray[$j]);
//                }
//
////                  return ["tokens" => $tokens,
////                    "winner" => $winnerUser,
////                    "room" => $arrayList[$i]];
//
//                NotificationForm::notifyVotersTheWinner($tokens, $winnerUser, $arrayList[$i]);
//            }
//        }
//    }

    public function actionMakeDonation() {
        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            if (isset($_POST['userId']) && isset($_POST['donatorId']) && isset($_POST['coins']) && isset($_POST['roomId'])) {
                $userId = $_POST["userId"];
                $donatorId = $_POST["donatorId"];
                $coins = $_POST["coins"];
                $roomId = $_POST["roomId"];
                $user = Users::findOne([
                            'id' => $userId,
//                    'role' => $role
                ]);
                $donator = Users::findOne([
                            'id' => $donatorId,
//                    'role' => $role
                ]);

                if ($donator->coins > $coins) {

                    $donation = new UserTransactions();
                    $donation->userId = $userId;
                    $donation->fromUser = $donatorId;
                    $donation->coins = $coins;
                    $donation->type = "donation";
                    $donation->roomId = $roomId;
                    $donator->coins = $donator->coins - $coins;
                    $user->coins = $user->coins + $coins;
                    if ($donation->save()) {
                        if ($user->save()) {
                            if ($donator->save()) {
                                $myNotificationModel = new Notificaion();
                                $myNotificationModel->room_id = $roomId;
                                $myNotificationModel->sender_id = $donatorId;
                                $myNotificationModel->reciever_id = $userId;
                                $myNotificationModel->description = Constants::$MADE_A_DONATION_TO_YOU;
                                $myNotificationModel->save();

                                $user = Users::findOne(["id" => $userId]);

                                $senderName = "";
                                if ($donator) {
                                    $senderName = $donator->fullname;
                                }

                                $notification = new NotificationForm();
                                $notification->subject = $senderName;
                                $notification->message = Constants::$MADE_A_DONATION_TO_YOU;
                                $notification->notifyToUserGoToAd([$user->token], $roomId);
                                return ['success' => true, 'message' => $donator->coins];
                            }
                            return ['success' => true, 'message' => 'd', 'data' => $donator->errors];
                        }
                        return ['success' => false, 'message' => 'u', 'data' => $user->errors];
                    }
                    return ['success' => false, 'data' => $donation->errors];
                }
                return ['success' => false, 'message' => 'donator coins lessthan coins'];
            }
            return ['success' => false, 'message' => 'missing params'];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
    }

    public function actionCreateRoom() {
        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            if (isset($_POST['userId'])) {
                $title = isset($_POST["title"]) ? $_POST["title"] : null;
                $text = isset($_POST["text"]) ? $_POST["text"] : null;
                $user = $_POST["userId"];
                $type = isset($_POST["type"]) ? $_POST["type"] : null;
                $category = isset($_POST["category"]) ? $_POST["category"] : null;
                $mention = isset($_POST["mention"]) ? $_POST["mention"] : null;
                $mention2 = isset($_POST["mention2"]) ? $_POST["mention2"] : null;
                $mention3 = isset($_POST["mention3"]) ? $_POST["mention3"] : null;
                $challengeTime = isset($_POST["challengeTime"]) ? $_POST["challengeTime"] : null;
                $gameId = isset($_POST["game"]) ? $_POST["game"] : null;

                $imageString = isset($_POST["imageString"]) ? $_POST["imageString"] : null;
                $coins = isset($_POST["challengeCoins"]) ? $_POST["challengeCoins"] : null;

                $room = new Rooms();
                $room->title = $title;
                $room->c_text = $text;
                $room->r_admin = $user;
                $room->type = $type;
                $room->category = $category;

                $room->mention = $mention;
                $room->challenge_coins = $coins;
                $room->challenge_date = $challengeTime;
                $room->mention2 = $mention2;
                $room->mention3 = $mention3;
                $room->game = $gameId;
                $room->creation_date = date("Y-m-d H:i:s");
                if ($category == "challenge") {
                    $creatorUser = Users::findOne(["id" => $user]);
                    if ($creatorUser) {
                        if ($creatorUser->coins >= $coins) {
                            
                        } else {
                            return ['success' => true, 'message' => 'nocoins'];
                        }
                    } else {
                        return ['success' => true, 'message' => 'nouser'];
                    }
                }
                if ($type == "text" || $category == "challenge") {
                    $color1 = $_POST["color1"];
                    $color2 = $_POST["color2"];
                    $room->color1 = $color1;
                    $room->color2 = $color2;
                    if ($color1 == null || $color2 == null || $color1 == "" || $color2 == "") {
                        $color1 = "#CE2E6F";
                        $color2 = "#671738";
                    }

                    if ($room->save()) {
                        if ($category == "challenge") {
                            $userTransaction = new UserTransactions();
                            $userTransaction->fromUser = $user;
                            $userTransaction->coins = $coins;
                            $userTransaction->type = "challenge";
                            $userTransaction->roomId = $room->id;
                            $userTransaction->save();
                            $creatorUser->coins = $creatorUser->coins - $coins;
                            $creatorUser->save();
                            NotificationForm::notifyStreamersForChallenge($room);
                        }
                        return ['success' => true, 'message' => ''];
                    } else {
                        return ['success' => false, 'data' => $room->getErrors()];
                    }
                } else if ($type == "video") {
                    $file_name = $_FILES['myFile']['name'];
                    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
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
                            } else {
                                return ['success' => false, 'data' => $postFiles->getErrors()];
                            }
                            return ['success' => true, 'message' => ''];
//                    return "good post only saved";
                        } else {
                            return $room->getErrors();
                        }
                    } else {
                        return "not upload";
                    }
                } else if ($type == "pictures") {
                    $color1 = $_POST["color1"];
                    $color2 = $_POST["color2"];
                    $imagesSize = $_POST["imagesSize"];
                    $location = "postPictures/";
                    if ($room->save()) {
                        for ($i = 0; $i < $imagesSize; $i++) {
                            $image = $_POST["image" . ($i + 1)];
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
                        return ['success' => false, 'data' => $room->getErrors()];
                    }
                    return ['success' => true, 'message' => ''];
                } else {
                    if ($room->save()) {
                        return ['success' => true, 'message' => ''];
                    } else {
                        return ['success' => false, 'data' => $room->getErrors()];
                    }
                }
            }
            return ['success' => false, 'message' => 'missing params'];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
    }

    public function actionGetChallengesVideos() {
        $post = Yii::$app->request->post();
        $postId = $post["postId"];
        $mention1 = $post["mention1"];
        $mention2 = $post["mention2"];
        $mention3 = $post["mention3"];

        return MobileController::getChallengesVideosMentioned($postId, $mention1, $mention2, $mention3);
    }

    public static function getChallengesVideosMentioned($postId, $mention1, $mention2, $mention3) {
        $mentions = [];

        $isMention1 = "0";
        $isChallenge1 = "0";
        $challenge1 = null;
        $user1 = null;
        $votes = 0;
        if ($mention1 && $mention1 != null && $mention1 != "") {
            $isMention1 = "1";
            $user1 = Users::find()
                    ->select(["id", "fullname"])
                    ->where(["id" => $mention1])
                    ->asArray()
                    ->one();
            $challenge1 = ChallengesVideos::findOne([
                        "streamer_id" => $mention1,
                        "post_id" => $postId
            ]);
            if ($challenge1) {
                $isChallenge1 = "1";
            }
            $votes = ChallengeVoting::find()
                    ->where([
                        "post_id" => $postId,
                        "r_streamer_voted" => $mention1
                    ])
                    ->count();
        }
        array_push($mentions, [
            "isMention" => $isMention1,
            "mention" => $user1,
            "isChallenge" => $isChallenge1,
            "challenge" => $challenge1,
            "votes" => $votes
        ]);

        $isMention2 = "0";
        $user2 = null;
        $isChallenge2 = "0";
        $challenge2 = null;
        $votes = 0;
        if ($mention2 && $mention2 != null && $mention2 != "") {
            $isMention2 = "1";
            $user2 = Users::find()
                    ->select(["id", "fullname"])
                    ->where(["id" => $mention2])
                    ->asArray()
                    ->one();
            $challenge2 = ChallengesVideos::findOne([
                        "streamer_id" => $mention2,
                        "post_id" => $postId
            ]);
            if ($challenge2) {
                $isChallenge2 = "1";
            }
            $votes = ChallengeVoting::find()
                    ->where([
                        "post_id" => $postId,
                        "r_streamer_voted" => $mention2
                    ])
                    ->count();
        }
        array_push($mentions, [
            "isMention" => $isMention2,
            "mention" => $user2,
            "isChallenge" => $isChallenge2,
            "challenge" => $challenge2,
            "votes" => $votes
        ]);

        $isMention3 = "0";
        $user3 = null;
        $isChallenge3 = "0";
        $challenge3 = null;
        $votes = 0;
        if ($mention3 && $mention3 != null && $mention3 != "") {
            $isMention3 = "1";
            $user3 = Users::find()
                    ->select(["id", "fullname"])
                    ->where(["id" => $mention3])
                    ->asArray()
                    ->one();
            $challenge3 = ChallengesVideos::findOne([
                        "streamer_id" => $mention3,
                        "post_id" => $postId
            ]);
            if ($challenge3) {
                $isChallenge3 = "1";
            }
            $votes = ChallengeVoting::find()
                    ->where([
                        "post_id" => $postId,
                        "r_streamer_voted" => $mention3
                    ])
                    ->count();
        }
        array_push($mentions, [
            "isMention" => $isMention3,
            "mention" => $user3,
            "isChallenge" => $isChallenge3,
            "challenge" => $challenge3,
            "votes" => $votes
        ]);

        return $mentions;
    }

    public function actionAddChallengeVideo() {

        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            if (isset($_POST['postId']) && isset($_POST['streamerId']) && isset($_POST['imageString'])) {
                $postId = $_POST["postId"];
                $streamerId = $_POST["streamerId"];
                $imageString = $_POST["imageString"];

                $file_name = $_FILES['myFile']['name'];
                $ext = pathinfo($file_name, PATHINFO_EXTENSION);
//            $file_size = $_FILES['myFile']['size'];
//            $file_type = $_FILES['myFile']['type'];
                $temp_name = $_FILES['myFile']['tmp_name'];
                $randomFileName = Yii::$app->security->generateRandomString() . "." . $ext;
                $location = "postChallengesFiles/";
                $isPost = Rooms::findOne(["id" => $postId]);
                $isStreamer = Users::findOne(["id" => $streamerId]);
                if ($isPost) {
                    if ($isStreamer) {
                        if (move_uploaded_file($temp_name, $location . $randomFileName)) {
                            $challenge = new ChallengesVideos();
                            $challenge->post_id = $postId;
                            $challenge->streamer_id = $streamerId;
                            $challenge->file_name = $randomFileName;
                            if ($challenge->save()) {
//for image
                                $location = "postChallengesFiles/";
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
                                $challenge = ChallengesVideos::findOne(["id" => $challenge->primaryKey]);
                                $challenge->thumbnail = $imageName;
                                if ($challenge->save()) {
                                    return "true";
                                } else {
                                    return $challenge->getErrors();
                                }
                                return "true";
                            } else {
                                return $challenge->getErrors();
                            }
                        } else {
                            return "Video not saved";
                        }
                    } else {
                        return "streamer does not exist";
                    }
                }
                return "post does not exist";
            }
            return 'missing params';
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
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
        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            if (isset($_POST['userId'])) {
                $userId = $_POST["userId"];
                $sql = "SELECT rooms.*, users.profile_picture,users.fullname,followrooms.r_room as room_id_liked,
            (SELECT COUNT(id) FROM followrooms WHERE r_room = rooms.id) as number_of_likes,
            (SELECT COUNT(id) FROM comment WHERE r_room = rooms.id) as number_of_comments,
            (SELECT c_text FROM comment WHERE r_room = rooms.id ORDER BY id DESC LIMIT 1) as last_comment, type,
            (SELECT GROUP_CONCAT(file_name SEPARATOR ',') FROM post_files WHERE post_id = rooms.id) as files
             FROM rooms
             JOIN users ON rooms.r_admin = users.id
             LEFT JOIN followrooms ON followrooms.r_room = rooms.id AND followrooms.r_user = $userId
             ORDER BY rooms.creation_date DESC;";
                $command = Yii::$app->db->createCommand($sql);
                $arrayList = $command->queryAll();
                for ($i = 0; $i < sizeof($arrayList); $i++) {
                    $item = $arrayList[$i];
                    if ($item["category"] == "challenge") {
                        if ($item["accept1"] == 0 && $item["accept2"] == 0 && $item["accept3"] == 0) {
                            array_splice($arrayList, $i, 1);
                        } else {
                            $challengeVideos = MobileController::getChallengesVideosMentioned($item["id"], $item["mention"], $item["mention2"], $item["mention3"]);
                            $arrayList[$i]["challengesVideos"] = $challengeVideos;
                            if ($challengeVideos[0]["isChallenge"] == "0" && $challengeVideos[1]["isChallenge"] == "0" && $challengeVideos[2]["isChallenge"] == "0") {
                                array_splice($arrayList, $i, 1);
                            }
                        }
                    } else if ($item["category"] == "donate") {
                        $donations = "SELECT  SUM(user_transactions.coins) AS value_sum FROM user_transactions WHERE roomId =" . $item["id"];
                        $command1 = Yii::$app->db->createCommand($donations);
                        $itemDonate = $command1->queryOne();
                        $arrayList[$i]["number_of_donates"] = $itemDonate["value_sum"];
                    } else {
                        $arrayList[$i]["challengesVideos"] = null;
                    }
                }
                return ['success' => true, 'dataJsonArray' => $arrayList];
            }
            return ['success' => false, 'message' => 'missing params'];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
    }

//     public function actionGetProUsersPosts() {
//
//        \Yii::$app->response->format = Response::FORMAT_JSON;
//
//        $post = Yii::$app->request->post();
//        $userId = $post["userId"];
//
////        $posts = (new Query)
////                ->select('pro_user_posts.*,users.fullname,users.profile_picture')
////                ->from("pro_user_posts")
////                ->join('join', 'users', 'users.id = pro_user_posts.user_id')
//////                ->where(['>=', 'creation_date', new Expression('UNIX_TIMESTAMP(NOW() - INTERVAL 1 DAY)')])
////                ->where('creation_date >= now() - INTERVAL 1 DAY')
////                ->groupBy('pro_user_posts.user_id')
////                    ->orderBy('creation_date DESC')
////                ->all();
////        return $posts;
//
//        $posts = (new Query)
//                ->select("pro_user_posts.*,users.fullname,users.profile_picture,
//                    COUNT(pro_user_posts.id) as count,
//                    (SELECT COUNT(pro_user_posts_views.id) as count
//                          FROM pro_user_posts_views
//                          JOIN pro_user_posts pup ON pup.id = pro_user_posts_views.pro_post_id
//                          WHERE pro_user_posts_views.user_id = $userId AND pro_user_posts_views.creation_date >= now() - INTERVAL 1 DAY AND pup.user_id = pro_user_posts.user_id
//                          ORDER BY pro_user_posts_views.creation_date DESC
//                          ) as viewed_count")
//                ->from("pro_user_posts")
//                ->join('join', 'users', 'users.id = pro_user_posts.user_id')
////                ->where(['>=', 'creation_date', new Expression('UNIX_TIMESTAMP(NOW() - INTERVAL 1 DAY)')])
//                ->where('creation_date >= now() - INTERVAL 1 DAY')
//                ->groupBy('pro_user_posts.user_id')
//                ->orderBy('creation_date DESC')
//                ->all();
//
//        return $posts;
//
//        $temp_array1 = [];
//        $temp_array2 = [];
//        for ($i = 0; $i < sizeof($posts); $i++) {
//            $post = $posts[$i];
//            if ($post["count"] > $post["viewed_count"]) {
//                array_push($temp_array1, $post);
//            } else {
//                array_push($temp_array2, $post);
//            }
//        }
//        for ($j = 0; $j < sizeof($temp_array2); $j++) {
//            array_push($temp_array1, $temp_array2[$j]);
//        }
//
//        return $temp_array1;
////        return json_decode(json_encode($temp_array1), FALSE);
//        return $posts;

    public function actionGetFollowedStreamers() {
        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            if (isset($_POST['userId'])) {
                $userId = $_POST["userId"];
                $streamers = Users::find()
                        ->leftJoin('follow', 'users.id = follow.r_page')
                        ->where(['follow.r_user' => $userId])
                        ->all();
                return ['success' => true, 'dataJsonArray' => $streamers];
            }
            return ['success' => false, 'message' => 'missing params'];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
    }

    public function actionGetRoomsByUser() {
        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            if (isset($_POST['userId'])) {
                $userId = $_POST["userId"];
                $sql = "SELECT rooms.*, users.profile_picture,users.fullname,followrooms.r_room as room_id_liked,
            (SELECT COUNT(id) FROM followrooms WHERE r_room = rooms.id) as number_of_likes,type,
            (SELECT GROUP_CONCAT(file_name SEPARATOR ',') FROM post_files WHERE post_id = rooms.id) as files,
            (SELECT COUNT(id) FROM comment WHERE r_room = rooms.id) as number_of_comments,
            (SELECT c_text FROM comment WHERE r_room = rooms.id ORDER BY id DESC LIMIT 1) as last_comment
             FROM rooms
             JOIN users ON rooms.r_admin = users.id
             LEFT JOIN followrooms ON followrooms.r_room = rooms.id AND followrooms.r_user = $userId
             WHERE  rooms.r_admin = $userId AND rooms.category != 'challenge'   ORDER BY rooms.creation_date DESC ;";

                $command = Yii::$app->db->createCommand($sql);
                $arrayList = $command->queryAll();

                return ['success' => true, 'dataJsonArray' => $arrayList];
            }
            return ['success' => false, 'message' => 'missing params'];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
    }

    public function actionGetPostsBySearch() {


        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            if (isset($_POST['userId']) && isset($_POST["searchText"])) {
                $userId = $_POST["userId"];
                $searchText = $_POST["searchText"];
                $searchText = "'%" . $searchText . "%'";

                $sql = "SELECT rooms.*, users.profile_picture,users.fullname,followrooms.r_room as room_id_liked,
            (SELECT COUNT(id) FROM followrooms WHERE r_room = rooms.id) as number_of_likes,type,
            (SELECT GROUP_CONCAT(file_name SEPARATOR ',') FROM post_files WHERE post_id = rooms.id) as files,
            (SELECT COUNT(id) FROM comment WHERE r_room = rooms.id) as number_of_comments,
            (SELECT c_text FROM comment WHERE r_room = rooms.id ORDER BY id DESC LIMIT 1) as last_comment
             FROM rooms
             JOIN users ON rooms.r_admin = users.id
             LEFT JOIN followrooms ON followrooms.r_room = rooms.id AND followrooms.r_user = $userId
             WHERE  rooms.c_text like $searchText OR rooms.title like $searchText Or users.fullname like $searchText;";

                $command = Yii::$app->db->createCommand($sql);
                $arrayList = $command->queryAll();

                return ['success' => true, 'dataJsonArray' => $arrayList];
            }
            return ['success' => false, 'message' => 'missing params'];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
    }

    public function actionGetUsersBySearch() {
        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            if (isset($_POST['userId']) && isset($_POST["searchText"])) {
                $userId = $_POST["userId"];
                $searchText = $_POST["searchText"];
                $searchText = "'%" . $searchText . "%'";
                $sql = "
             SELECT   users.*,
       (SELECT COUNT(*) FROM follow
        WHERE users.id = follow.r_page) AS followers,follow.r_page as followed
FROM users
 LEFT JOIN follow ON follow.r_page = users.id AND follow.r_user = $userId
   WHERE  LOWER(users.fullname) like LOWER($searchText) ;";

                $command = Yii::$app->db->createCommand($sql);
                $arrayList = $command->queryAll();

                return ['success' => true, 'dataJsonArray' => $arrayList];
            }
            return ['success' => false, 'message' => 'missing params'];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
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

        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            if (isset($_POST['userId'])) {
                $userId = $_POST["userId"];
                $sql = "SELECT rooms.*, users.profile_picture,users.fullname,followrooms.r_room as room_id_liked,
            (SELECT COUNT(id) FROM followrooms WHERE r_room = rooms.id) as number_of_likes,type,
            (SELECT GROUP_CONCAT(file_name SEPARATOR ',') FROM post_files WHERE post_id = rooms.id) as files,
               (SELECT COUNT(id) FROM comment WHERE r_room = rooms.id) as number_of_comments,
            (SELECT c_text FROM comment WHERE r_room = rooms.id ORDER BY id DESC LIMIT 1) as last_comment
             FROM rooms
             JOIN users ON rooms.r_admin = users.id
               LEFT JOIN followrooms ON followrooms.r_room = rooms.id AND followrooms.r_user = $userId
             WHERE  rooms.mention = $userId OR rooms.r_admin = $userId OR rooms.mention2 = $userId OR rooms.mention3 = $userId AND rooms.category = 'challenge'ORDER BY rooms.creation_date DESC ";

                $command = Yii::$app->db->createCommand($sql);
                $arrayList = $command->queryAll();
                for ($i = 0; $i < sizeof($arrayList); $i++) {
                    $item = $arrayList[$i];
                    if ($item["category"] == "challenge") {
                        if ($item["accept1"] == 0 && $item["accept2"] == 0 && $item["accept3"] == 0) {
//                    array_splice($arrayList, $i, 1);
                            $arrayList[$i]["challengesVideos"] = null;
                        } else {
                            $challengeVideos = MobileController::getChallengesVideosMentioned($item["id"], $item["mention"], $item["mention2"], $item["mention3"]);
                            $arrayList[$i]["challengesVideos"] = $challengeVideos;
                            if ($challengeVideos[0]["isChallenge"] == "0" && $challengeVideos[1]["isChallenge"] == "0" && $challengeVideos[2]["isChallenge"] == "0") {
//                        array_splice($arrayList, $i, 1);
                                $arrayList[$i]["challengesVideos"] = null;
                            }
                        }
                    }
                }
                return ['success' => true, 'dataJsonArray' => $arrayList];
            }
            return ['success' => false, 'message' => 'missing params'];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
    }

    public function actionGetWinnedChallenges() {
        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            if (isset($_POST['userId'])) {
                $userId = $_POST["userId"];
                $sql = "SELECT rooms.*, users.profile_picture,users.fullname,followrooms.r_room as room_id_liked,
            (SELECT COUNT(id) FROM followrooms WHERE r_room = rooms.id) as number_of_likes,type,
            (SELECT GROUP_CONCAT(file_name SEPARATOR ',') FROM post_files WHERE post_id = rooms.id) as files
             FROM rooms
             JOIN users ON rooms.r_admin = users.id
               LEFT JOIN followrooms ON followrooms.r_room = rooms.id AND followrooms.r_user = $userId
             WHERE  rooms.challenge_winner = $userId  AND rooms.category = 'challenge'ORDER BY rooms.creation_date DESC ";

                $command = Yii::$app->db->createCommand($sql);
                $arrayList = $command->queryAll();

                return ['success' => true, 'dataJsonArray' => $arrayList];
            }
            return ['success' => false, 'message' => 'missing params'];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
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

//
//    public function actionUserWinChallenge() {
//        $post = Yii::$app->request->post();
//        $roomId = $post["roomId"];
//        $room = Rooms::find()
//                ->where(['id' => $roomId])
//                ->one();
//        if ($room) {
//            $room->challenge_result = 1;
//            $room->challenge_user_result = 1;
//            if ($room->save()) {
//                return true;
//            }
//        }
//    }

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

//    public function actionStreamerAcceptLoseChallenge() {
//        $post = Yii::$app->request->post();
//        $roomId = $post["roomId"];
//        $room = Rooms::find()
//                ->where(['id' => $roomId])
//                ->one();
//        if ($room) {
//
//            $room->streamer_response = 1;
//            $room->challenge_result = $room->challenge_user_result;
//            if ($room->save()) {
//                return true;
//            }
//        }
//    }
//    public function actionStreamerDeclineLoseChallenge() {
//        $post = Yii::$app->request->post();
//        $roomId = $post["roomId"];
//        $room = Rooms::find()
//                ->where(['id' => $roomId])
//                ->one();
//        if ($room) {
//
//            $room->streamer_response = 0;
//            if ($room->save()) {
//                return true;
//            } else
//                return $room->errors;
//        }
//    }

    public function actionGetProUsersPosts() {
        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            if (isset($_POST['userId'])) {
                $userId = $_POST["userId"];
                $posts = (new Query)
                        ->select("pro_user_posts.*,users.fullname,users.profile_picture,
                    COUNT(pro_user_posts.id) as count,
                    (SELECT COUNT(pro_user_posts_views.id) as count
                          FROM pro_user_posts_views
                          JOIN pro_user_posts  pup ON pup.id = pro_user_posts_views.pro_post_id
                          WHERE pro_user_posts_views.user_id = $userId  AND pup.user_id = pro_user_posts.user_id
                          ORDER BY pro_user_posts_views.creation_date DESC) as viewed_count")
                        ->from("pro_user_posts")
                        ->join('join', 'users', 'users.id = pro_user_posts.user_id')
//                ->where(['>=', 'creation_date', new Expression('UNIX_TIMESTAMP(NOW() - INTERVAL 1 DAY)')])
                        ->where('creation_date >= now() - INTERVAL 1 DAY')
                        ->groupBy('pro_user_posts.user_id')
                        ->orderBy('creation_date DESC')
                        ->all();

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
                return ['success' => true, 'dataJsonArray' => $posts];
            }
            return ['success' => false, 'message' => 'missing params'];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
    }

    public function actionGetProUserPosts() {
        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            if (isset($_POST['userId'])) {
                $userId = $_POST["userId"];
                $posts = ProUserPosts::find()
                        ->where(['user_id' => $userId])
                        ->andWhere('creation_date >= now() - INTERVAL 1 DAY')
                        ->orderBy('creation_date ASC')
                        ->asArray()
                        ->all();
                return ['success' => true, 'dataJsonArray' => $posts];
            }
            return ['success' => false, 'message' => 'missing params'];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
    }

    public function actionGetOneProUserPost() {
        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            if (isset($_POST['proPostId'])) {
                $postId = $_POST["proPostId"];
                $posts = (new Query)
                        ->select("pro_user_posts.*,users.fullname,users.profile_picture")
                        ->from("pro_user_posts")
                        ->join('join', 'users', 'users.id = pro_user_posts.user_id')
                        ->where('creation_date >= now() - INTERVAL 1 DAY')
                        ->andWhere(["pro_user_posts.id" => $postId])
                        ->all();
                return ['success' => true, 'dataJsonArray' => $posts];
            }
            return ['success' => false, 'message' => 'missing params'];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
    }

    public function actionGetProUserPostsForProfile() {
        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            if (isset($_POST['userId'])) {
                $userId = $_POST["userId"];
                $posts = ProUserPosts::find()
                        ->select("pro_user_posts.*,users.fullname,users.profile_picture")
                        ->join('join', 'users', 'users.id = pro_user_posts.user_id')
                        ->where(['user_id' => $userId])
                        ->andWhere('creation_date >= now() - INTERVAL 1 DAY')
                        ->orderBy('creation_date DESC')
                        ->asArray()
                        ->all();
                return ['success' => true, 'dataJsonArray' => $posts];
            }
            return ['success' => false, 'message' => 'missing params'];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
    }

    public function actionCreateProUserPost() {
        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
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
            }
            return "not upload";
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
    }

    public function actionGetOneRoom() {

        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            if (isset($_POST['roomId'])) {
                $roomId = $_POST["roomId"];
                $sql = "SELECT rooms.*, users.profile_picture
        FROM rooms
         JOIN users ON rooms.r_admin = users.id
        WHERE rooms.id = $roomId;";
                $command = Yii::$app->db->createCommand($sql);
                $result = $command->queryOne();

                return ['success' => true, 'data' => $result];
            }
            return ['success' => false, 'message' => 'missing params'];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
    }

    public function actionGetStreamers() {
        $streamers = Users::find()
                ->where(["role" => '1'])
                ->all();
        return $streamers;
    }

    public function actionSignup() {
        $post = Yii::$app->request->post();

//        if(isset($post["fullname"])&&isset($post["password"])&&isset($post["role"])){
//
//        }

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
        $hash = Yii::$app->getSecurity()->generatePasswordHash($password);
        $user->password_hash = $hash;
//        $user->link = $link;
        $user->role = $role;

//        if ($role.contains(1)) {
//            $user->is_approved = 0;
//        } else {
        $user->is_approved = 1;
//        }

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

//    public function actionSignup2() {
//        $post = Yii::$app->request->post();
//        $fullname = $post["fullname"];
//        $url = $post["link"];
//        $password = $post["password"];
//        $username = $post["username"];
//        $pubgId = $post["pubgId"];
//        $user = new Users();
//        $user->username = $username;
//        $user->fullname = $fullname;
//        $user->link = $url;
//        $user->role = 1;
//        $user->pubgid = $pubgId;
//        $user->password = $password;
//
//        if ($user->save()) {
//            return true;
//        } else
//            return false;
//    }

    public function actionLogin() {

        $post = Yii::$app->request->post();
        $model = new LoginForm();

        if (isset($post["username"]) && isset($post["password"]) && isset($post["token"])) {
            $model->username = $post["username"];
            $model->password = $post["password"];
            if ($model->login()) {
                $user = $model->getUser();
                $user->generateAccessToken();
                $user->save();
                return ['success' => true, 'data' => $user];
            }
        }
        return ['success' => false, 'message' => "Incorrect username or password"];
    }

//    public function actionLogin2() {
//        $post = Yii::$app->request->post();
//
//        $password = $post["password"];
//        $username = $post["username"];
//
//        $user = Users::find()
//                ->where(['username' => $username])
//                ->andWhere(['password' => $password])
//                ->one();
//        if ($user)
//            return $user;
//        else
//            return $user->errors;
//    }

    public function actionAddComment() {

        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            if (isset($_POST['userId']) && isset($_POST['postId']) && isset($_POST['text'])) {
                $userId = $_POST["userId"];
                $postId = $_POST["postId"];
                $text = $_POST["text"];

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

// add to table notification


                    $myNotificationModel = new Notificaion();
                    $myNotificationModel->room_id = $postId;
                    $myNotificationModel->sender_id = $userId;
                    $myNotificationModel->reciever_id = $userRoomOwner->id;
                    $myNotificationModel->description = Constants::$COMMENTED_ON_YOUR_POST;
                    $myNotificationModel->save();
                    $commentsUsersIds = [];
                    if ($userRoomOwner->id != $userId) {
                        $commentsUsersIds = Comment::find()
                                ->select("DISTINCT(users.id)")
                                ->where([
                                    "r_room" => $postId,
                                ])
                                ->andWhere("comment.r_user != $userRoomOwner->id")
                                ->join("join", "users", "users.id = comment.r_user")
                                ->asArray()
                                ->column();
                    }

                    for ($i = 0; $i < sizeof($commentsUsersIds); $i++) {
                        if ($userId != $commentsUsersIds[$i]) {
                            $myNotificationModel = new Notificaion();
                            $myNotificationModel->room_id = $postId;
                            $myNotificationModel->sender_id = $userId;
                            $myNotificationModel->reciever_id = $commentsUsersIds[$i];
                            $myNotificationModel->description = Constants::$COMMENTED_ON_A_POST_YOU_COMMENTED_IN;
                            $myNotificationModel->save();
                        }
                    }
/////////////////////////////////////////

                    $notification->notifyToUserGoToAd($commentsUsers, $postId);

                    return ['success' => true];
                }
                return ['success' => false, 'message' => 'failed to add comments'];
            }
            return ['success' => false, 'message' => 'missing params'];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
    }

    public function actionFollow() {
        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            if (isset($_POST['r_room']) && isset($_POST['r_user']) && isset($_POST['token'])) {
                $roomId = $_POST["r_room"];
                $userId = $_POST["r_user"];
                $token = $_POST["token"];
                $follow = new Followrooms();
                $follow->r_room = $roomId;
                $follow->r_user = $userId;
                $follow->user_token = $token;
                if ($follow->save()) {

                    $room = Rooms::findOne(["id" => $roomId]);
                    if ($room) {

                        $myNotificationModel = new Notificaion();
                        $myNotificationModel->room_id = $room["id"];
                        $myNotificationModel->sender_id = $userId;
                        $myNotificationModel->reciever_id = $room["r_admin"];
                        $myNotificationModel->description = Constants::$LIKED_YOUR_POST;
                        $myNotificationModel->save();

                        $user = Users::findOne(["id" => $userId]);

                        $senderName = "";
                        if ($user) {
                            $senderName = $user->fullname;
                        }

                        $notification = new NotificationForm();
                        $notification->subject = $senderName;
                        $notification->message = Constants::$LIKED_YOUR_POST;
                        $notification->notifyToUserGoToAd([$user->token], $room["id"]);
                    }



                    return ['success' => true];
                }
                return ['success' => true, 'data' => $follow->errors];
            }
            return ['success' => false, 'message' => 'missing params'];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
    }

//    public function actionSendNotificationMyUsers() {
//
//        $post = Yii::$app->request->post();
//        $roomId = $post["roomId"];
//        $userId = $post["userId"];
//
//        $tokens = (new Query)
//                ->select("users.token  ")
//                ->from(Follow::tableName())
//                ->where([
//                    "r_page" => $userId
//                ])
//                ->join("join", "users", Follow::tableName() . ".r_user = users.id")
//                ->column();
//
//        $room = Rooms::find()
//                ->where(['id' => $roomId])
//                ->one();
//
//        $pageName = $room["page_name"];
//        $userNotifications = UserNotifications::find()->where(["user_id" => $userId])->one();
//
//        if ($userNotifications) {
//
//            $remainingNotifications = $userNotifications["number_remaining"];
//            if ($remainingNotifications > 0) {
//
//                $notification = new NotificationForm();
//                $notification->subject = "Streamer " . $pageName;
//                $notification->message = "My Stream is Live Now";
//                $notification->notifyToUserGoToAd($tokens, $roomId);
//
//                $userNotifications["number_remaining"] = $userNotifications["number_remaining"] - 1;
//
//                $userNotifications->save();
//
//                return "Notification Sent";
//            } else
//                return "Your Notification Balance is Empty Please recharge";
//        } else
//            return "You don't have Any purchase";
//    }
//
//    public function actionSendNotificationAllUsers() {
//
//        $post = Yii::$app->request->post();
//        $roomId = $post["roomId"];
//        $userId = $post["userId"];
//
//        $room = Rooms::find()
//                ->where(['id' => $roomId])
//                ->one();
//
//        $pageName = $room["page_name"];
//
//        $tokens = (new Query)
//                ->select("token")
//                ->from("users")
//                ->column();
//
//        $userNotifications = UserNotifications::find()->where(["user_id" => $userId])->one();
//
//        if ($userNotifications) {
//
//            $remainingNotifications = $userNotifications["number_remaining_for_all_users"];
//            if ($remainingNotifications > 0) {
//
//                $notification = new NotificationForm();
//                $notification->subject = "Streamer " . $pageName;
//                $notification->message = "My Stream is Live Now";
//                $notification->notifyToUserGoToAd($tokens, $roomId);
//
//                $userNotifications["number_remaining_for_all_users"] = $userNotifications["number_remaining_for_all_users"] - 1;
//                $userNotifications->save();
//
//                return "Notification For All Users Sent";
//            } else
//                return "Your Notification Balance is Empty Please recharge";
//        } else
//            return "You don't have Any purchase";
//
//
//
////        return ["room" => $room, "tokens" => $tokens, "notifications" => $userNotifications];
//    }
//    public function actionCheckIfHaveNotifications() {
//
//        $post = Yii::$app->request->post();
//
//        $userId = $post["userId"];
//
//        $userNotifications = UserNotifications::find()->where(["user_id" => $userId])->one();
//
//        if ($userNotifications) {
//
//            $remainingNotifications = $userNotifications["number_remaining"];
//            if ($remainingNotifications > 0) {
//
//                return true;
//            } else
//                return false;
//        } else
//            return false;
//    }
//
//    public function actionCheckIfHaveNotificationsForAll() {
//        $post = Yii::$app->request->post();
//
//        $userId = $post["userId"];
//
//        $userNotifications = UserNotifications::find()->where(["user_id" => $userId])->one();
//
//        if ($userNotifications) {
//
//            $remainingNotifications = $userNotifications["number_remaining_for_all_users"];
//            if ($remainingNotifications > 0) {
//                return true;
//            } else
//                return false;
//        } else
//            return false;
//    }

    public function actionUnfollow() {
        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            if (isset($_POST['r_user']) && isset($_POST['r_room'])) {
                $roomId = $_POST["r_room"];
                $userId = $_POST["r_user"];
                $unfollow = Followrooms::find()
                        ->where(["r_room" => $roomId])
                        ->andWhere(["r_user" => $userId])
                        ->one();
                if ($unfollow->delete()) {
                    return ['success' => true];
                }
                return ['success' => false];
            }
            return ['success' => false, 'message' => 'missing params'];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
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
        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            if (isset($_POST['postId'])) {
                $postId = $_POST["postId"];
                $commentsByPost = (new Query)
                        ->select(Comment::tableName() . ".*,users.fullname,users.profile_picture")
                        ->from(Comment::tableName())
                        ->where([
                            "r_room" => $postId
                        ])
                        ->join("join", "users", Comment::tableName() . ".r_user = users.id")
                        ->orderBy("creation_date Desc")
                        ->all();
                return ['success' => true, 'dataJsonArray' => $commentsByPost];
            }
            return ['success' => false, 'message' => 'missing params'];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
    }

//    public function actionGetAdminNameAndLink() {
//        $userId = Yii::$app->request->post();
//        $userId = $userId["id"];
//
//        $user = Pageadmin::find()
//                ->where(['id' => $userId])
//                ->one();
//        if ($user)
//            return $user;
//        else
//            return false;
//    }

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
        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            if (isset($_POST["id"]) && isset($_POST["fullname"])) {

                $id = $_POST["id"];
                $fullname = $_POST["fullname"];
                $linkFacebook = isset($_POST["linkFacebook"]) ? $_POST["linkFacebook"] : null;
                $linkYoutube = isset($_POST["linkYoutube"]) ? $_POST["linkYoutube"] : null;
                $linkInstagram = isset($_POST["linkInstagram"]) ? $_POST["linkInstagram"] : null;
                $linkTiktok = isset($_POST["linkTiktok"]) ? $_POST["linkTiktok"] : null;
                $tags = isset($_POST["tags"]) ? $_POST["tags"] : null;
                $bio = isset($_POST["bio"]) ? $_POST["bio"] : null;
                $userGames = isset($post["userGames"]) ? $post["userGames"] : null;
                $userGamesDecode = $userGames != null ? json_decode($userGames) : [];

                $model = Users::findOne(["id" => $id]);
                if ($model) {
                    $model->fullname = $fullname;
                    $model->link_facebook = $linkFacebook;
                    $model->link_youtube = $linkYoutube;
                    $model->link_instagram = $linkInstagram;
                    $model->link_tiktok = $linkTiktok;
                    $model->bio = $bio;
                    $model->tags = $tags;
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
                                            if (!$model->save()) {
                                                return ['success' => false, "message" => "error in updating games"];
                                            }
                                        }
                                    }
                                    return ["success" => "false", "message" => "does not exists"];
                                } else {
                                    if ($userGame->game_account_id != "") {
                                        $model = new StreamerGames();
                                        $model->user_id = $id;
                                        $model->game_id = $userGame->id;
                                        $model->game_account_id = $userGame->game_account_id;
                                        if (!$model->save()) {
                                            return [
                                                "success" => "false", "message" => "error in saving games"];
                                        }
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
                        return ["success" => "true", "message" => "success"];
                    }
                    return ["success" => "false", "message" => "error in saving data", 'data' => $model->errors];
                }

                return ["success" => "false", "message" => "no user exist"];
            }
            return ["success" => "false", "message" => "missing params"];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
    }

    public function actionFollowStreamer() {

        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            if (isset($_POST['r_user']) && isset($_POST["r_page"])) {
                $r_user = $_POST["r_user"];
                $r_page = $_POST["r_page"];
                $follow = new Follow();
                $follow->r_user = $r_user;
                $follow->r_page = $r_page;
                if ($follow->save()) {
                    $myNotificationModel = new Notificaion();
                    $myNotificationModel->sender_id = $r_user;
                    $myNotificationModel->reciever_id = $r_page;
                    $myNotificationModel->description = Constants::$FOLLOWED_YOU;
                    $myNotificationModel->save();
                    $user = Users::findOne(["id" => $r_user]);
                    $senderName = "";
                    if ($user) {
                        $senderName = $user->fullname;
                    }
                    $notification = new NotificationForm();
                    $notification->subject = $senderName;
                    $notification->message = Constants::$FOLLOWED_YOU;
                    $notification->notifyToUserGoToAd([$user->token], 0);
                    return ['success' => true];
                } else {
                    return ['success' => false, 'data' => $follow->errors];
                }
            }
            return ['success' => false, 'message' => 'missing params'];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
    }

//    public function actionSliverSpinReward() {
//
//        $post = Yii::$app->request->post();
//
//        $userId = $post["userId"];
//        $prizeId = $post["prizeId"];
//        $reward = new UsersSpinSilver();
//        $reward->userId = $userId;
//        $reward->prizedId = $prizeId;
//        $reward->date = date("Y-m-d H:i:s");
//
//        if ($reward->save()) {
//            return true;
//        } else {
//            return $reward->errors;
//        }
//    }
//    public function actionCheckSpin() {
//
//        $post = Yii::$app->request->post();
//
//        $userId = $post["userId"];
//        $date = date("Y-m-d H:i:s");
//        $timestamp1 = strtotime($date);
//
//        $reward = (new Query)
//                ->select("*")
//                ->from("users_spin_silver")
//                ->where(['userId' => $userId])
//                ->orderBy("id Desc")
//                ->one();
//        $timestamp2 = strtotime($reward['date']);
//
//        if ((($timestamp1 - $timestamp2) / 3600) > 24) {
//
//            return false;
////            return ["result" => "can",
////                "date" => $reward['date'],
////                "reward" => $reward,
////                "time1" => $timestamp1,
////                "time2" => $timestamp2,
////                "diff" => ($timestamp1 - $timestamp2) / 3600];
//        } else {
//            return true;
////            return ["result" => "can't",
////                "date" => $reward['date'],
////                "reward" => $reward,
////                "time1" => $timestamp1,
////                "time2" => $timestamp2,
////                "diff" => ($timestamp1 - $timestamp2) / 3600];
//        }
//    }

    public function actionUnfollowStreamer() {
        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            if (isset($_POST['r_user']) && isset($_POST['r_page'])) {
                $r_user = $_POST["r_user"];
                $r_page = $_POST["r_page"];
                $follow = Follow::find()
                        ->where(['r_user' => $r_user])
                        ->andWhere(['r_page' => $r_page])
                        ->one();

                if ($follow->delete()) {
                    return ['success' => true];
                }
                return ['success' => false, 'data' => $follow->errors];
            }
            return ['success' => false, 'message' => 'missing params'];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
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

        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            if (isset($_POST['userId']) && isset($_POST['image'])) {
                $userId = $_POST["userId"];
                $image = $post["image"];
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
                            return['success' => true, 'message' => $imageName];
                        }
                        return ['success' => false, "message" => "error in uploading image"];
                    }
                }
                return ['success' => false, "message" => "no user found"];
            }
            return ['success' => false, 'message' => 'missing params'];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
    }

    public function actionGetProfileData() {
        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            if (isset($_POST['userId'])) {
                $userId = $_POST["userId"];
                $userProfile = Users::find()
                        ->select("username,fullname,role,link_facebook,link_youtube,link_instagram,link_tiktok,profile_picture,tags,bio")
                        ->where(['id' => $userId])
                        ->asArray()
                        ->one();

                $games = (new Query)
                        ->select("games.id,games.name,streamer_games.user_id,streamer_games.game_id,streamer_games.game_account_id,streamer_games.id as streamerGameId")
                        ->from("games")
                        ->leftJoin("streamer_games", "games.id = streamer_games.game_id AND streamer_games.user_id = '" . $userId . "'")
                        ->all();

                $userProfile["userGame"] = $games;
                return ['success' => true, 'data' => $userProfile];
            }
            return ['success' => false, 'message' => 'missing params'];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
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
        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            if (isset($_POST["userId"]) && isset($_POST["visitorId"])) {
                $userId = $_POST["userId"];
                $visitorId = $_POST["visitorId"];

                $userProfile = Users::find()
                        ->select("username,fullname,role,link_facebook,link_youtube,link_instagram,link_tiktok,profile_picture,address,email,phone,gender,coins,tags,bio")
                        ->where(['id' => $userId])
                        ->asArray()
                        ->one();

                $games = (new Query)
                        ->select("games.id,games.name,streamer_games.user_id,streamer_games.game_id,streamer_games.game_account_id,streamer_games.id as streamerGameId")
                        ->from("games")
                        ->leftJoin("streamer_games", "games.id = streamer_games.game_id AND streamer_games.user_id = '" . $userId . "'")
                        ->all();

                $userProfile["userGame"] = $games;
//
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

                return ['success' => true, 'data' => $userProfile];
            }
            return ['success' => false, 'message' => 'missing params'];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
    }

    public function actionGetGames() {
//        $request = Yii::$app->request;
//        if ($request->get('access-token') != '--') {
        $games = (new Query)
                ->select("*")
                ->from("games")
                ->all();
        return $games;
//        return ['success' => true, 'dataJsonArray' => $games];
//        }
//        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
    }

    public function actionHandlePurchase() {

        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            if (isset($_POST['userId']) && isset($_POST['productId']) && isset($_POST['orderId']) && isset($_POST['packageName']) && isset($_POST['purchaseTime']) && isset($_POST['purchaseState']) && isset($_POST['purchaseToken']) && isset($_POST['quantity']) && isset($_POST['acknowledged'])) {
                $userId = $_POST["userId"];
                $productId = $_POST["productId"];
                $orderId = $_POST["orderId"];
                $packageName = $_POST["packageName"];
                $purchaseTime = $_POST["purchaseTime"];
                $purchaseState = $_POST["purchaseState"];
                $purchaseToken = $_POST["purchaseToken"];
                $quantity = $_POST["quantity"];
                $acknowledged = $_POST["acknowledged"];

                if ($productId == "remove_ads" || $productId == "elite" || $productId == "pro_user") {
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
                        return ["status" => "2", "message" => "Success"];
                    }
                    return ["status" => "0", "message" => "error in saving purchase",];
                } else {

                    $coinsToAdd = 0;
                    if ($productId == "tlc_1200") {
                        $coinsToAdd = 1200;
                    } else if ($productId == "tlc_145") {
                        $coinsToAdd = 145;
                    } else if ($productId == "tlc_3000") {
                        $coinsToAdd = 3000;
                    } else if ($productId == "tlc_310") {
                        $coinsToAdd = 310;
                    } else if ($productId == "tlc_45") {
                        $coinsToAdd = 45;
                    } else if ($productId == "tlc_530") {
                        $coinsToAdd = 530;
                    } else if ($productId == "tlc_6400") {
                        $coinsToAdd = 6400;
                    } else {
                        return ["status" => "0", "message" => "error in adding coins",];
                    }

                    $userModel = Users::findOne(["id" => $userId]);
                    $oldCoins = $userModel->coins;
                    $userModel->coins = $oldCoins + $coinsToAdd;
                    if ($userModel->save()) {
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
                        return ["status" => "1", "message" => "Success",];
                    }
                    return ["status" => "0", "message" => "error in adding coins",];

//            $addNotificationsRemaining = 0;
//            $addNotificationsToAllUsersRemaining = 0;
//            if ($productId == "30_notifications") {
//                $addNotificationsRemaining = 30;
//            } else if ($productId == "60_notifications") {
//                $addNotificationsRemaining = 60;
//            } else if ($productId == "90_notifications_3_toall") {
//                $addNotificationsRemaining = 90;
//                $addNotificationsToAllUsersRemaining = 3;
//            } else if ($productId == "120_notifications_10_toall") {
//                $addNotificationsRemaining = 120;
//                $addNotificationsToAllUsersRemaining = 10;
//            }
////        else if ($productId == "") {
////            $addNotificationsRemaining = ;
////        }
//
//            $userNotifications = UserNotifications::findOne(["user_id" => $userId]);
//            if ($userNotifications) {
//                $userNotifications->number_remaining = $userNotifications->number_remaining + $addNotificationsRemaining;
//                $userNotifications->number_remaining_for_all_users = $userNotifications->number_remaining_for_all_users + $addNotificationsToAllUsersRemaining;
//            } else {
//                $userNotifications = new UserNotifications();
//                $userNotifications->user_id = $userId;
//                $userNotifications->number_remaining = $addNotificationsRemaining;
//                $userNotifications->number_remaining_for_all_users = $addNotificationsToAllUsersRemaining;
//            }
//            if ($userNotifications->save()) {
//                $userPurchace = new UserPurchaseDetails();
//                $userPurchace->user_id = $userId;
//                $userPurchace->orderId = $orderId;
//                $userPurchace->packageName = $packageName;
//                $userPurchace->productId = $productId;
//                $userPurchace->purchaseTime = $purchaseTime;
//                $userPurchace->purchaseState = $purchaseState;
//                $userPurchace->purchaseToken = $purchaseToken;
//                $userPurchace->quantity = $quantity;
//                $userPurchace->acknowledged = $acknowledged;
//                if ($userPurchace->save()) {
//
//                }
//                return [
//                    "status" => "1",
//                    "message" => "Success",
//                ];
//            } else {
//
//                return [
//                    "status" => "0",
//                    "message" => "error in saving notifications",
//                ];
//            }
                }
            }
            return ['status' => '0', 'message' => 'missing params'];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
    }

    public function actionChangePassword() {

//        $request = Yii::$app->request;
//        if ($request->get('access-token') != '--') {
        if (isset($_POST['username']) && isset($_POST["password"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $user = Users::findOne(["username" => $username]);
            if ($user) {
                $user->password = $password;
                if ($user->save()) {
                    return ["success" => true, "message" => "Success",];
                }
                return ["success" => false, "message" => "something went wrong when saving",];
            }
            return ["success" => false, "message" => "user does not exist",];
        }
        return ['success' => false, 'message' => 'missing params'];
//        }
//        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
    }

//    public function actionTestUploadVideo() {
//        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//            $title = $_POST[""];
//            $file_name = $_FILES['myFile']['name'];
//            $ext = pathinfo($file_name, PATHINFO_EXTENSION);
////            $file_size = $_FILES['myFile']['size'];
////            $file_type = $_FILES['myFile']['type'];
//            $temp_name = $_FILES['myFile']['tmp_name'];
//
//            $randomFileName = Yii::$app->security->generateRandomString() . "." . $ext;
//            $location = "postVideos/";
//
//            move_uploaded_file($temp_name, $location . $randomFileName);
//
//            return "https://" . Yii::$app->params['domain'] . "/postVideos/" . $randomFileName;
//        } else {
//            return "Error";
//        }
//    }

    public function actionProPostViewed() {


        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            if (isset($_POST['userId']) && isset($_POST['proPostId'])) {
                $userId = $_POST["userId"];
                $proPostId = $post["proPostId"];
                $model = new ProUserPostsViews();
                $model->user_id = $userId;
                $model->pro_post_id = $proPostId;
                if ($model->save()) {
                    return ["success" => "true", "message" => "saved"];
                }
                return ["success" => "true", "message" => "already Saved"];
            }
            return ['success' => false, 'message' => 'missing params'];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
    }

    public function actionVoteForStreamer() {

        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            if (isset($_POST['postId']) && isset($_POST['streamerId']) && isset($_POST['voterId'])) {
                $postId = $_POST["postId"];
                $streamerId = $_POST["streamerId"];
                $voterId = $_POST["voterId"];
                $room = Rooms::findOne(["id" => $postId]);
                if ($room) {
                    $deadline = $room["challenge_date"];
                    $result = time() - strtotime($deadline);
                    if (!$deadline || $result > 0) {
                        return ['success' => true, 'message' => 'voting period is finished', 'data' => ''];
                    } else {
                        $voteTable = ChallengeVoting::findOne([
                                    "post_id" => $postId,
                                    "r_user" => $voterId
                        ]);
                        if ($voteTable) {
                            return ['success' => true, 'message' => 'you already voted', 'data' => ''];
                        } else {
                            $vote = new ChallengeVoting();
                            $vote->r_user = $voterId;
                            $vote->post_id = $postId;
                            $vote->r_streamer_voted = $streamerId;
                            if ($vote->save()) {

                                $user = Users::findOne(["id" => $voterId]);

                                $senderName = "";
                                if ($user) {
                                    $senderName = $user->fullname;
                                }

                                $myNotificationModel = new Notificaion();
                                $myNotificationModel->room_id = $postId;
                                $myNotificationModel->sender_id = $voterId;
                                $myNotificationModel->reciever_id = $streamerId;
                                $myNotificationModel->description = Constants::$VOTED_FOR_YOU;
                                $myNotificationModel->save();

                                $notification = new NotificationForm();
                                $notification->subject = $senderName;
                                $notification->message = Constants::$VOTED_FOR_YOU;
                                $notification->notifyToUserGoToAd([$user->token], $postId);
                                return ['success' => true, 'message' => 'successfully voted', 'data' => ''];
                            }
                            return ['success' => false, 'message' => 'something went worng', 'data' => ''];
                        }
                    }
                }
                return ['success' => false, 'message' => 'post does not exist'];
            }
            return ['success' => false, 'message' => 'missing params'];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
    }

    public function actionAcceptInvitationToChallenge() {
        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            if (isset($_POST['postId']) && isset($_POST["streamerId"])) {
                $postId = $_POST["postId"];
                $streamerId = $_POST["streamerId"];
                $room = Rooms::findOne(["id" => $postId]);
                if ($room) {
                    if ($room["mention"] == $streamerId) {
                        $room->accept1 = 1;
                    } else if ($room["mention2"] == $streamerId) {
                        $room->accept2 = 1;
                    } else if ($room["mention3"] == $streamerId) {
                        $room->accept3 = 1;
                    } else {
                        return ['success' => false, 'message' => 'streamer is not mentioned', 'data' => ''];
                    }
                    if ($room->save()) {
                        $myNotificationModel = new Notificaion();
                        $myNotificationModel->room_id = $room["id"];
                        $myNotificationModel->sender_id = $streamerId;
                        $myNotificationModel->reciever_id = $room["r_admin"];
                        $myNotificationModel->description = Constants::$ACCEPTED_YOUR_CHALLENGE;
                        $myNotificationModel->save();
                        return ['success' => true, 'message' => 'challenge accepted', 'data' => ''];
                    }
                    return ['success' => false, 'message' => 'error accepting invitation', 'data' => ''];
                }
                return ['success' => false, 'message' => 'post does not exist', 'data' => ''];
            }
            return ['success' => false, 'message' => 'missing params'];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
    }

    public function actionUpdateToken() {
        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            if (isset($_POST['userId']) && isset($_POST['token'])) {
                $userId = $_POST["userId"];
                $token = $_POST["token"];
                $user = Users::findOne(["id" => $userId]);
                if ($user) {
                    $user->token = $token;
                    if ($user->save()) {
                        return ['success' => true, 'message' => 'success'];
                    } else {
                        return ['success' => false, 'message' => $user->getErrors()];
                    }
                }
                return ['success' => false, 'message' => 'user not exist'];
            }
            return ['success' => false, 'message' => 'missing params'];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
    }

//    public function actionSs() {
//
//        $notification = new NotificationForm();
//        $notification->subject = "subject sad asd ";
//        $notification->message = "aaaa";
//
//        $commentsUsers = Users::find()
//                ->select("DISTINCT(users.token)")
//                ->where([
//                    "id" => 20,
//                ])
//                ->asArray()
//                ->column();
//
//
//
//        $notification->notifyToUserGoToAd($commentsUsers, "369");
//
////        $msg = array
////            (
////            'title' => "some subject",
////            'body' => "some body",
////            "userId" => 1,
////            "challengeId" => 1,
////        );
////        $fields = array
////            (
//////            'registration_ids' => ["eWG5U4bYST60ryg-NYIfFN:APA91bG9jlSW84MVGvO3Xz4tHC6xpto1Szgtz_bfkLLsyLPHqzWtk_lkjjbFyzCVPlhKLf_Bu4x4u5C7Nc1FAnI3fR_fAaSrV-_XaALDvkfsb9ZIq3eNZuTlp9Hx1-CcKgD5aihc6d7z"],
//////            'registration_ids' => ["dGu5pLuDSDaTLcmLqzL27r:APA91bFn1g7i2fUwICs8mIwqxwzmJUsor9DhrF5IUKS-ElCzpG7oB-LEXfLCOerDx9fWdgtxh9wNWq47TQmxR50s4v7X5cn6JHYICGnee1CRwVCUpzCl3_D1Ct5kPiMGoM2anJ6H9WC1"],
////            'registration_ids' => ["e61sbzugSSGhRTuxwJNy3I:APA91bGOPahE89Smy-sDObv64N5kFn9NsqianHWrKsVXJSe1kB7oXixdCiGFvQw1vYeF60iFGqGWRqu8pQ5ITvpIklEqlFX4ba8eh-wfkSq03zdnHinve44QNbLV4sNJ6D8FijaPhkBV"],
////            'data' => $msg
////        );
////
////        $headers = array
////            (
////            'Authorization: key = AAAAOSRyA4w:APA91bGpPImQQPQTgvZQdL8qe7QbF1khXBJxe1QO8TiuC6brGSoDEDVuuObrJqqpGHFWL4bC9378DbBWWOuN-HJ4T8McJQBauctM58-lfcPB5iA9l8NgebBi7Vm4BLemyFoRGBHNQUub',
////            'Content-Type: application/json'
////        );
////        $ch = curl_init();
////        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
////        curl_setopt($ch, CURLOPT_POST, true);
////        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
////        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
////        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
////        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
////        $result = curl_exec($ch);
////        curl_close($ch);
////        return true;
//    }

    public function actionGetNotificationsByUser() {
        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            if (isset($_POST['userId'])) {
                $userId = $_POST["userId"];
                $notifications = Notificaion::find()
                        ->select(["notificaion.*", "senderUser.fullname as senderFullname", "senderUser.profile_picture as senderProfilePicture"])
//                ->join('join', 'users as recieverUser', 'recieverUser.id = notificaion.reciever_id')
                        ->join('join', 'users as senderUser', 'senderUser.id = notificaion.sender_id')
                        ->where(['reciever_id' => $userId])
                        ->orderBy("id DESC")
                        ->asArray()
                        ->all();
                Notificaion::updateAll(["is_read" => 1], [
                    "reciever_id" => $userId
                ]);
                return ['success' => true, 'dataJsonArray' => $notifications];
            }
            return ['success' => false, 'message' => 'missing params'];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
    }

    public function actionGetUnreadNotificationNumber() {
        $request = Yii::$app->request;
        if ($request->get('access-token') != '--') {
            $post = Yii::$app->request->post();

            $userId = $post["userId"];
            $count = Notificaion::find()
                    ->where(['reciever_id' => $userId, 'is_read' => 0])
                    ->asArray()
                    ->count();
            return ['success' => true, 'message' => $count];
        }
        throw new UnauthorizedHttpException("Your request was made with invalid credentials.");
    }

//    public function actionMakeNotificationsRead() {
//
//        $post = Yii::$app->request->post();
//
//        $userId = $post["userId"];
//        Notificaion::updateAll(["is_read" => 1], [
//            "reciever_id" => $userId
//        ]);
//        return [
//            "status" => "1",
//            "message" => "marked as unread"
//        ];
//    }

    public function actionMakeUserActive() {
        $post = Yii::$app->request->post();
        $id = $post["id"];

        $user = Users::findOne(["id" => $id]);
        if ($user) {
            $user->status = 10;
            if ($user->save()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function actionMakeUserInactive() {
        $post = Yii::$app->request->post();
        $id = $post["id"];

        $user = Users::findOne(["id" => $id]);
        if ($user) {
            $user->status = 0;
            if ($user->save()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function actionMakePostActive() {
        $post = Yii::$app->request->post();
        $id = $post["id"];

        $user = Rooms::findOne(["id" => $id]);
        if ($user) {
            $user->active = 1;
            if ($user->save()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function actionMakePostInactive() {
        $post = Yii::$app->request->post();
        $id = $post["id"];

        $user = Rooms::findOne(["id" => $id]);
        if ($user) {
            $user->active = 0;
            if ($user->save()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
