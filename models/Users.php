<?php

namespace app\models;

use app\models\base\Users as BaseUsers;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "users".
 *
 * 	* @property string $phone
 * @property string $email
 * @property string $address
 * @property string $birthday
 * @property string $gender
 * @property string $work
 * @property string $hashtags
 * @property int $id
 * @property int $role
 * @property string $fullname
 * @property string $tags
 * @property string $bio
 * @property string $password
 * @property string $username
 * @property int $role

 * @property int $is_approved
 * @property int $coins
 * @property string|null $token
 * @property string|null $link_facebook
 * @property string|null $link_youtube
 * @property string|null $link_instagram
 * @property string|null $link_tiktok
 * @property string|null $profile_picture
 *
 * @property Comment[] $comments
 * @property Follow[] $follows
 * @property Follow[] $follows0
 * @property Followrooms[] $followrooms
 * @property Rooms[] $rooms
 * @property StreamerGames[] $streamerGames
 * @property Games[] $games
 */
class Users extends BaseUsers {

    const ROLE_ADMIN = 'Administrator';
    const ROLE_SUPERVISOR = 'Supervisor';

    public $role;

//    public $password;

    public function behaviors() {
        return ArrayHelper::merge(
                        parent::behaviors(), [
                        # custom behaviors
                        ]
        );
    }

    public function rules() {
        return [
            [['fullname', 'password', 'username'], 'required'],
            [['password'], 'string'],
            [['role', 'is_approved','role'], 'integer'],
            [['fullname', 'link_facebook', 'link_youtube', 'link_instagram', 'link_tiktok','tags','bio'], 'string', 'max' => 200],
            [['username'], 'string', 'max' => 100],
            [['token'], 'string', 'max' => 300],
            [['profile_picture'], 'string', 'max' => 2000],
            [['username'], 'unique'],
        ];
    }

    public function attributeLabels() {
        return ArrayHelper::merge(parent::attributeLabels(), [
                    'role' => Yii::t('user', 'Role'),
//                    'password' => Yii::t('user', 'Password'),
                    'actions' => Yii::t('user', 'Actions'),
                    'branch' => 'Branch',
        ]);
    }

    public static function getUser($id) {
        $model = Users::find()
                        ->select('user.*,auth_item.name as role')
                        ->leftJoin('auth_assignment', 'auth_assignment.user_id=user.id')
                        ->leftJoin('auth_item', 'auth_item.name = auth_assignment.item_name')
                        ->where(['user.id' => $id])->all();
        return $model[0];
    }

    public function signup() {
        if ($this->validate()) {
            $this->setPassword($this->password);
            $this->generateAuthKey();
            if ($this->save()) {
                return $this;
            }
        } else {
            VarDumper::dump($this->getErrors(), 3, true);
            die();
        }
        return null;
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        return self::findOne(['auth_key' => $token]);
    }

    public static function getRoles() {
        return [
            'id' => Yii::t('app', 'ID'),
            'fullname' => Yii::t('app', 'Fullname'),
            'password' => Yii::t('app', 'Password'),
            'username' => Yii::t('app', 'Username'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
            'address' => Yii::t('app', 'Address'),
            'birthday' => Yii::t('app', 'Birthday'),
            'gender' => Yii::t('app', 'Gender'),
            'work' => Yii::t('app', 'Work'),
            'hashtags' => Yii::t('app', 'Hashtags'),
            'role' => Yii::t('app', 'Role'),
            'token' => Yii::t('app', 'Token'),
            'link_facebook' => Yii::t('app', 'Link Facebook'),
            'link_youtube' => Yii::t('app', 'Link Youtube'),
            'link_instagram' => Yii::t('app', 'Link Instagram'),
            'link_tiktok' => Yii::t('app', 'Link Tiktok'),
            'profile_picture' => Yii::t('app', 'Profile Picture'),
            'is_approved' => Yii::t('app', 'Is Approved'),
            'coins' => Yii::t('app', 'Coins'),
            'tags' => Yii::t('app', 'tags'),
            'bio' => Yii::t('app', 'bio'),
        ];
    }

    public static function isAdminRole() {
        $model = Users::find()
                        ->select('user.*,auth_item.name as role')
                        ->leftJoin('auth_assignment', 'auth_assignment.user_id=user.id')
                        ->leftJoin('auth_item', 'auth_item.name = auth_assignment.item_name')
                        ->where(['auth_item.type' => 1,
                            'user.id' => Yii::$app->user->id])->asArray()->all();


        if (isset($model) && isset($model[0]) && $model[0]['role'] == Users::ROLE_ADMIN) {
            return true;
        }
        return false;
    }

//    public static function isBranchRole() {
//        $model = Users::find()
//                        ->select('user.*,auth_item.name as role')
//                        ->leftJoin('auth_assignment', 'auth_assignment.user_id=user.id')
//                        ->leftJoin('auth_item', 'auth_item.name = auth_assignment.item_name')
//                        ->where(['auth_item.type' => 1,
//                            'user.id' => Yii::$app->user->id])->asArray()->all();
//
//        if (isset($model) && isset($model[0]) && $model[0]['role'] == Users::ROLE_BRANCH) {
//            return true;
//        }
//        return false;
//    }

    public static function isSupervisorRole() {
        $model = Users::find()
                        ->select('user.*,auth_item.name as role')
                        ->leftJoin('auth_assignment', 'auth_assignment.user_id=user.id')
                        ->leftJoin('auth_item', 'auth_item.name = auth_assignment.item_name')
                        ->where(['auth_item.type' => 1,
                            'user.id' => Yii::$app->user->id])->asArray()->all();

        if (isset($model) && isset($model[0]) && $model[0]['role'] == Users::ROLE_SUPERVISOR) {
            return true;
        }
        return false;
    }

//    public static function isServiceRole() {
//        $model = Users::find()
//                        ->select('user.*,auth_item.name as role')
//                        ->leftJoin('auth_assignment', 'auth_assignment.user_id=user.id')
//                        ->leftJoin('auth_item', 'auth_item.name = auth_assignment.item_name')
//                        ->where(['auth_item.type' => 1,
//                            'user.id' => Yii::$app->user->id])->asArray()->all();
//
//        if (isset($model) && isset($model[0]) && $model[0]['role'] == Users::ROLE_SERVICE_CENTER) {
//            return true;
//        }
//        return false;
//    }
//    public static function isAdminRole() {
//        $model = User::find()
//                        ->select('user.*,auth_item.name as role')
//                        ->leftJoin('auth_assignment', 'auth_assignment.user_id=user.id')
//                        ->leftJoin('auth_item', 'auth_item.name = auth_assignment.item_name')
//                        ->where(['auth_item.type' => 1,
//                            'user.id' => Yii::$app->user->id])->asArray()->all();
//
//
//        if (isset($model) && isset($model[0]) && $model[0]['role'] == User::ROLE_ADMIN) {
//            return true;
//        }
//        return false;
//    }
}
