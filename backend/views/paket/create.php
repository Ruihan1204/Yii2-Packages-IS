<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Paket */

$this->title = 'Create Paket';
$this->params['breadcrumbs'][] = ['label' => 'Pakets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paket-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'aksi' => $aksi
    ]) ?>

</div>
