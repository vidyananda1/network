<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = 'Members';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-index">
    <div class="panel panel-default"  style="box-shadow: 4px 4px 7px grey">
        <div class="panel-heading">
            <b class="text-muted">Showing User Details</b>
        </div>
            <div class="panel-body"  >

                    

                    <p>
                        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-primary']) ?>
                    </p>

                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'tableOptions' => ['class' => 'table table-striped '],
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            //'id',
                            'mem_name',
                            'address',
                            'phone',
                            [
                                'value'=>function($model) {
                                    $user = User::find()->where(['id'=>$model->user_id])->one();
                                    return $user->username;
                                }   
                            ],
                            //'user_id',
                            //'created_by',
                            //'created_date',
                            //'updated_by',
                            //'updated_date',
                            //'record_status',

                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{update} {delete} {view}',
                                'buttons' => [
                                    'view' => function($id,$model){
                                        return Html::a("<span class='glyphicon glyphicon-repeat'> </span>", 
                                        ["member/reset-password","id"=>$model->user_id],["data"=>  ["confirm"=>"Corfirmation,are you sure you want to reset password?","meth"],'title'=>'Reset Password']);

                                    }
                                ]
                            ],
                        ],
                    ]); ?>
            </div>
    </div>

</div>
