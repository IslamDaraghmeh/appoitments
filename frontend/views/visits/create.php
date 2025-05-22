<?php
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Visits $model */
?>

<div class="visits-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

<?php
$script = <<<JS
$('form#{$model->formName()}').on('beforeSubmit', function(e){
    var form = $(this);
    let btn = form.find(':submit');
    btn.prop('disabled', true);

    $.post(form.attr('action'), form.serialize())
        .done(function(response){
            if(response === 'success'){
                $('#modal').modal('hide');

                Swal.fire({
                    icon: 'success',
                    title: 'تم الحفظ بنجاح',
                    showConfirmButton: false,
                    timer: 1500
                });

                $('#visitor-search').trigger('input');
            } else {
                $('#modalContent').html(response);
            }
        }).fail(function(){
            Swal.fire({
                icon: 'error',
                title: 'خطأ',
                text: 'حدث خلل أثناء إرسال البيانات',
            });
        }).always(function(){
            btn.prop('disabled', false);
        });

    return false;
});
JS;
$this->registerJs($script);
?>