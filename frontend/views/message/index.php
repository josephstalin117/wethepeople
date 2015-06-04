<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Posts */

$this->title = "私信";
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '私信'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="posts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', '发送私信'), ['send'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $provider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'reciveUser.realname',
//            'sendUser.realname',
            [
                'attribute'=>'sendUser.realname',
                'label'=>'发送者',
            ],
            [
                'attribute'=>'reciveUser.realname',
                'label'=>'接受者',
            ],
            'content',
            [
                'attribute' => 'created_at',
                'format' => 'date',
            ],
        ],
    ]);
    ?>

</div>