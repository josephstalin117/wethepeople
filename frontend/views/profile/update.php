<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Posts */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '个人中心'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->realname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', '更新个人信息');
?>
<div class="posts-update">

    <h1><?= Html::encode($model->realname) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
