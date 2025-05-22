<?php

use frontend\models\VisitsStatus;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'سجل الزيارات';
$statusList = VisitsStatus::find()->select(['name', 'name'])->indexBy('name')->column();

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
        text-align: center;
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
    <h1 class="text-center">سجل الزيارات</h1>

    <div class="d-flex justify-content-end mb-3">
        <?= Html::button('إضافة زيارة جديدة', [
            'value' => Url::to(['create']),
            'title' => 'إضافة زيارة جديدة',
            'class' => 'btn btn-success showModalButton',
        ]) ?>


    </div>
    <div class="row mb-3 justify-content-center align-items-end gx-2">
        <div class="col-md-3">
            <label for="visit-date-filter" class="form-label" style="font-size: 12px;">تاريخ الموعد</label>
            <input type="date" id="visit-date-filter" class="form-control text-center"
                style="font-size: 13px; padding: 6px 10px;"
                value="<?= Html::encode(Yii::$app->request->get('date', date('Y-m-d'))) ?>">
        </div>
        <div class="col-md-3">
            <label for="status" class="form-label" style="font-size: 12px;">حالة الموعد</label>
            <?= Html::dropDownList('status', Yii::$app->request->get('status'), $statusList, [
                'prompt' => 'اختر حالة الموعد',
                'class' => 'form-control text-center',
                'id' => 'status-filter',
                'style' => 'font-size:13px; padding:6px 10px;'
            ]) ?>
        </div>
    </div>



    <div class="table-responsive">
        <table class="table table-hover align-middle text-center" id="visitors-table">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>العنوان</th>
                    <th>تاريخ الزيارة</th>
                    <th>وقت الزيارة</th>
                    <th>الهدف من الزيارة</th>
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody id="visitors-table-body">
                <?php foreach ($dataProvider->getModels() as $index => $model): ?>
                    <?php
                    $isToday = $model->visit_date === date('Y-m-d');
                    $rowClass = $isToday ? 'table-warning' : '';
                    ?>
                    <tr class="<?= $rowClass ?>">

                        <td><?= $dataProvider->pagination->offset + $index + 1 ?></td>
                        <td><?= Html::encode($model->title) ?></td>
                        <td><?= Html::encode($model->visit_date) ?></td>
                        <td><?= Html::encode($model->visit_time) ?></td>
                        <td><?= Html::encode($model->purpose) ?></td>
                        <td>
                            <?php
                            $status = $model->status;
                            $badgeClass = 'secondary';

                            if ($status === 'موعد جديد') {
                                $badgeClass = 'info';
                            } elseif ($status === 'قيد المراجعة') {
                                $badgeClass = 'warning';
                            } elseif ($status === 'تم') {
                                $badgeClass = 'success';
                            }
                            ?>
                            <span class="badge bg-<?= $badgeClass ?>">
                                <?= Html::encode($status) ?>
                            </span>
                        </td>

                        <td>
                            <div class="dropdown">
                                <button class="btn btn-sm" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">⋮</button>
                                <ul class="dropdown-menu text-end shadow-sm">
                                    <li><?= Html::button('عرض', [
                                        'value' => Url::to(['view', 'id' => $model->id]),
                                        'class' => 'dropdown-item showModalButton',
                                    ]) ?></li>
                                    <li><?= Html::button('تعديل', [
                                        'value' => Url::to(['update', 'id' => $model->id]),
                                        'class' => 'dropdown-item showModalButton',
                                    ]) ?></li>
                                    <li><?= Html::a('حذف', ['delete', 'id' => $model->id], [
                                        'class' => 'dropdown-item text-danger',
                                        'data' => [
                                            'confirm' => 'هل أنت متأكد من الحذف؟',
                                            'method' => 'post',
                                        ],
                                    ]) ?></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="text-center mt-4">
            <?= LinkPager::widget([
                'pagination' => $dataProvider->pagination,
                'options' => ['class' => 'pagination rtl-pagination justify-content-center'],
                'linkOptions' => ['class' => 'page-link'],
                'prevPageLabel' => 'السابق',
                'nextPageLabel' => 'التالي',
                'disabledPageCssClass' => 'page-item disabled',
                'activePageCssClass' => 'active',
                'maxButtonCount' => 7,
            ]) ?>
            <div class="text-muted small mt-2">
                عرض <?= $dataProvider->getCount() ?> من أصل <?= $dataProvider->getTotalCount() ?> نتيجة
            </div>
        </div>
    </div>
</div>
<?php
$script = <<<JS
let visitTimer = null;

function fetchFilteredVisits() {
    clearTimeout(visitTimer);
    let date = $('#visit-date-filter').val();
    let statusId = $('#status-filter').val();

    visitTimer = setTimeout(function () {
        $.ajax({
            url: window.location.pathname,
            type: 'GET',
            data: {
                date: date,
                status: statusId
            },
            success: function (response) {
                const newBody = $('<div>').html(response).find('#visitors-table-body').html();
                const newPagination = $('<div>').html(response).find('.pagination').parent().html();

                $('#visitors-table-body').html(newBody);
                $('.pagination').parent().html(newPagination);
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'خطأ',
                    text: 'فشل في تحميل نتائج الفلترة.',
                });
            }
        });
    }, 300);
}

$(document).on('input change', '#visit-date-filter, #status-filter', fetchFilteredVisits);

JS;

$this->registerJs($script);
?>