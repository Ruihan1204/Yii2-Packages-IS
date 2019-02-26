<?php

namespace backend\controllers;

use Yii;
use backend\models\Paket;
use backend\models\PaketSearch;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaketController implements the CRUD actions for Paket model.
 */
class PaketController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Paket models.
     * @return mixed
     */
    public function actionIndex()
    {
        $auth = Yii::$app->getAuthManager();
        $user_id = Yii::$app->user->id;
        $searchModel = new PaketSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (!$auth->checkAccess($user_id, 'list_packet')){
            $dataProvider = $searchModel->searchUserPacket(Yii::$app->request->queryParams, $user_id);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Paket model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws ForbiddenHttpException
     */
    public function actionView($id)
    {
        $auth = Yii::$app->getAuthManager();
        $user_id = Yii::$app->user->id;

        if (!$auth->checkAccess($user_id, 'view_recipient' )){
            throw new ForbiddenHttpException('We\'re sorry, you\'re not allowed to do this action!');
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Paket model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws ForbiddenHttpException
     */
    public function actionCreate()
    {
        $auth = Yii::$app->getAuthManager();
        $user_id = Yii::$app->user->id;

        if (!$auth->checkAccess($user_id, 'create_packet' )){
            throw new ForbiddenHttpException('We\'re sorry, you\'re not allowed to do this action!');
        }
        $model = new Paket();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_paket]);
        }

        return $this->render('create', [
            'model' => $model,
            'aksi' => 'create'
        ]);
    }

    /**
     * Updates an existing Paket model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws ForbiddenHttpException
     */
    public function actionUpdate($id)
    {
        $auth = Yii::$app->getAuthManager();
        $user_id = Yii::$app->user->id;

        if (!$auth->checkAccess($user_id, 'update_recipient' )){
            throw new ForbiddenHttpException('We\'re sorry, you\'re not allowed to do this action!');
        }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_paket]);
        }

        return $this->render('update', [
            'model' => $model,
            'aksi' => 'update'
        ]);
    }

    /**
     * Deletes an existing Paket model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $auth = Yii::$app->getAuthManager();
        $user_id = Yii::$app->user->id;

        if (!$auth->checkAccess($user_id, 'delete_packet' )){
            throw new ForbiddenHttpException('We\'re sorry, you\'re not allowed to do this action!');
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Paket model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Paket the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Paket::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
