<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Member */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="member-form">
    <p class="text-right">
        <?= Html::a('Back', ['index'], ['class' => 'btn btn-danger']) ?>
    </p>
    <div class="panel " style="box-shadow: 4px 4px 7px #7682a3">
        <div class="panel-heading" style="text-align: center">
            <b class="text-muted">Create User</b>
        </div>
            <div class="panel-body" style="background-color: #f2f4f5">

                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'mem_name')->textInput(['maxlength' => true])->label('User Name') ?>

                <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

                

                <div class="form-group text-center">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
    </div>
</div>
