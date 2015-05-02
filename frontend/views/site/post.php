<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SuggestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '公告');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="suggestion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
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
        ],
    ]);
    ?>

</div>