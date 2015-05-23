<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->realname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '用户'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a($model->status == 0 ? Yii::t('app', '激活用户') : Yii::t('app', '冻结用户'), ['activate', 'id' => $model->id], ['class' => 'btn btn-success', 'date' => ['method' => 'post']]) ?>
        <?= Html::a(Yii::t('app', '修改'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', '删除'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', '你希望删除这个用户吗？'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a($model->role == 10 ? Yii::t('app', '设置为学生') : Yii::t('app', '设置为管理员'), ['role', 'id' => $model->id], [
            'class' => 'btn btn-primary',
            'data' => [
                'confirm' => Yii::t('app', '你希望修改这个用户角色吗？'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
//            'auth_key',
//            'password_hash',
//            'password_reset_token',
            'email:email',
            'roleLabel',
            'realname',
            'statusLabel',
            [
                'attribute' => 'created_at',
                'format' => 'date',
            ],
//            'updated_at',
        ],
    ]) ?>

</div>
