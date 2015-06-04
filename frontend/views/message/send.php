<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Suggestion */

$this->title = Yii::t('app', '发送私信');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '私信'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="suggestion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>