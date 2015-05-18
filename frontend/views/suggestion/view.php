<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model common\models\Suggestion */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '提议'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="suggestion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', '同意'), ['up', 'id' => $model->id], ['class' => 'btn btn-primary',
            'data' => [
                'confirm' => Yii::t('app', '你确定要赞同此提议吗？'),
                'method' => 'post',
            ],]) ?>
        <?= Html::a(Yii::t('app', '反对'), ['down', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', '你确定要反对此提议吗？'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'content:ntext',
//            'submitter',
//            'status',
            'up',
            'down',
//            'part:ntext',
            [
                'attribute' => 'created_at',
                'format' => 'date',
            ],
//            'updated_at',
        ],
    ]) ?>

</div>
<div class="row">
    <div class="col-lg-5">
        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
        <?= $form->field($comment, 'content')->textArea(['rows' => 3]) ?>
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<div class="section-student dd-listview-table">
    <table class="table table-hover items-students">
        <thead>
        <tr>
            <th><?= Yii::t('app', '评论内容'); ?></th>
            <th><?= Yii::t('app', '评论时间'); ?></th>
            <th></th>
        </tr>
        </thead>
        <?php $listview = ListView::begin([
            'dataProvider'  =>  $commentsProvider,
            'itemView'      =>  '_comments',
            'layout'        =>  '{items}'
        ]); ?>
        <?php ListView::end(); ?>
    </table>
    <!-- 分页 -->
    <?= $listview->renderPager(); ?>
</div>
