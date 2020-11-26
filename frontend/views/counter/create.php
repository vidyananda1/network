<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Counter */

// $this->title = 'Create Counter';
// $this->params['breadcrumbs'][] = ['label' => 'Counters', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="counter-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
