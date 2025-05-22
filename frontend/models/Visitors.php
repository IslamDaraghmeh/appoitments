<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "visitors".
 *
 * @property int $id
 * @property string $full_name
 * @property string|null $identity_number
 * @property string|null $phone
 * @property string|null $email
 * @property string $position
 * @property string|null $notes
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Visitors extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'visitors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_name'], 'required', 'message' => 'الاسم الكامل مطلوب.'],
            [['position'], 'required', 'message' => 'الوظيفة مطلوبة.'],
            [['identity_number'], 'match', 'pattern' => '/^\d{9}$/', 'message' => 'رقم الهوية يجب أن يتكون من 9 أرقام.'],
            [['phone'], 'match', 'pattern' => '/^\d{10}$/', 'message' => 'رقم الهاتف يجب أن يتكون من 10 أرقام.'],
        ];
    }



    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'المعرف',
            'full_name' => 'الاسم الكامل',
            'identity_number' => 'رقم الهوية',
            'phone' => 'رقم الهاتف',
            'email' => 'البريد الإلكتروني',
            'position' => 'الوظيفة',
            'notes' => 'ملاحظات',
            'created_at' => 'تاريخ الإنشاء',
            'updated_at' => 'آخر تعديل',
        ];
    }


}
