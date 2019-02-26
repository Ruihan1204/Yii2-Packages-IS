<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\web\ForbiddenHttpException;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Paket */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="paket-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        if ($model->status_paket == 'Y' || $model->status_paket == 'Accepted'){
            throw new ForbiddenHttpException('We\'re sorry, you\'re not allowed to update packet that already ACCEPTED!');
        } else if ($aksi == 'create'){
//            echo ($form->field($model, 'tanggal_paket')->textInput(['type' => 'date']));
            echo ($form->field($model, 'tanggal_paket')->widget(\yii\jui\DatePicker::classname(), ['dateFormat' => 'php:d F y', 'options' => ['class' => 'form-control'], ]));
            echo ($form->field($model, 'jenis_paket')->textInput(['maxlength' => true]));
            echo ($form->field($model, 'tujuan_paket')->dropDownList(\backend\models\User::getAllUser()));
            echo ($form->field($model, 'pengirim_paket')->textInput(['maxlength' => true]));
            echo ($form->field($model, 'status_paket')->textInput(['maxlength' => true, 'type' => 'hidden' ,'value' => 'N'])->label(false));
            echo ($form->field($model, 'penerima_paket')->textInput(['type' => 'hidden' ,'value' => Yii::$app->user->id])->label(false));
        } else {
//            echo ($form->field($model, 'tanggal_paket')->textInput(["disabled" => "disabled", 'type' => 'date', ['options' => ['value' => $model->tanggal_paket]]]));
            echo ($form->field($model, 'tanggal_paket')->widget(\yii\jui\DatePicker::classname(), ['dateFormat' => 'php:d F y', 'options' => ['disabled' => 'disabled','class' => 'form-control']]));
            echo ($form->field($model, 'jenis_paket')->textInput(['readOnly' => true, 'maxlength' => true]));
//            echo ($form->field($model, 'tujuan_paket')->textInput(['readOnly' => true]));
            echo ($form->field($model, 'tujuan_paket')->dropDownList(\backend\models\User::getAllUser(), ['disabled' => 'disabled', ['options' => [$model->tujuan_paket => ['selected'=>true]]]]));
            echo ($form->field($model, 'pengirim_paket')->textInput(['readOnly' => true, 'maxlength' => true]));
            echo ($form->field($model, 'status_paket')->textInput(['maxlength' => true]));
        }
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
