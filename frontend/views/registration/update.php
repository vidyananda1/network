<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Registration */

$this->title = 'Update Registration Details For : ' . $model->investor_name;
// $this->params['breadcrumbs'][] = ['label' => 'Registrations', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="registration-update">

   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
