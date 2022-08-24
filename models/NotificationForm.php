<?php

namespace app\models;

use paragraph1\phpFCM\Recipient\Device;
use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;

/**
 * ContactForm is the model behind the contact form.
 */
class NotificationForm extends Model {

    public $subject;
    public $message;

//    public $token;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            [['subject', 'message'], 'required'], //token
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels() {
        return [
            'subject' => 'Subject',
            'message' => 'Message',
//            'token' => 'Device Tocken'
        ];
    }

    public function notify() {

        define('API_ACCESS_KEY', 'AAAAOSRyA4w:APA91bGpPImQQPQTgvZQdL8qe7QbF1khXBJxe1QO8TiuC6brGSoDEDVuuObrJqqpGHFWL4bC9378DbBWWOuN-HJ4T8McJQBauctM58-lfcPB5iA9l8NgebBi7Vm4BLemyFoRGBHNQUub
');
        $msg = array
            (
            'title' => $this->subject,
            'body' => $this->message,
        );
        $fields = array
            (
//            'registration_ids' => $registrationIds,
            "to" => "/topics/price",
            'notification' => $msg
        );

        $headers = array
            (
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        return true;
    }

    public function notifyToUser($registrationToken) {

        define('API_ACCESS_KEY', 'AAAAOSRyA4w:APA91bGpPImQQPQTgvZQdL8qe7QbF1khXBJxe1QO8TiuC6brGSoDEDVuuObrJqqpGHFWL4bC9378DbBWWOuN-HJ4T8McJQBauctM58-lfcPB5iA9l8NgebBi7Vm4BLemyFoRGBHNQUub');
        $msg = array
            (
            'title' => $this->subject,
            'body' => $this->message,
        );
        $fields = array
            (
            'registration_ids' => $registrationToken,
            'notification' => $msg
        );

        $headers = array
            (
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        return true;
    }

    public function notifyToUserGoToAd($registrationToken, $roomId) {

        $msg = array
            (
            'title' => $this->subject,
            'body' => $this->message,
        );
        $fields = array
            (
            'registration_ids' => $registrationToken,
            'notification' => $msg,
            'data' => ["roomId" => $roomId]
        );

        $headers = array
            (
            'Authorization: key=AAAAOSRyA4w:APA91bGpPImQQPQTgvZQdL8qe7QbF1khXBJxe1QO8TiuC6brGSoDEDVuuObrJqqpGHFWL4bC9378DbBWWOuN-HJ4T8McJQBauctM58-lfcPB5iA9l8NgebBi7Vm4BLemyFoRGBHNQUub',
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        return true;
    }

    public static function notifyStreamersForChallenge($room) {
        $mentions = [];
        if ($room) {
            if ($room["mention"]) {
                array_push($mentions, $room["mention"]);
            }
            if ($room["mention2"]) {
                array_push($mentions, $room["mention2"]);
            }
            if ($room["mention3"]) {
                array_push($mentions, $room["mention3"]);
            }

            for ($i = 0; $i < sizeof($mentions); $i++) {
                $userId = $mentions[$i];
                $user = Users::findOne(["id" => $userId]);
                $msg = array
                    (
                    'title' => "some subject",
                    'body' => "some body",
                    "userId" => $userId,
                    "challengeId" => $room["id"],
                    "challengeTitle" => $room["title"],
                    "challengeText" => $room["c_text"]
                );
                $fields = array
                    (
                    'registration_ids' => [$user["token"]],
//                    'registration_ids' => ["eWG5U4bYST60ryg-NYIfFN:APA91bG9jlSW84MVGvO3Xz4tHC6xpto1Szgtz_bfkLLsyLPHqzWtk_lkjjbFyzCVPlhKLf_Bu4x4u5C7Nc1FAnI3fR_fAaSrV-_XaALDvkfsb9ZIq3eNZuTlp9Hx1-CcKgD5aihc6d7z"],
                    'data' => $msg
                );

                $headers = array
                    (
                    'Authorization: key=AAAAOSRyA4w:APA91bGpPImQQPQTgvZQdL8qe7QbF1khXBJxe1QO8TiuC6brGSoDEDVuuObrJqqpGHFWL4bC9378DbBWWOuN-HJ4T8McJQBauctM58-lfcPB5iA9l8NgebBi7Vm4BLemyFoRGBHNQUub',
                    'Content-Type: application/json'
                );
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                $result = curl_exec($ch);
                curl_close($ch);


                $myNotificationModel = new Notificaion();
                $myNotificationModel->room_id = $room["id"];
                $myNotificationModel->sender_id = null;
                $myNotificationModel->reciever_id = $userId;
                $myNotificationModel->description = $room["title"] . " - " . $room["c_text"];
                $myNotificationModel->save();
            }
            return true;
        }
    }

    public static function notifyVotersTheWinner($tokens, $winnerUser, $challenge) {

        $newTokens = [];
        for ($i = 0; $i < sizeof($tokens); $i++) {
            $token = $tokens[$i];
            if ($winnerUser) {
                if ($winnerUser["token"] == $token) {
                    continue;
                }
            }
            array_push($newTokens, $token);
        }

        $challengeTitle = $challenge["title"];
        $winnerName = "";
        if ($winnerUser) {

            $userWinnerrrModel = Users::findOne(["id" => $winnerUser["id"]]);
            if ($userWinnerrrModel) {
                $userWinnerrrModel->coins = $userWinnerrrModel->coins + $challenge["challenge_coins"];
                $userTransaction = new UserTransactions();
                $userTransaction->fromUser = $challenge["r_admin"];
                $userTransaction->userId = $winnerUser["id"];
                $userTransaction->coins = $challenge["challenge_coins"];
                $userTransaction->type = "challenge";
                $userTransaction->roomId = $challenge["id"];
                $userTransaction->save();
                if ($userWinnerrrModel->save()) {
                    
                }
            }


            $winnerName = $winnerUser["fullname"];

            $msgWinner = array
                (
                'title' => $challengeTitle,
                'body' => "",
                'winnerName' => $winnerName,
                'isWinner' => "1",
            );

            $fieldsWinner = array
                (
                'registration_ids' => [$winnerUser["token"]],
                'data' => $msgWinner
            );

            $headersWinner = array
                (
                'Authorization: key=AAAAOSRyA4w:APA91bGpPImQQPQTgvZQdL8qe7QbF1khXBJxe1QO8TiuC6brGSoDEDVuuObrJqqpGHFWL4bC9378DbBWWOuN-HJ4T8McJQBauctM58-lfcPB5iA9l8NgebBi7Vm4BLemyFoRGBHNQUub',
                'Content-Type: application/json'
            );
            $ch1 = curl_init();
            curl_setopt($ch1, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch1, CURLOPT_POST, true);
            curl_setopt($ch1, CURLOPT_HTTPHEADER, $headersWinner);
            curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch1, CURLOPT_POSTFIELDS, json_encode($fieldsWinner));
            $result1 = curl_exec($ch1);
            curl_close($ch1);

            $isWinner = "0"; // there is a winner 0 means sent to not winner user
        } else {


            $userWinnerrrModel = Users::findOne(["id" => $challenge["r_admin"]]);
            if ($userWinnerrrModel) {
                $userWinnerrrModel->coins = $userWinnerrrModel->coins + $challenge["challenge_coins"];
                $userTransaction = new UserTransactions();
                $userTransaction->fromUser = $challenge["r_admin"];
                $userTransaction->userId = $challenge["r_admin"];
                $userTransaction->coins = $challenge["challenge_coins"];
                $userTransaction->type = "challenge";
                $userTransaction->roomId = $challenge["id"];
                $userTransaction->save();
                if ($userWinnerrrModel->save()) {
                    
                }
            }


            $isWinner = "2"; // there is a tie
        }


        $msg = array
            (
            'title' => "",
            'challengeTitle' => $challengeTitle,
            'body' => "",
            'winnerName' => $winnerName,
            'isWinner' => $isWinner,
        );


        $fields = array
            (
            'registration_ids' => $newTokens,
            'data' => $msg
        );

        $headers = array
            (
            'Authorization: key=AAAAOSRyA4w:APA91bGpPImQQPQTgvZQdL8qe7QbF1khXBJxe1QO8TiuC6brGSoDEDVuuObrJqqpGHFWL4bC9378DbBWWOuN-HJ4T8McJQBauctM58-lfcPB5iA9l8NgebBi7Vm4BLemyFoRGBHNQUub',
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        return true;
    }

}
