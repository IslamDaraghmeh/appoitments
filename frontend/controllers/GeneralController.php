<?php
namespace frontend\controllers;

use common\models\User;
use yii\web\Controller;
use yii\base\Model;

class GeneralController extends Model
{



    /**
     * @inheritDoc
     */

    public function actionGetRole($id)
    {
        $user = User::findOne($id);
        if ($user) {
            return $user->role;
        }
        return null;
    }
















}





?>