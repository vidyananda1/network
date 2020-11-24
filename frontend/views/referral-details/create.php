<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ReferralDetails */

$this->title = 'Create Referral Details';
$this->params['breadcrumbs'][] = ['label' => 'Referral Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="referral-details-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
