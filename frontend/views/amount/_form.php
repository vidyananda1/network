<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Amount */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="amount-form">
	
	<div class="raw">
		
		<div class="col-md-12">
			<p class="text-right">
        		<?= Html::a('Back', ['index'], ['class' => 'btn btn-danger']) ?>
    		</p>
			<div class="panel panel-primary" style="box-shadow: 4px 4px 7px #7682a3">
				<div class="panel-heading">
					<b> Create Amount Value</b>
				</div>
				<div class="panel-body">

			    <?php $form = ActiveForm::begin(); ?>

			    <?= $form->field($model, 'value')->textInput(['maxlength' => true])->label('Amount (in Rs)'); ?>

			    <div class="form-group text-center">
			        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
			    </div>

			    <?php ActiveForm::end(); ?>
			</div>
			</div>

    </div>
    
    </div>
</div>
