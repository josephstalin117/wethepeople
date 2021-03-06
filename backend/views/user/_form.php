<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput() ?>
<!--    --><?//= $form->field($model, 'password_hash')->textInput() ?>
    <?= $form->field($model, 'realname')->textInput() ?>
    <?//@todo 修改text为listbox?>
<!--    --><?//= $form->field($model, 'role')->textInput() ?>
    <?= $form->field($model, 'email')->textInput() ?>
<!--    --><?//= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
