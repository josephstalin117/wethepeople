<?php

namespace frontend\controllers;

use common\models\Message;
use common\models\User;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;
use yii\web\Response;
use yii\widgets\ActiveForm;

class MessageController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'send', 'root', 'list'],
                'rules' => [
                    [
                        'actions' => ['index', 'send', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['chat'],
                        'allow' => true,
                        'roles' => ['?'],
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
     * 发送小纸条数据
     * @return string|\yii\web\Response
     */
    public function actionSend()
    {
        $model = new Message();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->send_id = Yii::$app->user->id;
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', '发送成功');
            } else {
                Yii::$app->getSession()->setFlash('success', '发送失败');
            }
        }
        return $this->render('send', ['model' => $model]);
    }


    /**
     * 显示他人发送的小纸条数据
     * @author:josephLin
     */
    public function actionIndex()
    {
        //显示用户的小纸条联系人
        if ($provider = Message::getLatestContact(Yii::$app->user->id)) {
            return $this->render('index', ['provider' => $provider]);
        } else {
            echo "没有私信";
        }
    }

    /**
     * 查看具体信息
     * @param $userId
     * @return string
     */
    public function actionList($userId)
    {
        $userId1 = Yii::$app->user->id;
        $userId2 = $userId;
        $messages = Message::getDialogue($userId1, $userId2);
        return $this->render('list', ['messages' => $messages]);
    }
}
