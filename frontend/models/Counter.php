<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "counter".
 *
 * @property int $id
 * @property string $investor_name
 * @property int $member_code
 * @property string $date_of_payment
 * @property float $rate_of_interest
 * @property string $invested_amount
 * @property float $paid_amount
 * @property string $status
 * @property int $created_by
 * @property string $created_date
 * @property int|null $updated_by
 * @property string|null $updated_date
 * @property string $record_status
 */
class Counter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'counter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['investor_name', 'member_code', 'date_of_payment', 'rate_of_interest', 'invested_amount', 'paid_amount', 'status', 'created_by'], 'required'],
            [['member_code', 'created_by', 'updated_by'], 'integer'],
            [['date_of_payment', 'created_date', 'updated_date'], 'safe'],
            [['rate_of_interest', 'paid_amount'], 'number'],
            [['status'], 'string'],
            [['investor_name', 'invested_amount'], 'string', 'max' => 255],
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
            'investor_name' => 'Investor Name',
            'member_code' => 'Member Code',
            'date_of_payment' => 'Date Of Payment',
            'rate_of_interest' => 'Rate Of Interest',
            'invested_amount' => 'Invested Amount',
            'paid_amount' => 'Paid Amount',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'updated_by' => 'Updated By',
            'updated_date' => 'Updated Date',
            'record_status' => 'Record Status',
        ];
    }
}
