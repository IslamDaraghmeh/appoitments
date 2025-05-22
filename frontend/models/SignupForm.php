<?php

namespace frontend\models;

use PhpParser\Node\Stmt\Echo_;
use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $role;
    public $mobile;
    public $full_name;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],


            ['mobile', 'required'],
            ['role', 'required'],
            ['full_name', 'required'],
            ['role', 'in', 'range' => ['ROLE_USER', 'ROLE_ADMIN']],

            ['role', 'string', 'max' => 255],

            ['role', 'string', 'max' => 255],



            ['password', 'trim'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'اسم المستخدم',
            'full_name' => 'الاسم الكامل',
            'mobile' => 'رقم الجوال',
            'email' => 'البريد الالكتروني',
            'password' => 'كلمة المرور',
            'role' => 'الصلاحيات',
            'status' => 'الحالة',
            'created_at' => 'تاريخ الانشاء',
            'updated_at' => 'تاريخ التعديل',

        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return "0";
        }

        $user = new User();
        $user->username = $this->username;
        $user->status = User::STATUS_ACTIVE;
        $user->role = $this->role;
        $user->mobile = $this->mobile;
        $user->full_name = $this->full_name;

        $user->setPassword($this->password);
        $user->generateAuthKey();
        //$user->generateEmailVerificationToken()

        if (!$user->save()) {
            return false;
        }

        return $user->save();
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
