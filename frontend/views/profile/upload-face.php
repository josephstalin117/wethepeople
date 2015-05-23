<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '上传头衔'), 'url' => ['uploadFace']];
?>
<div class="posts-view">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <button>Submit</button>

    <?php ActiveForm::end() ?>
</div>