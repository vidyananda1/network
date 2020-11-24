<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "referral_details".
 *
 * @property int $id
 * @property int $registration_id
 * @property string $referred_by
 * @property string $referral_code
 * @property string $investor_name
 * @property string $investor_member_code
 * @property int $created_by
 * @property string $created_date
 * @property string $record_status
 */
class ReferralDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'referral_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['registration_id', 'referred_by', 'referral_code', 'investor_name', 'investor_member_code', 'created_by'], 'required'],
            [['registration_id', 'created_by'], 'integer'],
            [['created_date'], 'safe'],
            [['referred_by', 'referral_code', 'investor_name', 'investor_member_code'], 'string', 'max' => 255],
            [['record_status'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'registration_id' => 'Registration ID',
            'referred_by' => 'Referred By',
            'referral_code' => 'Referral Code',
            'investor_name' => 'Investor Name',
            'investor_member_code' => 'Investor Member Code',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'record_status' => 'Record Status',
        ];
    }
}
