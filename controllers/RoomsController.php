<?php

namespace app\controllers;

use app\models\PostFiles;
use app\models\Rooms;
use app\models\RoomsSearch;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * RoomsController implements the CRUD actions for Rooms model.
 */
class RoomsController extends Controller {

    /**
     * {@inheritdoc}
     */
//    public function behaviors() {
//        return [
//            'access' => [
//                'class' => AccessControl::class,
//                'only' => ['create', 'update', 'delete'],
//                'rules' => [
////                    // deny all POST requests
////                    [
////                        'allow' => false,
////                        'verbs' => ['POST']
////                    ],
//                    // allow authenticated users
//                    [
//                        'allow' => true,
//                        'roles' => ['?'],
//                    ],
//                // everything else is denied
//                ],
//            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['POST'],
//                ],
//            ],
//        ];
//    }
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
     * Lists all Rooms models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new RoomsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rooms model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Rooms model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Rooms();

        if ($model->load(Yii::$app->request->post())) {

            $model->r_admin = \Yii::$app->getUser()->getId();
            $model->category = "share";
            ////            VarDumper::dump($files, 3, 1);
//            die();
//            if ($model->uploa     \yii\helpers\VarDumper::dump($files,3,3);
//            die();
//            if ($modFiles($files, $id)) {
//                return $this->redirect(['view', 'id' => $id]);
//            } else {
//                
//            }
//            return true;



            if ($model->save()) {

                if ($model->type = "pictures") {
                    $model->file = UploadedFile::getInstances($model, 'file');
                    $files = $model->file;
                    foreach ($files as $file) {
                        $randomString = Yii::$app->security->generateRandomString();
                        $imageName = $randomString . '.' . $file->extension;
                        $postFiles = new PostFiles();
                        $postFiles->file_name = $imageName;
                        $postFiles->post_id = $model->primaryKey;
                        if ($postFiles->save()) {
                            
                        } else {
                            VarDumper::dump($postFiles->getErrors(), 3, true);
                            die();
                        }
                        $file->saveAs('postPictures/' . $imageName);
                    }
                }
                if ($model->type = "video") {
                    $model->video = UploadedFile::getInstances($model, 'video');
                    $files = $model->video;
//             VarDumper::dump($model->video,3,3);
//                    die();
                    foreach ($files as $file) {
                        $randomString = Yii::$app->security->generateRandomString();
                        $imageName = $randomString . '.' . $file->extension;
                        $postFiles = new PostFiles();
                        $postFiles->file_name = $imageName;
                        $postFiles->post_id = $model->primaryKey;
//                    VarDumper::dump($postFiles,3,3);
//                    die();
                        if ($postFiles->save()) {
                            
                        } else {
                            VarDumper::dump($postFiles->getErrors(), 3, true);
                            die();
                        }
                        $file->saveAs('videoUploads/' . $imageName);
                    }
                }



                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->renderAjax('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Rooms model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
//    public function actionUpdate($id) {
//        $model = $this->findModel($id);
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//
//        return $this->render('update', [
//                    'model' => $model,
//        ]);
//    }

    /**
     * Deletes an existing Rooms model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
//    public function actionDelete($id) {
//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
//    }

    /**
     * Finds the Rooms model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rooms the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Rooms::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
