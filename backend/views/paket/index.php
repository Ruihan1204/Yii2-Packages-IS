<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PaketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'List Packet';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paket-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    $auth = Yii::$app->getAuthManager();
    $user_id = Yii::$app->user->id;
    $template_actions = '';

    if ($auth->checkAccess($user_id, 'delete_packet')) {
        $template_actions = '{view}{update}{delete}';
    } else if ($auth->checkAccess($user_id, 'update_recipient')){
        if ($auth->checkAccess($user_id, 'create_packet')){
            echo (
                '<p>'.
                Html::a('Create Paket', ['create'], ['class' => 'btn btn-success'])
                .'</p>'
            );
        }
        $template_actions = '{view}{update}';
    }
    ?>

    <?= GridView::widget(
    [
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_paket',
            [
                'attribute' => 'tanggal_paket',
                'value' => function($model){
                    return date('d F Y', strtotime($model->tanggal_paket));
                }
            ],
            [
                'attribute' => 'jenis_paket',
                'value' => function($model){
                    return ucfirst($model->jenis_paket);
                }
            ],
            [
                'attribute' => 'tujuan_paket',
                'value' => function($model){
                    return ucfirst(\backend\models\User::getUsernameByUserId($model->tujuan_paket));
                }
            ],
            'pengirim_paket',
            'status_paket',
            [
                'attribute' => 'penerima_paket',
                'value' => function($model){
                    return ucfirst(\backend\models\User::getUsernameByUserId($model->penerima_paket));
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => $template_actions,
                'buttons' => [
                    'view' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span> ', $url,
                            [
                                'title' => Yii::t('yii', 'View'),
                            ]
                        );
                    },
                    'update' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span> ', $url,
                            [
                                'title' => Yii::t('yii', 'Update'),
                            ]
                        );
                    },
                    'delete' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span> ', $url, [
                            'title' => Yii::t('yii', 'Delete'),
                        ]);
                    }
                ],
                'urlCreator' => function ($action, $model) {
                    if ($action === 'view') {
                        $url ='index.php?r=paket/view&id='.$model->id_paket;
                        return $url;
                    }

                    if ($action === 'update') {
                        $url ='index.php?r=paket/update&id='.$model->id_paket;
                        return $url;
                    }
                    if ($action === 'delete') {
                        $url ='index.php?r=paket/lead-delete&id='.$model->id_paket;
                        return $url;
                    }
                    return null;
                }
            ],
        ],
    ]); ?>
</div>
