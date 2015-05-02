<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SuggestionSearche */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '管理提议');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="suggestion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', '创建一个提议'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'title',
            'content:ntext',
//            'submitter',
            'status',
             'up',
             'down',
            // 'part:ntext',
//             'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
