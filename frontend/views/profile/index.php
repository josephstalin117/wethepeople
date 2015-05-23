<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Posts */

$this->title = $model->realname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '个人中心'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

Yii::setAlias('@facePathRoot', Yii::$app->basePath . '/web/upload/');
?>

<div class="posts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', '更新'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', '上传头像'), ['upload-face'], ['class' => 'btn btn-danger',]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'realname',
            [
                'label' => '头像',
                'value' => $model->image,
                'format' => ['image',['width'=>'100','height'=>'100']],
            ],
            [
                'label' => '个人介绍',
                'value' => $model->bio,
            ],
        ],
    ]) ?>

</div>


