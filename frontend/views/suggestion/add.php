<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

?>
<h1>建议</h1>

<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        分享您的建议，并与大家共同讨论吧。
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
            <?= $form->field($model, 'title') ?>
            <?= $form->field($model, 'content')->textArea(['rows' => 6]) ?>
            <div class="form-group">
                <?= Html::submitButton('提交', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
