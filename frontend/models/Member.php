<?php

namespace app\models;

use Yii;
use common\models\User;
/**
 * This is the model class for table "member".
 *
 * @property int $id
 * @property string $mem_name
 * @property string $address
 * @property string $phone
 * @property int $user_id
 * @property int $created_by
 * @property string $created_date
 * @property int|null $updated_by
 * @property string|null $updated_date
 * @property string $record_status
 */
class Member extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'member';
    }

    /**
     * {@inheritdoc}
     */
    public $name,$username,$password;
    public function rules()
    {
        return [
            [['mem_name', 'address', 'phone','password'], 'required'],
            [['user_id', 'created_by', 'updated_by'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['mem_name', 'address'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 10],
            [['record_status'], 'string', 'max' => 1],
            [['username','password','name'],'string','max'=>255],
            [['username'],'unique', 'targetClass'=>'\common\models\User','message'=>"The user name has already been taken"]
        ];
    }

    


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mem_name' => 'Member Name',
            'address' => 'Address',
            'phone' => 'Phone',
            'user_id' => 'User ID',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'updated_by' => 'Updated By',
            'updated_date' => 'Updated Date',
            'record_status' => 'Record Status',
            'username'=> "User Name"
        ];
    }

    public function signup()
    {
       
        $user = new User();
        $rand_id = rand(10,1000);
        if(!User::findOne($rand_id))
            $user->id = $rand_id;
        $user->username = $this->username;

        // $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        // $user->generateEmailVerificationToken();
        if($user->save())
            return  $user->id;
        else {
            print_r($user->errors);
            die;
        }
        return 0;

    }
}
