<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'role')->dropDownList([
        'ROLE_ADMIN' => 'مشرف',
        'ROLE_USER' => 'مستخدم',
    ], ['prompt' => 'اختر الصلاحية']) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>


    <div class="form-group mt-3 text-end">
        <?= Html::submitButton('💾 حفظ', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>