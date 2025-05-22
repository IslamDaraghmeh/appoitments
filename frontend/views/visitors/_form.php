<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\Visitors $model */
/** @var yii\widgets\ActiveForm $form */
?>

<style>
    .visitors-form .form-control {
        border-radius: 6px;
        padding: 10px;
        font-size: 15px;
    }

    .visitors-form .form-group {
        margin-bottom: 20px;
    }

    .visitors-form label {
        font-weight: 500;
        color: #3c8dbc;
    }

    .visitors-form textarea.form-control {
        resize: vertical;
    }

    .visitors-form .btn-success {
        padding: 10px 24px;
        font-size: 16px;
        border-radius: 6px;
        font-weight: 600;
    }

    .modal-body {
        padding: 30px;
    }
</style>

<div class="visitors-form P-5">

    <?php $form = ActiveForm::begin([
        'id' => $model->formName()
    ]); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'identity_number')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'notes')->textarea(['rows' => 3]) ?>

    <div class="form-group text-end mt-4">
        <?= Html::submitButton('💾 حفظ', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>