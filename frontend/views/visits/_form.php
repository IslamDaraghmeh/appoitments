<?php

use frontend\models\VisitsStatus;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

// تحميل أسماء المراجعين
$status = VisitsStatus::find()->select(['name', 'name'])->indexBy('name')->column();
?>
<style>
    .visits-form {
        background-color: #f9fafd;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    }

    .visits-form .form-control {
        border-radius: 8px;
        padding: 12px;
        font-size: 15px;
        border: 1px solid #ced4da;
        transition: all 0.2s ease-in-out;
    }

    .visits-form .form-control:focus {
        border-color: #3c8dbc;
        box-shadow: 0 0 0 0.15rem rgba(60, 141, 188, 0.25);
    }

    .visits-form .form-group {
        margin-bottom: 20px;
    }

    .visits-form label {
        font-weight: 600;
        color: #3c8dbc;
        margin-bottom: 6px;
    }

    .visits-form textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    .visits-form .btn-success {
        padding: 10px 28px;
        font-size: 16px;
        border-radius: 8px;
        font-weight: 600;
        background-color: #3c8dbc;
        border-color: #3c8dbc;
    }

    .visits-form .btn-success:hover {
        background-color: #327ba3;
        border-color: #327ba3;
    }

    .visits-form .form-text {
        font-size: 13px;
        color: #6c757d;
    }

    .form-row {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .form-row .col {
        flex: 1;
    }
</style>

<div class="visits-form">
    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['placeholder' => 'مثال: زيارة متابعة']) ?>

    <div class="form-row mb-3">
        <div class="col">
            <?= $form->field($model, 'visit_date')->input('date') ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'visit_time')->input('time') ?>
        </div>
    </div>

    <?= $form->field($model, 'purpose')->textarea(['rows' => 3, 'placeholder' => 'اذكر الهدف من الزيارة']) ?>
    <?= $form->field($model, 'notes')->textarea(['rows' => 3, 'placeholder' => 'ملاحظات إضافية']) ?>

    <?= $form->field($model, 'status')->dropDownList($status, [
        'prompt' => 'اختر الحالة',
        'options' => [
            $model->status => ['selected' => true]
        ]
    ]) ?>

    <div class="mb-3">
        <label class="form-label fw-bold text-primary">📎 إرفاق ملف</label>
        <?= $form->field($model, 'attachment_path', ['template' => '{input}{error}'])->fileInput([
            'class' => 'form-control',
            'accept' => '.pdf,.doc,.docx,.jpg,.jpeg,.png'
        ]) ?>
        <div class="form-text">
            الملفات المسموحة: PDF, DOC, DOCX, JPG, PNG
        </div>
    </div>

    <div class="form-group text-end mt-4">
        <?= Html::submitButton('💾 حفظ', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>