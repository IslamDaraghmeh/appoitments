<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/** @var yii\web\View $this */

$this->title = 'تغيير كلمة المرور';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .password-card {
        border-radius: 16px;
        max-width: 500px;
    }

    .form-control {
        border-radius: 12px;
        padding: 12px 15px;
    }

    .btn-primary {
        border-radius: 12px;
        font-weight: bold;
        padding: 10px 25px;
        background-color: #198754;
        border-color: #198754;
    }

    .btn-primary:hover {
        background-color: #157347;
        border-color: #157347;
    }
</style>

<div class="password-card">
    <h4 class="mb-4 text-center"><?= Html::encode($this->title) ?></h4>

    <?php $form = ActiveForm::begin(['id' => 'changepassowrd-form']); ?>

    <?= $form->field($user, 'new_password')->passwordInput(['placeholder' => 'كلمة المرور الجديدة', 'class' => 'form-control']) ?>
    <br>
    <?= $form->field($user, 'repeat_password')->passwordInput(['placeholder' => 'تأكيد كلمة المرور', 'class' => 'form-control']) ?>

    <div class=" mt-4">
        <?= Html::submitButton('حفظ', ['class' => 'btn btn-primary btn-lg', 'name' => 'contact-button']) ?>
    </div>

    <?php ActiveForm::end();

    ?>
</div>

<!-- تأكد أن SweetAlert موجود -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // منع التكرار
    $('#changepassowrd-form').off('submit').on('submit', function (e) {
        e.preventDefault();

        let form = $(this);
        let formData = form.serialize();

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'نجاح',
                        text: response.message,
                        confirmButtonText: 'موافق'
                    }).then(() => {
                        $('#modal').modal('hide');
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'خطأ',
                        text: response.message,
                        confirmButtonText: 'موافق'
                    });
                }
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'خطأ في الاتصال',
                    text: 'لم نتمكن من تنفيذ الطلب.',
                    confirmButtonText: 'موافق'
                });
            }
        });
    });
</script>