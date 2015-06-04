<?php
/* @var $this yii\web\View */
use yii\helpers\Html;

$this->title = '网络提议平台';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>管理后台</h1>

        <p class="lead">通过提议平台能够更好地认识学生1</p>

        <p><?= Html::a('管理公告', ['post/index'], ['class' => 'btn btn-lg btn-success']) ?></p>

        <p><?= Html::a('管理用户', ['user/index'], ['class' => 'btn btn-lg btn-success']) ?></p>

        <p><?= Html::a('管理建议', ['suggestion/index'], ['class' => 'btn btn-lg btn-success']) ?></p>
    </div>

</div>
