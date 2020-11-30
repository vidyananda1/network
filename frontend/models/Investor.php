<?php

namespace app\models;

use Yii;

class Investor extends Model {
    public $investor_name,$member_code;
    public function rules()
    {
        return[
            [['investor_name','member_code'],'string'],
        ];
    }
    public function attributeLabels()
    {
        return[
            'investor_name' => 'Name',
            'member_code' => 'Member code'
        ];
    }
}