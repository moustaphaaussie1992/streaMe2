<?php

namespace app\controllers;

use app\controllers\api\MobileController;
use app\models\Comment;
use app\models\ContactForm;
use app\models\Follow;
use app\models\LoginForm;
use app\models\Rooms;
use app\models\Users;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;
use const YII_ENV_TEST;

class SiteController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {

//        $lastPriceModel = PriceInLebanese::find()
//                ->orderBy("date desc")
//                ->limit(1)
//                ->all();
//
//        if ($lastPriceModel) {
//            $lastPrice = $lastPriceModel[0];
//        }
//        $dateformat = new Expression("DATE_FORMAT(`date`, '%m-%d') as date");
//
//        $subquery = (new \yii\db\Query)
//                ->from(PriceInLebanese::tableName())
//                ->orderBy("date desc")
//                ->limit(7);
//        $query = PriceInLebanese::find()
//                ->select(["buy_price", "sell_price", $dateformat])
//                ->from($subquery)
//                ->orderBy("date asc");
//
//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
////            'pagination' => array('pageSize' => 10),
//            'pagination' => false,
//        ]);
//        return "myIndex";

        $rooms = new ActiveDataProvider(['query' => Rooms::find(),
//            'pagination'=> [
//                'pageSize'=>3, 
//            ]
        ]);
        $userId = Yii::$app->user->id;
        $sql = "SELECT rooms.*, users.profile_picture,users.fullname,followrooms.r_room as room_id_liked,
            (SELECT COUNT(id) FROM followrooms WHERE r_room = rooms.id) as number_of_likes,
            (SELECT COUNT(id) FROM comment WHERE r_room = rooms.id) as number_of_comments,
            (SELECT c_text FROM comment WHERE r_room = rooms.id ORDER BY id DESC LIMIT 1) as last_comment,
          
            
type,
            (SELECT GROUP_CONCAT(file_name SEPARATOR ',') FROM post_files WHERE post_id = rooms.id) as files
             FROM rooms
             JOIN users ON rooms.r_admin = users.id
             LEFT JOIN followrooms ON followrooms.r_room = rooms.id AND followrooms.r_user = '$userId'
           
             ORDER BY rooms.creation_date DESC;";
        $command = Yii::$app->db->createCommand($sql);
        $arrayList = $command->queryAll();
// WHERE rooms.creation_date >= CURDATE()
//          where rooms.category = 'share'



        for ($i = 0; $i < sizeof($arrayList); $i++) {
            $item = $arrayList[$i];
//            
//            if($arrayList[$i]["last_comment"]!=null && $arrayList[$i]["last_comment"]!="" ){
//                      $arrayList[$i]["comments"] = Comment::find()->where(["r_room"=>$arrayList[$i]["id"]])->asArray->all();  
//            }




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

//                $arrayList[$i]["challengesVideos"] = null;
//                
                $donations = "SELECT  SUM(user_transactions.coins) AS value_sum 
FROM user_transactions
WHERE roomId =" . $item["id"];

                $command1 = Yii::$app->db->createCommand($donations);
//              return  $command1->queryOne()["value_sum"]; 
                $itemDonate = $command1->queryOne();
                $arrayList[$i]["number_of_donates"] = $itemDonate["value_sum"];
//              
            } else {
                $arrayList[$i]["challengesVideos"] = null;
            }
        }

//        return $arrayList;
        return $this->render('index', [
                    'rooms' => $arrayList,
//                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionProfile() {
//        die();

        $rooms = new ActiveDataProvider(['query' => Rooms::find(),
//            'pagination'=> [
//                'pageSize'=>3, 
//            ]
        ]);
        $userId = Yii::$app->user->id;

        $user = Users::find()->where(['id' => $userId])->one();

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
//        \yii\helpers\VarDumper::dump($userProfile, 10, true);
//
//          $post = Yii::$app->request->post();
     
        $countposts = Rooms::find()
                ->where(['r_admin' => $userId])
                ->all();

        $userProfile["numberOfPosts"] = sizeof($countposts);

        $count = Follow::find()
                ->where(['r_page' => $userId])
                ->asArray()
                ->all();

        $userProfile["numberOfFollowers"] = sizeof($count);

    


        $sql = "SELECT rooms.*, users.profile_picture,users.fullname,followrooms.r_room as room_id_liked,
            (SELECT COUNT(id) FROM followrooms WHERE r_room = rooms.id) as number_of_likes,
            (SELECT COUNT(id) FROM comment WHERE r_room = rooms.id) as number_of_comments,
            (SELECT c_text FROM comment WHERE r_room = rooms.id ORDER BY id DESC LIMIT 1) as last_comment,
          
            
type,
            (SELECT GROUP_CONCAT(file_name SEPARATOR ',') FROM post_files WHERE post_id = rooms.id) as files
             FROM rooms
             JOIN users ON rooms.r_admin = users.id
             LEFT JOIN followrooms ON followrooms.r_room = rooms.id AND followrooms.r_user = '$userId'
                 where rooms.r_admin ='$userId'
          
             ORDER BY rooms.creation_date DESC;";
        //        \yii\helpers\VarDumper::dump($sql,3,3);
        //        die();
        $command = Yii::$app->db->createCommand($sql);
        $arrayList = $command->queryAll();
// WHERE rooms.creation_date >= CURDATE()
//          where rooms.category = 'share'



        for ($i = 0; $i < sizeof($arrayList); $i++) {
            $item = $arrayList[$i];
//            
//            if($arrayList[$i]["last_comment"]!=null && $arrayList[$i]["last_comment"]!="" ){
//                      $arrayList[$i]["comments"] = Comment::find()->where(["r_room"=>$arrayList[$i]["id"]])->asArray->all();  
//            }




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

//                $arrayList[$i]["challengesVideos"] = null;
//                
                $donations = "SELECT  SUM(user_transactions.coins) AS value_sum 
FROM user_transactions
WHERE roomId =" . $item["id"];

                $command1 = Yii::$app->db->createCommand($donations);
//              return  $command1->queryOne()["value_sum"]; 
                $itemDonate = $command1->queryOne();
                $arrayList[$i]["number_of_donates"] = $itemDonate["value_sum"];
//              
            } else {
                $arrayList[$i]["challengesVideos"] = null;
            }
        }

        return $this->render('profile', [
                    'rooms' => $arrayList,
                    'user' => $userProfile,
        ]);
    }
       public function actionVisitProfile($userId) {
//        die();

        $rooms = new ActiveDataProvider(['query' => Rooms::find(),
//            'pagination'=> [
//                'pageSize'=>3, 
//            ]
        ]);
        $visitorId = Yii::$app->user->id;

        $user = Users::find()->where(['id' => $userId])->one();

        $userProfile = Users::find()
                ->select("username,fullname,role,link_facebook,link_youtube,link_instagram,link_tiktok,profile_picture,address,email,phone,gender,coins,tags,bio,id")
                ->where(['id' => $userId])
                ->asArray()
                ->one();

        $games = (new Query)
                ->select("games.id,games.name,streamer_games.user_id,streamer_games.game_id,streamer_games.game_account_id,streamer_games.id as streamerGameId")
                ->from("games")
                ->leftJoin("streamer_games", "games.id = streamer_games.game_id AND streamer_games.user_id = '" . $userId . "'")
                ->all();

        $userProfile["userGame"] = $games;
           $following = Follow::find()
                ->where(['r_user' => $visitorId])
                ->andWhere(['r_page' => $userId])
                ->one();
//        if ($following) {
//            $userProfile["following"] = 1;
//        } else {
//            $userProfile["following"] = 0;
//        }
//        \yii\helpers\VarDumper::dump($userProfile, 10, true);
//
//          $post = Yii::$app->request->post();
     
        $countposts = Rooms::find()
                ->where(['r_admin' => $userId])
                ->all();

        $userProfile["numberOfPosts"] = sizeof($countposts);

        $count = Follow::find()
                ->where(['r_page' => $userId])
                ->asArray()
                ->all();

        $userProfile["numberOfFollowers"] = sizeof($count);

    


        $sql = "SELECT rooms.*, users.profile_picture,users.fullname,followrooms.r_room as room_id_liked,
            (SELECT COUNT(id) FROM followrooms WHERE r_room = rooms.id) as number_of_likes,
            (SELECT COUNT(id) FROM comment WHERE r_room = rooms.id) as number_of_comments,
            (SELECT c_text FROM comment WHERE r_room = rooms.id ORDER BY id DESC LIMIT 1) as last_comment,
          
            
type,
            (SELECT GROUP_CONCAT(file_name SEPARATOR ',') FROM post_files WHERE post_id = rooms.id) as files
             FROM rooms
             JOIN users ON rooms.r_admin = users.id
             LEFT JOIN followrooms ON followrooms.r_room = rooms.id AND followrooms.r_user = '$userId'
                 where rooms.r_admin ='$userId'
          
             ORDER BY rooms.creation_date DESC;";
        //        \yii\helpers\VarDumper::dump($sql,3,3);
        //        die();
        $command = Yii::$app->db->createCommand($sql);
        $arrayList = $command->queryAll();
// WHERE rooms.creation_date >= CURDATE()
//          where rooms.category = 'share'



        for ($i = 0; $i < sizeof($arrayList); $i++) {
            $item = $arrayList[$i];
//            
//            if($arrayList[$i]["last_comment"]!=null && $arrayList[$i]["last_comment"]!="" ){
//                      $arrayList[$i]["comments"] = Comment::find()->where(["r_room"=>$arrayList[$i]["id"]])->asArray->all();  
//            }




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

//                $arrayList[$i]["challengesVideos"] = null;
//                
                $donations = "SELECT  SUM(user_transactions.coins) AS value_sum 
FROM user_transactions
WHERE roomId =" . $item["id"];

                $command1 = Yii::$app->db->createCommand($donations);
//              return  $command1->queryOne()["value_sum"]; 
                $itemDonate = $command1->queryOne();
                $arrayList[$i]["number_of_donates"] = $itemDonate["value_sum"];
//              
            } else {
                $arrayList[$i]["challengesVideos"] = null;
            }
        }
    //        \yii\helpers\VarDumper::dump($userId,3,3);
    //        \yii\helpers\VarDumper::dump($visitorId,3,3);
    //        die();

        return $this->render('profile', [
                    'rooms' => $arrayList,
                    'user' => $userProfile,
            'following'=>$following,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
                    'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout() {
        return $this->render('about');
    }

    public function actionPost($postId) {

        $userId = Yii::$app->user->id;
        $sql = "SELECT rooms.*, users.profile_picture,users.fullname,followrooms.r_room as room_id_liked,
            (SELECT COUNT(id) FROM followrooms WHERE r_room = rooms.id) as number_of_likes,
            (SELECT COUNT(id) FROM comment WHERE r_room = rooms.id) as number_of_comments,
            (SELECT c_text FROM comment WHERE r_room = rooms.id ORDER BY id DESC LIMIT 1) as last_comment,
          
            
type,
            (SELECT GROUP_CONCAT(file_name SEPARATOR ',') FROM post_files WHERE post_id = rooms.id) as files
             FROM rooms
             JOIN users ON rooms.r_admin = users.id
             LEFT JOIN followrooms ON followrooms.r_room = rooms.id AND followrooms.r_user = '$userId'
             WHERE rooms.id = '$postId'
             ORDER BY rooms.creation_date DESC;";
        $command = Yii::$app->db->createCommand($sql);
        $arrayList = $command->queryAll();

        if (sizeof($arrayList) > 0) {

            $item = $arrayList[0];

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

                $donations = "SELECT  SUM(user_transactions.coins) AS value_sum 
FROM user_transactions
WHERE roomId =" . $item["id"];

                $command1 = Yii::$app->db->createCommand($donations);
                $itemDonate = $command1->queryOne();
                $item["number_of_donates"] = $itemDonate["value_sum"];
            } else {
                $item["challengesVideos"] = null;
            }

            $commentsByPost = (new Query)
                    ->select(Comment::tableName() . ".*,users.fullname,users.profile_picture")
                    ->from(Comment::tableName())
                    ->where([
                        "r_room" => $postId
                    ])
                    ->join("join", "users", Comment::tableName() . ".r_user = users.id")
                    ->orderBy("creation_date Desc")
                    ->all();


            return $this->render('post', [
                        'room' => $item,
                        'commentsByPost' => $commentsByPost,
            ]);
        }
    }

}
