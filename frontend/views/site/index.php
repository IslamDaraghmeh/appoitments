<?php

use frontend\models\Visitors;
use frontend\models\Visits;
use yii\bootstrap5\Html;
use yii\db\Expression;
use yii\helpers\Json;
/** @var yii\web\View $this */

$this->title = 'لوحة التحكم - مكتب عطوفة وكيل وزارة الصحة';

$visits = Visits::find()
    ->orderBy(['visit_date' => SORT_ASC, 'visit_time' => SORT_ASC])
    ->all();

$appointments = [];
$colors = ['#7fb0f7', '#5f9df5', '#418bf4', '#297ef7', '#1070f9', '#0063f7', '#0054e6', '#0045d4', '#0036c2', '#0027b0'];
$index = 0;

foreach ($visits as $visit) {
    $startTime = date('H:i:s', strtotime($visit->visit_time));
    $appointments[] = [
        'title' => $visit->title,
        'start' => $visit->visit_date . 'T' . $startTime,
        'url' => \yii\helpers\Url::to(['visits/view', 'id' => $visit->id]),
        'color' => $colors[$index % count($colors)],
    ];
    $index++;
}

// أحداث المناسبات
$palestinianEvents = [];
$eventDates = [
    '01-01' => 'رأس السنة الميلادية',
    '03-08' => 'يوم المرأة العالمي',
    '03-21' => 'عيد الأم',
    '05-01' => 'عيد العمال',
    '11-15' => 'إعلان الاستقلال',
    '12-25' => 'عيد الميلاد المجيد',
    '03-30' => 'يوم الأرض',
    '04-17' => 'يوم الأسير الفلسطيني',
    '05-15' => 'ذكرى النكبة',
    '06-05' => 'النكسة',
    '11-29' => 'يوم التضامن مع الشعب الفلسطيني'
];

foreach (range(2000, 2100) as $year) {
    foreach ($eventDates as $md => $title) {
        $palestinianEvents[] = [
            'title' => $title,
            'start' => "$year-$md",
            'color' => 'maroon',
        ];
    }
}

$appointments = array_merge($appointments, $palestinianEvents);


// Stats from database
$appointmentStats = Visits::find()
    ->select([new Expression("DATE_FORMAT(visit_date, '%Y-%m') as month"), 'COUNT(*) as total'])
    ->groupBy('month')->orderBy('month')->asArray()->all();
$visitorStats = Visitors::find()
    ->select([new Expression("DATE_FORMAT(created_at, '%Y-%m') as month"), 'COUNT(*) as total'])
    ->groupBy('month')->orderBy('month')->asArray()->all();
$statusStats = Visits::find()
    ->select(['status', 'COUNT(*) as total'])->groupBy('status')->asArray()->all();
$months = ['2025-01', '2025-02', '2025-03', '2025-04', '2025-05', '2025-06', '2025-07', '2025-08', '2025-09', '2025-10', '2025-11', '2025-12'];
$appointmentData = array_fill(0, 12, 0);
$visitorData = array_fill(0, 12, 0);
foreach ($appointmentStats as $row) {
    $i = array_search($row['month'], $months);
    if ($i !== false)
        $appointmentData[$i] = (int) $row['total'];
}
foreach ($visitorStats as $row) {
    $i = array_search($row['month'], $months);
    if ($i !== false)
        $visitorData[$i] = (int) $row['total'];
}
$statusLabels = array_column($statusStats, 'status');
$statusData = array_column($statusStats, 'total');

?>

<!-- FullCalendar CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<!-- Animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


<style>
    body {
        background-color: #f5f6fa;
    }

    .dashboard-welcome {
        background: linear-gradient(90deg, #3c8dbc, #00c0ef);
        color: #fff;
        padding: 40px 20px;
        border-radius: 12px;
        text-align: center;
        margin-block-end: 30px;
    }

    .dashboard-welcome h1 {
        font-size: 2.2rem;
        font-weight: bold;
    }

    .dashboard-welcome p {
        font-size: 1.1rem;
        opacity: 0.9;
    }

    .stat-card {
        background-color: #ffffff;
        border-radius: 12px;
        padding: 25px;
        text-align: center;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
        transition: 0.3s ease-in-out;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
    }

    .stat-card h3 {
        font-size: 2.2rem;
        color: #3c8dbc;
        margin-block-end: 8px;
    }

    .stat-card p {
        margin: 0;
        color: #555;
        font-weight: 500;
    }

    #calendar {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        margin-block-end: 40px;
        direction: rtl;
    }

    .fc .fc-toolbar-title {
        font-size: 1.4rem;
        font-weight: 600;
        color: #3c3c3c;
    }

    .fc-day-today {
        background-color: rgb(158, 194, 247) !important;
        border-radius: 6px;
    }

    .fc-event {
        color: #333333 !important;
        border: none !important;
        border-radius: 6px;
        padding: 4px 6px;
        font-size: 0.9rem;
        text-align: end;
    }

    .fc-button {
        background-color: #3c8dbc !important;
        border: none !important;
        border-radius: 4px !important;
        margin: 0 5px !important;
    }

    .fc-button:hover {
        background-color: #367fa9 !important;
    }

    .fc-daygrid-day {
        background-color: #fefefe;
        border: 1px solid #eee;
    }

    .fc-daygrid-day-number {
        color: rgb(65, 138, 187);
        font-weight: bold;
        font-size: 14px;
    }

    .fc-col-header-cell-cushion {
        color: #333333;
        font-weight: 600;
        font-size: 15px;
    }

    .fc-daygrid-day:hover {
        background-color: #f0f9ff;
        cursor: pointer;
    }

    .fc-day-today {
        background-color: rgb(169, 214, 255) !important;
        border-radius: 6px;

    }

    /* تمييز أيام العطل الأسبوعية (الجمعة والسبت) */
    .fc-day-sat,
    .fc-day-fri {
        background-color: rgb(249, 241, 241);
    }

    .text-success {
        color: rgb(19, 81, 139) !important;
    }
</style>


<div class="container">
    <div class="dashboard-welcome shadow-sm">
        <h1>مرحباً بك في نظام ادارة مواعيد مكتب عطوفة وكيل وزارة الصحة</h1>
        <p>لوحة التحكم الخاصة بإدارة النظام والمواعيد</p>
    </div>

    <?php
    // جيب كل مواعيد اليوم فقط
    $alerts = Visits::find()
        ->where(['visit_date' => date('Y-m-d')])
        ->orderBy(['visit_time' => SORT_ASC])
        ->all();


    if (empty($alerts)) {
        echo "<div class='alert alert-secondary'><i class='bi bi-calendar-x-fill me-2'></i> لا يوجد أي مواعيد اليوم</div>";
    } else {
        $index = 0;
        foreach ($alerts as $a) {
            $datetime = $a->visit_date . ' ' . $a->visit_time;
            $now = new DateTime();
            $visitTime = new DateTime($datetime);
            $diff = $now->diff($visitTime);
            $diffMinutes = ($diff->h * 60 + $diff->i) * ($visitTime > $now ? 1 : -1);

            // فقط أظهر إذا الفارق من 0 إلى 60 دقيقة
            if ($diffMinutes >= 0 && $diffMinutes <= 60): ?>
                <div class="alert alert-warning d-flex align-items-center shadow-lg border-start border-5 border-warning-subtle animate__animated animate__fadeInDown"
                    style="animation-delay: <?= $index * 0.3 ?>s; animation-duration: 1s;">
                    <i class="bi bi-bell-fill text-warning fs-4 me-3 animate__animated animate__flash animate__infinite"></i>
                    <div class="flex-grow-1">
                        <div class="fw-bold mb-1">⏰ موعد قادم بعد <?= $diffMinutes ?> دقيقة</div>
                        <div>
                            <strong><?= Html::encode($a->title) ?></strong>
                            <span class="text-muted">- الساعة <?= Html::encode($a->visit_time) ?></span>
                        </div>
                    </div>
                </div>
                <?php $index++; ?>
            <?php endif;
        }

    }



    ?>

    <div class="row mb-4">
        <div class="col-6 col-md-4 mb-3">
            <div class="stat-card d-flex align-items-center gap-3">
                <i class="fas fa-calendar-day fa-2x text-success"></i>
                <div>
                    <h3><?= Visits::find()->where(['visit_date' => date('Y-m-d')])->count() ?></h3>
                    <p class="mb-0">عدد مواعيد اليوم</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 mb-3">
            <div class="stat-card d-flex align-items-center gap-3">
                <i class="fas fa-calendar-alt fa-2x text-success"></i>
                <div>
                    <h3><?= Visits::find()->count() ?></h3>
                    <p class="mb-0">مجموع المواعيد</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4 mb-3">
            <div class="stat-card d-flex align-items-center gap-3">
                <i class="fas fa-calendar-alt fa-2x text-success"></i>
                <div>
                    <h3><?= Visits::find()->where(['like', 'created_at', date('Y-m')])->count() ?></h3>
                    <p class="mb-0">مجموع المراجعين لهذا الشهر</p>
                </div>
            </div>
        </div>
    </div>


    <div id="calendar"></div>
</div>

<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<?php


// المواعيد شهريًا
$appointmentStats = Visits::find()
    ->select([new Expression("DATE_FORMAT(visit_date, '%Y-%m') as month"), 'COUNT(*) as total'])
    ->groupBy('month')
    ->orderBy('month')
    ->asArray()
    ->all();

// الزوار شهريًا
$visitorStats = Visitors::find()
    ->select([new Expression("DATE_FORMAT(created_at, '%Y-%m') as month"), 'COUNT(*) as total'])
    ->groupBy('month')
    ->orderBy('month')
    ->asArray()
    ->all();

// الحالات
$statusStats = Visits::find()
    ->select(['status', 'COUNT(*) as total'])
    ->groupBy('status')
    ->asArray()
    ->all();

$appointmentLabels = array_column($appointmentStats, 'month');
$appointmentData = array_column($appointmentStats, 'total');

$visitorLabels = array_column($visitorStats, 'month');
$visitorData = array_column($visitorStats, 'total');

$statusLabels = array_column($statusStats, 'status');
$statusData = array_column($statusStats, 'total');
?>

<script>
    const appointmentByMonth = {
        labels: <?= Json::encode($appointmentLabels) ?>,
        datasets: [{
            label: 'عدد المواعيد',
            data: <?= Json::encode($appointmentData) ?>,
            backgroundColor: '#3c8dbc',
            borderRadius: 8
        }]
    };

    const visitorsByMonth = {
        labels: <?= Json::encode($visitorLabels) ?>,
        datasets: [{
            label: 'عدد المراجعين',
            data: <?= Json::encode($visitorData) ?>,
            backgroundColor: '#00a65a',
            borderRadius: 8
        }]
    };

    const appointmentStatus = {
        labels: <?= Json::encode($statusLabels) ?>,
        datasets: [{
            label: 'نسبة الحالات',
            data: <?= Json::encode($statusData) ?>,
            backgroundColor: ['#00c0ef', '#f39c12', '#00a65a', '#dd4b39', '#605ca8']
        }]
    };



</script>
<!-- الرسومات البيانية -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // FullCalendar
        var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
            locale: 'ar',
            direction: 'rtl',
            initialView: 'dayGridMonth',
            nowIndicator: true,
            height: 'auto',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            buttonText: {
                today: 'اليوم',
                month: 'شهر',
                week: 'أسبوع',
                day: 'يوم',
                list: 'قائمة'
            },
            events: <?= json_encode($appointments, JSON_UNESCAPED_UNICODE) ?>,
            eventClick: function (info) {
                info.jsEvent.preventDefault();
                if (info.event.url) {
                    $('#modal').modal('show')
                        .find('#modalContent')
                        .load(info.event.url);
                    $('#modalHeader').text(info.event.title);
                }
            },
            eventDisplay: 'block',
            eventTimeFormat: { hour: '2-digit', minute: '2-digit', hour12: true },
            dayMaxEvents: true,
            now: new Date(),
        });
        calendar.render();

        // Charts
        new Chart(document.getElementById('appointmentsByMonthChart'), {
            type: 'bar',
            data: {
                labels: <?= Json::encode($months) ?>,
                datasets: [{
                    label: 'عدد المواعيد',
                    data: <?= Json::encode($appointmentData) ?>,
                    backgroundColor: '#3c8dbc',
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    title: { display: true, text: 'عدد المواعيد لكل شهر' }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        new Chart(document.getElementById('visitorsByMonthChart'), {
            type: 'bar',
            data: {
                labels: <?= Json::encode($months) ?>,
                datasets: [{
                    label: 'عدد المراجعين',
                    data: <?= Json::encode($visitorData) ?>,
                    backgroundColor: '#00a65a',
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    title: { display: true, text: 'عدد المراجعين لكل شهر' }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        new Chart(document.getElementById('appointmentStatusChart'), {
            type: 'doughnut',
            data: {
                labels: <?= Json::encode($statusLabels) ?>,
                datasets: [{
                    data: <?= Json::encode($statusData) ?>,
                    backgroundColor: ['#00c0ef', '#f39c12', '#00a65a', '#dd4b39', '#605ca8']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: { display: true, text: 'نسبة الحالات للمواعيد' },
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: { size: 12 },
                            boxWidth: 12,
                            padding: 10
                        }
                    }
                }
            }
        });
    });
</script>


<!-- الرسومات البيانية -->
<div class="row mb-3">
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm p-3">
            <h5 class="text-center mb-3">عدد المواعيد لكل شهر</h5>
            <div><canvas id="appointmentsByMonthChart" height="200"></canvas></div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm p-3">
            <h5 class="text-center mb-3">عدد المراجعين لكل شهر</h5>
            <div><canvas id="visitorsByMonthChart" height="200"></canvas></div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm p-3" style="padding: 15px !important;">
            <h6 class="text-center mb-3" style="font-size: 16px;">نسبة الحالات للمواعيد</h6>
            <div style="height: 400px;">
                <canvas id="appointmentStatusChart"></canvas>
            </div>
        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
            locale: 'ar',
            direction: 'rtl',
            initialView: 'dayGridMonth',
            nowIndicator: true,
            height: 'auto',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            buttonText: {
                today: 'اليوم', month: 'شهر', week: 'أسبوع', day: 'يوم', list: 'قائمة'
            },
            events: <?= json_encode($appointments, JSON_UNESCAPED_UNICODE) ?>,
            eventClick: function (info) {
                info.jsEvent.preventDefault();
                if (info.event.url) {
                    $('#modal').modal('show').find('#modalContent').load(info.event.url);
                    $('#modalHeader').text(info.event.title);
                }
            }
        });
        calendar.render();

        new Chart(document.getElementById('appointmentsByMonthChart'), {
            type: 'bar',
            data: {
                labels: <?= Json::encode($months) ?>,
                datasets: [{
                    label: 'عدد المواعيد',
                    data: <?= Json::encode($appointmentData) ?>,
                    backgroundColor: '#3c8dbc',
                    borderRadius: 6
                }]
            }]
        },
            options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
        });

    new Chart(document.getElementById('visitorsByMonthChart'), {
        type: 'bar',
        data: {
            labels: <?= Json::encode($months) ?>,
            datasets: [{
                label: 'عدد المراجعين',
                data: <?= Json::encode($visitorData) ?>,
                backgroundColor: '#00a65a',
                borderRadius: 6
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
    });

    new Chart(document.getElementById('appointmentStatusChart'), {
        type: 'doughnut',
        data: {
            labels: <?= Json::encode($statusLabels) ?>,
            datasets: [{
                data: <?= Json::encode($statusData) ?>,
                backgroundColor: ['#00c0ef', '#f39c12', '#00a65a']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: {
                            size: 12
                        },
                        boxWidth: 12,
                        padding: 10
                    }
                }
            }
        }
    });


</script>