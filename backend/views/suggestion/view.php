<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
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
        <?= Html::a($model->status == 1 ? Yii::t('app', '取消激活') : Yii::t('app', '激活'), ['activate', 'id' => $model->id], [
            'class' => 'btn btn-success',
            'date' => [
                'method' => 'post'
            ]
        ]) ?>
        <?= Html::a(Yii::t('app', '更新'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', '删除'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', '你想删除这个提议吗？'),
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
            [
                'label' => '提交人',
                'value' => $model->user->realname,
            ],
//            'status',
            'statusLabel',
            'up',
            'down',
//            'part:ntext',
            [
                'attribute' => 'created_at',
                'format' => 'date',
            ],
        ],
    ]) ?>

</div>
<div class="section-student dd-listview-table">
    <table class="table table-hover items-students">
        <thead>
        <tr>
            <th><?= Yii::t('app', '表态学生'); ?></th>
            <th><?= Yii::t('app', '态度'); ?></th>
            <th></th>
        </tr>
        </thead>
        <?php $listview = ListView::begin([
            'dataProvider' => $suggesDetailProvider,
            'itemView' => '_suggesDetail',
            'layout' => '{items}'
        ]); ?>
        <?php ListView::end(); ?>
    </table>
    <!-- 分页 -->
    <?= $listview->renderPager(); ?>
</div>
