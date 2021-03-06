<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">


    <?php $form = ActiveForm::begin([
            'validateOnType' => true
    ]); ?>

    <?= $form->field($model, 'username')->input('email') ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

    <?php $tokens = \yii\helpers\ArrayHelper::map($tokens, 'token', 'token'); ?>

    <?= $form->field($model, 'access_token')->dropDownList($tokens) ?>

    <br>
    <br>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'button big primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
