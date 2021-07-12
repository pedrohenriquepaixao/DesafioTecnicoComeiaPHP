<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Produtos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a('Cadastrar produto', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                'name',
                'quantity',
                'created_by',
                'updated_by',
                'created_at:date',
                'updated_at:date',
                [
                    'class' => 'yii\grid\ActionColumn'
                ],
            ],
        ]); ?>
    </div>
</div>
