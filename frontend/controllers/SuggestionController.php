<?php

namespace frontend\controllers;

use common\models\Comment;
use Yii;
use common\models\Suggestion;
use common\models\SuggesDetail;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;

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
                        'actions' => ['logout', 'index', 'view', 'add', 'up', 'down'],
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
        $provider = new ActiveDataProvider([
            'query' => Suggestion::find()->where('status=1')->orderBy('created_at DESC'),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $provider,
        ]);
    }

    /**
     * Displays a single Suggestion model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $comment = new Comment();
        if (Yii::$app->request->post()) {
            $comment->sugg_id = $id;
            $comment->part_id = strval(Yii::$app->user->id);
            $comment->content = Yii::$app->request->post('Comment')['content'];
            if ($comment->save()) {
                Yii::$app->session->setFlash('success', '评论成功');
                return $this->redirect(['view', 'id' => $id]);
            } else {
                error_log(print_r($comment->errors, true));
                Yii::$app->session->setFlash('error', '评论失败');
                return $this->redirect(['view', 'id' => $id]);
            }
        }

        $commentsProvider = new ActiveDataProvider([
            'query' => Comment::find()->where(['sugg_id' => $id])->orderBy('created_at DESC'),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'comment' => $comment,
            'commentsProvider' => $commentsProvider,
        ]);
    }

    /**
     * Creates a new Suggestion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAdd()
    {
        $model = new Suggestion();
        if (Yii::$app->request->post()) {
            $model->submitter = Yii::$app->user->id;
            $model->load(Yii::$app->request->post());
            if ($model->save()) {
                Yii::$app->session->setFlash('success', '感谢您的提议，我们会尽快回复');
            } else {
                Yii::$app->session->setFlash('error', '发送失败');
            }
            error_log(print_r($model->errors, true));
            return $this->refresh();
        }
        return $this->render('add', ['model' => $model,]);
    }

    public function actionUp($id)
    {
        $this->setUpDown($id, "up");
    }

    public function actionDown($id)
    {
        $this->setUpDown($id, "down");
    }

    public function setUpDown($id, $attitude)
    {
        $model = $this->findModel($id);
        if (!in_array(Yii::$app->user->id, explode(",", $model->part))) {
            $model->$attitude = $model->$attitude + 1;
            $model->part = $model->part . "," . Yii::$app->user->id;
            if ($model->save()) {
                $suggesDetail = new SuggesDetail();
                $suggesDetail->sugg_id = $id;
                $suggesDetail->part_id = Yii::$app->user->id;
                //@todo 永远为1
                $suggesDetail->attributes = $attitude == "up" ? 1 : 0;
                if($suggesDetail->save()){
                    Yii::$app->session->setFlash('success', '提交成功');
                    return $this->redirect(['view', 'id' => $model->id]);
                }else{
                    Yii::$app->session->setFlash('error', '提交失败');
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            Yii::$app->session->setFlash('error', '抱歉，您已经提交同意或反对了');
            return $this->redirect(['view', 'id' => $model->id]);
        }
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
