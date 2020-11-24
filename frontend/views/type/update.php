<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Type */

$this->title = 'Update Referral-Type Name: ' . $model->type_name;
// $this->params['breadcrumbs'][] = ['label' => 'Types', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="type-update">

    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
