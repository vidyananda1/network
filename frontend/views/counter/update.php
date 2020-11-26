<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Counter */

$this->title = 'Update Payment for: ' . $model->investor_name;
// $this->params['breadcrumbs'][] = ['label' => 'Counters', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="counter-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
