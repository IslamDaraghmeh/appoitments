<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class ResetPassword extends Model
{
    public $new_password;
    public $repeat_password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['new_password', 'repeat_password'], 'required'],
            [['old_password', 'new_password', 'repeat_password'], 'string', 'min' => 3],
            [['old_password'], 'validateCurrentPassword'],
            [['new_password', 'repeat_password'], 'filter', 'filter' => 'trim'],
            [['repeat_password'], 'compare', 'compareAttribute' => 'new_password', 'message' => 'كلمة المرور غير متطابقة'],
        ];
    }


    public function validateCurrentPassword()
    {
        $user = new User();
        if ($user->verifyPassword($this->old_password)) {
            $this->addError("old_password", "Old password incorrect");
        }
    }



    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'new_password' => 'كلمة المرور الجديدة',
            'repeat_password' => 'تأكيد كلمة المرور',
        ];
    }

}
