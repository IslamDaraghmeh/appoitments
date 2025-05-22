<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'اضافة مستخدم جديد';
?>

<style>

</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="form-section">
            <h1><?= Html::encode($this->title) ?></h1>
            <p>قم بتعبئة الحقول التالية لإضافة مستخدم جديد</p>

            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <div class="row g-3">
                <div class="col-12">
                    <?= $form->field($model, 'full_name')->textInput(['class' => 'form-control', 'PLACEHOLDER' => 'ادخل الاسم بالكامل  ']) ?>
                </div>
                <div class="col-12">
                    <?= $form->field($model, 'username')->textInput(['class' => 'form-control', 'autofocus' => true, 'PLACEHOLDER' => 'ادخل اسم السمتخدم   ']) ?>
                </div>
                <div class="col-12">
                    <?= $form->field($model, 'role')->dropDownList([
                        'ROLE_ADMIN' => 'مسؤول النظام',
                        'ROLE_USER' => 'مستخدم',
                    ], ['prompt' => 'اختر الدور', 'class' => 'form-select']) ?>
                </div>
                <div class="col-12">
                    <?= $form->field($model, 'mobile')->textInput(['class' => 'form-control']) ?>
                </div>
                <div class="col-12">
                    <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control']) ?>
                </div>
            </div>

            <div class="form-group text-end mt-4">
                <?= Html::submitButton('💾 حفظ', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>