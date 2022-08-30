<?php

namespace app\controllers\api;

use Yii;
use yii\filters\auth\QueryParamAuth;
use yii\web\Controller;
use yii\web\Response;

/**
 * Description of BaseController
 *
 * @author user
 */
class ApiController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
            'user' => \Yii::$app->get('user'),
            'except' => ['login', 'signup']
        ];
        return $behaviors;
    }

    public function beforeAction($action) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

}
