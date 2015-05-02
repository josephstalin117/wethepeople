<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SuggestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '提议');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="suggestion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', '创建一个提议'), ['add'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'title',
            'content:ntext',
//            'submitter',
//            'status',
            // 'up',
            // 'down',
            // 'part:ntext',
            // 'created_at',
            [
                'attribute' => 'created_at',
                'format' => 'date',
            ],
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{new_action1}{new_action2}',
                'buttons' => [
                    'new_action1' => function ($url, $model) {
                        return Html::a('<span class="btn btn-success">查看</span>', $url, [
                            'title' => Yii::t('app', 'New Action1'),
                        ]);
                    }
                ],
                'urlCreator' => function ($action, $model) {
                    if ($action === 'new_action1') {
                        $url = '/suggestion/view?id=' . $model->id;
                        return $url;
                    }
                }
            ],
        ],
    ]);
    ?>

</div>
