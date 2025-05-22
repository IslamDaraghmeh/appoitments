<?php
use yii\helpers\Html;
use yii\helpers\Url;
/** @var yii\web\View $this */

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'سجل المراجعين';
?>

<style>
    .pagination {
        direction: rtl;
        justify-content: center;
        padding: 15px;
        gap: 8px;
        margin-block-start: 20px;
    }

    .pagination li {
        display: inline-block;
    }

    .pagination .page-link {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        color: #3c8dbc;
        background-color: #fff;
        padding: 8px 20px;
        font-weight: 500;
        font-size: 15px;
        min-inline-size: 100px;
        text-align: center;
        transition: all 0.2s ease-in-out;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .pagination .page-link:hover {
        background-color: #eaf6ff;
        border-color: #3c8dbc;
        color: #3c8dbc;
    }

    .pagination .active .page-link {
        background-color: #3c8dbc;
        color: white;
        border-color: #3c8dbc;
    }

    .pagination .disabled .page-link {
        background-color: #f0f0f0;
        border-color: #ccc;
        color: #999;
        pointer-events: none;
        font-weight: normal;
    }

    .visitors-index {
        background-color: #fff;
        padding: 30px;
        border-radius: 12px;
    }

    .visitors-index h1 {
        font-size: 1.8rem;
        font-weight: bold;
        margin-block-end: 20px;
        color: #3c8dbc;
    }

    .visitors-index .btn-success {
        background-color: #00a65a;
        border-color: #008d4c;
        font-weight: 500;
        padding: 8px 16px;
        border-radius: 6px;
    }

    .table thead th {
        background-color: #3c8dbc;
        color: #fff;
        text-align: center;
        vertical-align: middle;
    }

    .table td,
    .table th {
        vertical-align: middle;
        text-align: center;
    }

    .action-buttons a {
        margin: 0 3px;
    }

    @media (max-inline-size: 768px) {
        .visitors-index {
            padding: 20px 15px;
        }

        .visitors-index h1 {
            font-size: 1.5rem;
        }

        .table-responsive {
            overflow-x: auto;
        }
    }



    .table-responsive {
        position: relative;
        overflow: visible !important;
    }

    .dropdown-menu {
        z-index: 9999;
        position: absolute;
    }
</style>
<div class="visitors-index">
    <h1 class="text-center">سجل المراجعين</h1>

    <div class="d-flex justify-content-end mb-3">
        <?= Html::button('إضافة مراجع جديد', [
            'value' => Url::to(['create']),
            'title' => 'إضافة مراجع جديد',
            'class' => 'btn btn-success showModalButton',
        ]) ?>
    </div>

    <div class="row mb-4">
        <div class="col-md-6 offset-md-3">
            <input type="text" id="visitor-search" class="form-control form-control-lg text-center"
                placeholder="ابحث بالاسم، رقم الهوية أو رقم الهاتف...">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle text-center" id="visitors-table">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>الاسم الكامل</th>
                    <th>رقم الهوية</th>
                    <th>الهاتف</th>
                    <th>البريد الإلكتروني</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody id="visitors-table-body">
                <?= $this->render('_grid', ['dataProvider' => $dataProvider]) ?>
            </tbody>
        </table>
    </div>

</div>
<?php
$script = <<<JS
let timer = null;
$('#visitor-search').on('input', function () {
    clearTimeout(timer);
    let q = $(this).val();

    timer = setTimeout(function () {
        $.ajax({
            url: window.location.pathname + '?q=' + encodeURIComponent(q),
            type: 'GET',
            success: function(response) {
                $('#visitors-table-body').html(response);
            },
            error: function() {
                alert('حدث خطأ أثناء تحميل النتائج.');
            }
        });
    }, 400); 
});
JS;
$this->registerJs($script);
?>