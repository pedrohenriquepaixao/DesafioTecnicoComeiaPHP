<?php

use common\models\Category;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'quantity')->input('number') ?>

        <?=
            // Tagging support Multiple
            
            $form->field($model, 'categories_multiples')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Category::find()->all(), 'id','title'),
                'pluginOptions' => [
                    'tags' => true,
                ],
                'options'=>[
                    'placeholder'=> 'Selecione',
                    'multiple' => true,
                ]
            ]);
        ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Cadastrar':'Atualizar', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
