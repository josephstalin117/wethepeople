<?php

namespace backend\controllers;

use Yii;
use common\models\Suggestion;
use backend\models\SuggestionSearche;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\SuggesDetail;

/**
 * SuggestionController implements the CRUD actions for Suggestion model.
 */
class SuggestionController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['view', 'create', 'update', 'delete', 'index', 'logout','activate'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Suggestion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SuggestionSearche();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Suggestion model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $suggesDetailProvider = new ActiveDataProvider([
            'query' => SuggesDetail::find()->where(['sugg_id' => $id]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'suggesDetailProvider' => $suggesDetailProvider,
        ]);
    }

    /**
     * Creates a new Suggestion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Suggestion();

        if ($model->load(Yii::$app->request->post())) {
            $model->submitter = Yii::$app->user->id;
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', '创建成功');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->getSession()->setFlash('error', '创建失败');
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionActivate($id){
        $model=$this->findModel($id);
        $model->status==1?$model->status=0:$model->status=1;
        if($model->update()){
            return $this->redirect(['view', 'id' => $model->id]);
        }else{
            return $this->redirect(['view', 'id' => $model->id]);
        }
    }

    /**
     * Updates an existing Suggestion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->submitter = Yii::$app->user->id;
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', '更新成功');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                error_log(print_r($model->errors, true));
                Yii::$app->session->setFlash('error', '更新失败');
                return $this->render('update', ['model' => $model,]);
            }
        } else {
            return $this->render('update', ['model' => $model,]);
        }
    }

    /**
     * Deletes an existing Suggestion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Suggestion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Suggestion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Suggestion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
