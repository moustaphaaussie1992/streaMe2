<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers\api;

use app\models\Ads;
use app\models\Clients;
use app\models\NotificationForm;
use Yii;

class ApproveController extends ApiController {

    public function actionApprove() {

        $request = Yii::$app->request;
        $post = $request->post();
        $id = $post["id"];
        $is_approved = $post["is_approved"];


        $streamer = \app\models\Users::findOne(["id" => $id]);
        if ($streamer && $is_approved == 1) {
            $streamer->is_approved = $is_approved;
            if ($streamer->save()) {


                if ($streamer->token != null && $streamer->token != "" && $streamer->token) {
                    $notification = new NotificationForm();
                    $notification->subject = "StreaMe‎";
                    $notification->message = "Your Account is Verified now, Enjoy using StreaMe!";
                    $notification->notifyToUser([$streamer->token]);
                    $sent = 1;
                } else {
                    $sent = 0;
                }
            }
            return ["success",
                "token" => $streamer->token,
                "isapproved" => $streamer["is_approved"],
                "name" => $streamer["id"],
                "sent" => $sent];
        } else {
            return "user not found";
        }
    }

}
