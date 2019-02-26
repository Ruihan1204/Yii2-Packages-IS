<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Paket */

$this->title = 'Update Paket: ' . $model->jenis_paket;
$this->params['breadcrumbs'][] = ['label' => 'Pakets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_paket, 'url' => ['view', 'id' => $model->id_paket]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="paket-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'aksi' => $aksi
    ]) ?>

</div>
