<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Paket */

$this->title = 'Paket: '.$model->jenis_paket;
$this->params['breadcrumbs'][] = ['label' => 'Pakets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paket-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $auth = Yii::$app->getAuthManager();
    $user_id = Yii::$app->user->id;

    if ($auth->checkAccess($user_id, 'update_recipient')) {
        echo (
            '<p>'. Html::a('Update', ['update', 'id' => $model->id_paket], ['class' => 'btn btn-primary']).'</p>'
        );
        if ($auth->checkAccess($user_id, 'delete_packet')){
            echo (
                '<p>'.
                Html::a('Delete', ['delete', 'id' => $model->id_paket], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ])
                .'</p>'
            );
        }
    }
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_paket',
            ['attribute' => 'tanggal_paket', 'value' => date('d F Y', strtotime($model->tanggal_paket))],
            'jenis_paket',
            ['attribute' => 'tujuan_paket', 'value' => ucfirst(\backend\models\User::getUsernameByUserId($model->tujuan_paket))],
            'pengirim_paket',
            'status_paket',
            ['attribute' => 'penerima_paket', 'value' => ucfirst(\backend\models\User::getUsernameByUserId($model->penerima_paket))],
        ],
    ]) ?>

</div>
