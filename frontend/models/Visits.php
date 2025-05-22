<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "visits".
 *
 * @property int $id
 * @property string $visit_date
 * @property string $visit_time
 * @property string $title
 * @property string|null $purpose
 * @property string|null $notes
 * @property string $created_at
 * @property string $updated_at
 * @property string $status
 *
 * @property Visitors $visitor
 */
class Visits extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'visits';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['purpose', 'notes'], 'default', 'value' => null],
            [['visit_date', 'visit_time'], 'required'],
            [['visit_date', 'visit_time', 'created_at', 'updated_at'], 'safe'],
            [['purpose', 'notes', 'status', 'title'], 'string'],
            [['attachment_path'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'title' => 'عنوان الموعد',
            'visit_date' => 'تاريخ الموعد ',
            'visit_time' => 'وقت الموعد',
            'purpose' => 'الهدف من الزيارة',
            'notes' => 'ملاحظات',
            'created_at' => 'تاريخ الانشاء',
            'updated_at' => 'تاريخ التعديل',
            'status' => 'الحالة',
            'attachment_path' => ' المرفقات'
        ];
    }



}
