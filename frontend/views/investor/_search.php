<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CounterSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="counter-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="form-container">
            <?= $form->field($model, 'member_code')->textInput(["placeholder"=>"Search by member code"]) ?>
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary','id'=>'search']) ?>
            <?= Html::a('Reset',['index'], ['class' => 'btn btn-success']) ?>
    </div>

    
    <?php ActiveForm::end(); ?>

</div>
<style>
    .form-container{
        display: grid;
       grid-template-columns:.3fr .02fr .02fr;
       grid-gap: 20px;
       align-items: center;
    }
</style>