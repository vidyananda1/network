<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "registration".
 *
 * @property int $id
 * @property string $investor_name
 * @property string $phone
 * @property string $address
 * @property string $aadhaar
 * @property string $date
 * @property string $member_code
 * @property int $referral_status
 * @property string|null $referral_code
 * @property float|null $regis_amount
 * @property float $invest_amount
 * @property float $total
 * @property int $created_by
 * @property string $created_date
 * @property int|null $updated_by
 * @property string|null $updated_date
 * @property string $record_status
 */
class Registration extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'registration';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['investor_name', 'phone', 'address', 'aadhaar', 'date', 'member_code', 'referral_status', 'invest_amount', 'total', 'created_by'], 'required'],
            [['date', 'created_date', 'updated_date'], 'safe'],
            [[ 'created_by', 'updated_by'], 'integer'],
            [['regis_amount', 'invest_amount', 'total'], 'number'],
            [['referral_status','investor_name', 'address', 'member_code', 'referral_code'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 10],
            [['aadhaar'], 'string', 'max' => 200],
            [['record_status'], 'string', 'max' => 1],
        ];
    }

    public function send_msg($phone, $msg) {
        $api_key = '55F3702FF650D8';
        $contacts = $phone;
        $from = 'SOFTEC';
        $sms_text = urlencode($msg);

//Submit to server

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, "http://sms.hadrontechs.com/app/smsapi/index.php");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "key=".$api_key."&campaign=0&routeid=13&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text);
        $response = curl_exec($ch);
        curl_close($ch);
        //echo $response;
        //print_r($otp_data);die;
        //echo $otp_data;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'investor_name' => 'Investor Name',
            'phone' => 'Phone',
            'address' => 'Address',
            'aadhaar' => 'Aadhaar',
            'date' => 'Date',
            'member_code' => 'Member Code',
            'referral_status' => 'Referral Status',
            'referral_code' => 'Referral Code',
            'regis_amount' => 'Regis Amount',
            'invest_amount' => 'Invest Amount',
            'total' => 'Total',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'updated_by' => 'Updated By',
            'updated_date' => 'Updated Date',
            'record_status' => 'Record Status',
        ];
    }
}
