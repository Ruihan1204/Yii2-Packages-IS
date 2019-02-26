<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PaketSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="paket-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_paket') ?>

    <?= $form->field($model, 'tanggal_paket') ?>

    <?= $form->field($model, 'jenis_paket') ?>

    <?= $form->field($model, 'tujuan_paket') ?>

    <?= $form->field($model, 'pengirim_paket') ?>

    <?php // echo $form->field($model, 'status_paket') ?>

    <?php // echo $form->field($model, 'penerima_paket') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
