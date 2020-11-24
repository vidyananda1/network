<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Amount */

 $this->title = 'Update Amount: ' .'Rs'.' '.$model->value;
// $this->params['breadcrumbs'][] = ['label' => 'Amounts', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="amount-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
