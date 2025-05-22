<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'تسجيل الدخول';
?>

<style>
    body {
        background: #e8f6f9;
        font-family: 'Cairo', sans-serif;
    }

    .main-card {
        width: 100%;
        max-width: 1000px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .left-section {
        background-color: #ffffff;
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .right-section {
        background-color: #f4fbff;
        padding: 40px;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .right-section h3 {
        color: rgb(18, 72, 153);
        margin-bottom: 20px;
    }

    .right-section h1 {
        color: #c09300;
        margin-bottom: 20px;
    }

    .form-control {
        border-radius: 12px;
        padding: 14px;
    }

    .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
    }

    .login-logo {
        width: 100px;
        margin: 0 auto 20px;
    }

    @media (max-width: 767px) {
        .main-card {
            flex-direction: column;
        }

        .left-section,
        .right-section {
            width: 100%;
        }
    }
</style>

<div class="d-flex justify-content-center align-items-center min-vh-100 px-3">
    <div class="d-flex flex-md-row flex-column main-card bg-white">
        <!-- Right (Greeting) -->
        <div class="col-md-6 right-section  justify-content-center align-items-center">
            <h3>مرحبًا بك في نظام إدارة مواعيد عطوفة وكيل وزارة الصحة<br>
            </h3>
            <h1 class="fw-bold"> د. وائل الشيخ</h1>

            <img src="/img/dr_wael.jpg" alt="logo" class="img-fluid mb-4"
                style="border-radius: 50%; width: 300px; height: 300px;">

        </div>

        <!-- Left (Login Form) -->
        <div class="col-md-6 left-section">
            <div class="text-center mb-4">
                <img src="/img/login-cover.png" alt="شعار" class="login-logo  ">

                <p class="text-muted">يرجى تسجيل الدخول للمتابعة</p>
            </div>

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'username')
                ->textInput([
                    'autofocus' => true,
                    'placeholder' => 'اسم المستخدم',
                    'class' => 'form-control form-control-lg'
                ])
                ->label(false) ?>

            <?= $form->field($model, 'password')
                ->passwordInput([
                    'placeholder' => 'كلمة المرور',
                    'class' => 'form-control form-control-lg'
                ])
                ->label(false) ?>

            <div class="d-grid mt-4">
                <?= Html::submitButton('تسجيل الدخول', ['class' => 'btn btn-primary btn-lg fw-bold']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>