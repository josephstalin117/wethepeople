<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SuggestionSearche */
/* @var $form yii\widgets\ActiveForm */
?>

<tr data-id="<?= $model->id; ?>">
    <td> <?= $model->user->username; ?> </td>
    <td> <?= $model->user->realname; ?> </td>
    <td> <?= $model->content; ?> </td>
    <td> <?= Yii::$app->formatter->asDate($model->created_at); ?> </td>
</tr>
