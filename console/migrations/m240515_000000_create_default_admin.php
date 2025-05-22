<?php

use yii\db\Migration;
use common\models\User;

/**
 * Class m240515_000000_create_default_admin
 */
class m240515_000000_create_default_admin extends Migration
{
    public function safeUp()
    {
        if (!User::find()->where(['username' => 'admin'])->exists()) {
            $user = new User();
            $user->full_name = 'د.وائل الشيخ';
            $user->username = 'admin';
            $user->mobile = '0599123456';
            $user->email = 'admin@example.com';
            $user->setPassword('123456789');
            $user->generateAuthKey();
            $user->generateEmailVerificationToken();
            $user->status = User::STATUS_ACTIVE;

            if ($user->save()) {
                echo "✅ Admin user created successfully.\n";
            } else {
                echo "❌ Failed to create admin user:\n";
                print_r($user->getErrors());
            }
        } else {
            echo "ℹ️ Admin user already exists.\n";
        }
    }

    public function safeDown()
    {
        User::deleteAll(['username' => 'admin']);
        echo "⛔ Admin user deleted.\n";
    }
}
