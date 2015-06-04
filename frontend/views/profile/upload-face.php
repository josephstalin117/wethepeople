<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '上传头像'), 'url' => ['uploadFace']];
?>
<div class="posts-view">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <button>上传</button>

    <?php ActiveForm::end() ?>
</div>