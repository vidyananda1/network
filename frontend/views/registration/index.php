<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use common\models\User;
use kartik\export\ExportMenu;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RegistrationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = 'Registrations';
// $this->params['breadcrumbs'][] = $this->title;
$user= ArrayHelper::map(User::find()->all(), 'id', 'username');
$status = ['REFERRAL'=>'REFERRAL','SELF'=>'SELF'];
?>
<br>
<div class="registration-index">

    <?php 
         $gridColumns = [
            //'investor_name',
                    //'member_code',
                        'member_code',
                        'investor_name',
                        'phone',
                        'address',
                        'aadhaar',
                        'date',
                        
                        'referral_status',
                        'referral_code',
                        'regis_amount',
                        'invest_amount',
                        'total',
                    [
                        'attribute'=>'created_by',
                        'value' => function ($model) use($user) {
                        return isset($model->created_by) ? $user[$model->created_by] : ' ';
                        },
                        'format' => 'raw',
                        'label' => 'User',
                        'filter' => '',

                    ],

    ];

            
    ?>
    
    <div class="panel panel-default" style="box-shadow: 4px 4px 7px grey">
        <div class=" panel-heading">
            <b class="text-muted" style="font-size: 17px"> Showing Account Registration Details</b>
            <p >
                <?php
                    echo ExportMenu::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => $gridColumns,
                    'exportConfig' => [
                        ExportMenu::FORMAT_PDF => false,
                        ExportMenu::FORMAT_HTML => false,
                        ExportMenu::FORMAT_TEXT => false,
                        //ExportMenu::FORMAT_EXCEL => false,
                    ],
                ])  
                ?>
            </p>
        </div>
            <div class="panel-body table-responsive">
            
                <p>
                    <?= Html::a('Add New Investor', ['create'], ['class' => 'btn new btn-primary text-muted']) ?>
                </p>

                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'tableOptions' => ['class' => 'table table-striped '],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        //'id',
                            //'date',
                        [
                            'attribute'=>'date',
                            //'value' =>'attribute_name',

                            'filter'=>DatePicker::widget([
                            'model' => $searchModel,
                            'attribute'=>'date',
                            'clientOptions' => [
                                'todayHighlight' => true,
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd'
                                ]
                            ])       
                        ],
                            'member_code',
                            'investor_name',
                            'phone',
                            //'address',
                            //'aadhaar',
                            
                            
                            //'referral_status',
                        [
                            'attribute'=>'referral_status',
                            'filter'=>$status,
                        ],
                            'referral_code',
                           

                            // [
                            //     'attribute'=>'regis_amount',
                            //     'filter'=>'',
                            // ],
                            // [
                            //     'attribute'=>'invest_amount',
                            //     'filter'=>'',
                            // ],
                            [
                                'attribute'=>'total',
                                'filter'=>'',
                            ],
                            
                            
                        [
                            'attribute'=>'created_by',
                            'value' => function ($model) use($user) {
                            return isset($model->created_by) ? $user[$model->created_by] : ' ';
                            },
                            'format' => 'raw',
                            'label' => 'User',
                            'filter' => '',

                        ],
                        //'created_by',
                        //'created_date',
                        //'updated_by',
                        //'updated_date',
                        //'record_status',
                        [
                            'value' => function ($model) {
                              return Html::a('Print', ['registration/print', 'id' => $model->id], ['class' => 'btn btn-sm btn-success ','target'=>'_blank']);  
                                        },
                                        'format' => 'raw',
                        ],
                        [
                            'value' => function ($model) {
                              return Html::a('update', ['registration/update', 'id' => $model->id], ['class' => 'btn btn-sm btn-warning ']);  
                                        },
                                        'format' => 'raw',
                        ],
                        // [
                        //     'value' => function ($model) {
                        //       return Html::a('Delete', ['registration/delete', 'id' => $model->id], ['class' => 'btn btn-sm btn-danger ','data-confirm'=>'CONFIRM APPLY?']);  
                        //                 },
                        //                 'format' => 'raw',
                        // ],

                       
                    ],
                ]); ?>
            </div>
    </div>
</div>
<style type="text/css">
    .new{
        box-shadow: 1px 2px 3px #cfd4d3;
    }
</style>

