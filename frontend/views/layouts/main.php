<?php

use common\widgets\Alert;
use frontend\assets\AppAsset;
use frontend\controllers\GeneralController;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;
/** @var yii\web\View $this */

$general = new GeneralController();

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" dir="rtl" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="/css/fonts.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="/css/responsive-sidebar.css" rel="stylesheet">
    <script src="/js/sidebar-behavior.js"></script>

    <?php $this->head() ?>
</head>

<body
    class="<?= Yii::$app->controller->id === 'site' && Yii::$app->controller->action->id === 'login' ? 'bg-light' : 'd-flex' ?>">
    <?php $this->beginBody() ?>

    <?php
    $currentController = Yii::$app->controller->id;
    $currentAction = Yii::$app->controller->action->id;
    ?>

    <?php if (!($currentController === 'site' && $currentAction === 'login')): ?>
        <div class="sidebar" id="sidebar">
            <h4>لوحة التحكم</h4>
            <a href="/site/index"
                class="<?= $currentController === 'site' && $currentAction === 'index' ? 'active' : '' ?>">
                <i class="bi bi-house-door-fill"></i> الرئيسية
            </a>
            <a href="/visits/index" class="<?= $currentController === 'visits' ? 'active' : '' ?>">
                <i class="bi bi-calendar-check-fill"></i> المواعيد
            </a>
            <a href="/visitors/index" class="<?= $currentController === 'visitors' ? 'active' : '' ?>">
                <i class="bi bi-person-lines-fill"></i> المراجعين
            </a>
            <?php

            $loggedInUserRole = $general->actiongetRole(Yii::$app->user->getId());

            if ($loggedInUserRole === 'ROLE_ADMIN'): ?>
                <a href="/user/index" class="<?= $currentController === 'user' ? 'active' : '' ?>">
                    <i class="bi bi-people-fill"></i> مستخدمي النظام
                </a>
            <?php endif; ?>

        </div>
        <div class="overlay" id="overlay"></div>
    <?php endif; ?>

    <div
        class="main-content <?= $currentController === 'site' && $currentAction === 'login' ? 'container' : 'flex-grow-1 d-flex flex-column' ?>">
        <?php if (!($currentController === 'site' && $currentAction === 'login')): ?>
            <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
                <div class="container-fluid px-3 px-sm-4 d-flex justify-content-between align-items-center">
                    <button class="navbar-toggler btn btn-light me-2" type="button" id="sidebarToggle">
                        <i class="bi bi-list fs-4"></i>
                    </button>
                    <span class="navbar-brand"><?= Html::encode(Yii::$app->name) ?></span>


                    <span class="text-light small d-none d-md-inline-flex align-items-center gap-2" id="live-datetime">
                        <i class="bi bi-calendar3 me-1"></i>
                        <span id="current-date">--</span>
                        <span class="px-1">|</span>
                        <i class="bi bi-clock me-1"></i>
                        <span id="current-time">--</span>
                    </span>


                    <?php if (Yii::$app->user->isGuest): ?>
                        <?= Html::a('تسجيل الدخول', ['/site/login'], ['class' => 'btn btn-outline-light']) ?>
                    <?php else: ?>
                        <div class="dropdown text-end">
                            <button
                                class="btn btn-outline-light dropdown-toggle d-flex align-items-center justify-content-between gap-2"
                                type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false"
                                style="min-width: 140px;">
                                <span class="fw-semibold"><?= Yii::$app->user->identity->full_name ?></span>
                                <i class="bi bi-person-fill text-primary fs-5"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow text-end" aria-labelledby="userMenu">
                                <li>
                                    <hr class="dropdown-divider my-1">
                                </li>
                                <li>
                                    <?= Html::beginForm(['/site/logout'], 'post') .
                                        Html::submitButton(
                                            '<span class="text-danger">تسجيل الخروج</span><i class="bi bi-box-arrow-right text-danger ms-2"></i>',
                                            [
                                                'class' => 'dropdown-item d-flex justify-content-between align-items-center'
                                            ]
                                        ) . Html::endForm() ?>
                                </li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </nav>
        <?php endif; ?>

        <main class="content">
            <div class="container-fluid">
                <?php if (!($currentController === 'site' && $currentAction === 'login')): ?>
                    <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs'] ?? []]) ?>
                    <?= Alert::widget() ?>
                <?php endif; ?>
                <?= $content ?>
            </div>
        </main>

        <?php if (!($currentController === 'site' && $currentAction === 'login')): ?>
            <footer class="footer mt-auto py-3 text-muted text-center">
                <div class="container">
                    <p>&copy; <?= Html::encode(Yii::$app->name) ?>     <?= date('Y') ?></p>
                </div>
            </footer>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php $this->endBody() ?>
</body>

</html>

<?php
Modal::begin([
    'id' => 'modal',
    'title' => '<h5 id="modalHeader" class="modal-title text-center">...</h5>',
    'size' => Modal::SIZE_LARGE,
    'options' => ['tabindex' => false],
    'closeButton' => false,
    'footer' => Html::button('إغلاق', ['class' => 'btn btn-secondary', 'data-bs-dismiss' => 'modal']),
]);
?>
<div id="modalContent"></div>
<?php Modal::end(); ?>

<?php
$script = <<<JS
document.addEventListener("DOMContentLoaded", function () {
    
    $(document).on('click', '.showModalButton', function () {
        $('#modalHeader').text($(this).attr('title'));
        $('#modal').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
    });
});

JS;
$this->registerJs($script);
?>
<script>
    const arabicMonths = [
        "يناير", "فبراير", "مارس", "أبريل", "مايو", "يونيو",
        "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"
    ];

    function formatArabicDate(dateObj) {
        const day = dateObj.getDate();
        const monthName = arabicMonths[dateObj.getMonth()];
        const year = dateObj.getFullYear();
        return `${day} ${monthName} ${year}`;
    }

    function updateDateTime() {
        const now = new Date();

        const formattedDate = formatArabicDate(now);

        const formattedTime = now.toLocaleTimeString('en-US', {
            hour12: false,
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });

        document.getElementById('current-date').textContent = formattedDate;
        document.getElementById('current-time').textContent = formattedTime;
    }

    updateDateTime();
    setInterval(updateDateTime, 1000);
</script>

<?php $this->endPage() ?>