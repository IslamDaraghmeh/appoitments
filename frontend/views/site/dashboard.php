<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم - نظام الحجوزات</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: #fff;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar d-flex flex-column">
                <h4 class="text-center mt-3">القائمة</h4>
                <a href="#">لوحة التحكم</a>
                <a href="#">المواعيد</a>
                <a href="#">المراجعين</a>
                <a href="#">الموظفين</a>
                <a href="#">الإعدادات</a>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>مرحباً بك في لوحة التحكم</h2>
                    <a href="#" class="btn btn-danger">تسجيل الخروج</a>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-bg-primary mb-3">
                            <div class="card-body">
                                <h5 class="card-title">عدد المواعيد</h5>
                                <p class="card-text display-6">124</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-bg-success mb-3">
                            <div class="card-body">
                                <h5 class="card-title">عدد المراجعين</h5>
                                <p class="card-text display-6">56</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-bg-warning mb-3">
                            <div class="card-body">
                                <h5 class="card-title">عدد الموظفين</h5>
                                <p class="card-text display-6">8</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <h4>أحدث المواعيد</h4>
                    <table class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>الاسم</th>
                                <th>التاريخ</th>
                                <th>الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>محمد الخطيب</td>
                                <td>2025-05-20</td>
                                <td><span class="badge bg-success">مؤكد</span></td>
                            </tr>
                            <tr>
                                <td>ليلى عادل</td>
                                <td>2025-05-21</td>
                                <td><span class="badge bg-warning text-dark">قيد الانتظار</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>