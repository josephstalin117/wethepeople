<?php

namespace frontend\controllers;

use frontend\models\ResetPasswordForm;
use Yii;
use common\models\User;
use common\models\UploadForm;
use common\models\UploadFile;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;

class ProfileController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'update', 'upload-face', 'reset-password'],
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
     * 加载个人信息
     * @return string
     */
    public function actionIndex()
    {
        $model = User::findOne(['id' => Yii::$app->user->id]);
        return $this->render('index', ['model' => $model]);
    }

    /**
     * 更新个人信息
     */
    public function actionUpdate()
    {
        $model = User::findOne(['id' => Yii::$app->user->id]);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', '更新成功');
                return $this->redirect(['index', 'id' => $model->id]);
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
     * 上传头像
     */
    public function actionUploadFace()
    {
        //@todo
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->file && $model->validate()) {
                $path = time() . '_' . Yii::$app->security->generateRandomString(8) . '.' . $model->file->extension;
                $model->file->saveAs(Yii::$app->basePath . '/web/uploads/' . $path);

                $uploadFile = new UploadFile();
                $uploadFile->path = $path;
                $uploadFile->user_id = Yii::$app->user->id;
                $uploadFile->mime_type = $model->file->type;
                if ($uploadFile->save()) {
                    $user = User::findOne(['id' => Yii::$app->user->id]);
                    if ($user->face) {
                        $user->face = null;
                        $user->save();
                    }
                    $user->face = $path;
                    if ($user->save()) {
                        return $this->redirect('index');
                    } else {
                        error_log(print_r($user->errors, true));
                        $uploadFile->delete();
                    }
                } else {
                    error_log(print_r($uploadFile->errors, true));
                }

            }
        }

        return $this->render('upload-face', ['model' => $model]);
    }

    public function actionResetPassword()
    {
        $model = new ResetPasswordForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', '密码修改成功');
            return $this->goHome();
        }

        return $this->render('resetPassword', ['model' => $model,]);
    }

}
