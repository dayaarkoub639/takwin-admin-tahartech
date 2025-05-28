@extends('layouts.app')

@section('content')
<style>
    
    .modern-card {
        border: none;
        border-radius: 15px;
        color: white;
        padding: 10px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        overflow: hidden;
    }


    .modern-card .icon-circle {
        width: 50px;
        height: 50px;
        background-color: rgba(255, 255, 255, 0.15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        position: absolute;
        top: 20px;
        left: 20px;
    }

    .modern-card .card-title {
        font-size: 1.3rem;
        margin-top: 60px;
        margin-bottom: 10px;
        font-weight: bold;
    }

    .modern-card .card-text {
        font-size: 1.1rem;
    }

    .bg-gradient-blue {
        background: linear-gradient(135deg, #4e73df, #224abe);
    }

    .bg-gradient-green {
        background: linear-gradient(135deg, #1cc88a, #198754);
    }

    .bg-gradient-red {
        background: linear-gradient(135deg, #e74a3b, #c82333);
    }
</style>




<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar" dir="rtl">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active text-white" href="{{ url('/') }}">
                            <i class="fa-solid fa-house ms-2"></i></i>  الصفحة الرئيسية
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">
                            <i class="fas fa-users ms-2"></i> المستخدمون
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">
                            <i class="fas fa-cog ms-2"></i> الإعدادات
                        </a>
                    </li>
                    <!-- إضافة رابط صفحة QR في الشريط الجانبي -->
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ url('/show-qr') }}">
                            <i class="fas fa-qrcode ms-2"></i> عرض رمز الاختبار
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" dir="rtl">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2 text-right">لوحة التحكم</h1>
                <!-- إضافة زر QR في الشريط العلوي -->
                <a href="{{ url('/show-qr') }}" class="btn btn-success">
                    <i class="fas fa-qrcode"></i> عرض رمز QR
                </a>
            </div>

<div class="row text-right">
    <div class="col-md-4 mb-4">
        <div class="modern-card bg-gradient-blue">
            <div class="icon-circle">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <h5 class="card-title">المدرسين</h5>
            <p class="card-text">5 مدرس</p>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="modern-card bg-gradient-green">
            <div class="icon-circle">
                <i class="fas fa-file-alt"></i>
            </div>
            <h5 class="card-title">أوراق العمل</h5>
            <p class="card-text">120 ورقة</p>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="modern-card bg-gradient-red">
            <div class="icon-circle">
                <i class="fas fa-user-graduate"></i>
            </div>
            <h5 class="card-title">المتربصون</h5>
            <p class="card-text">15 متربص</p>
        </div>
    </div>
</div>

            <div class="d-flex justify-content-between align-items-center mt-5">
                <h2 class="text-right">أوراق العمل المضافة</h2>
                <div>
                    <a href="{{ route('worksheets.create') }}" class="btn btn-primary me-2">
                        <i class="fas fa-plus"></i> إضافة ورقة عمل
                    </a>

                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-striped text-right">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان الورقة</th>
                            <th>الوصف</th>
                            <th>عدد الأسئلة</th>
                            <th>اسم المكون</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($worksheets as $index => $worksheet)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $worksheet->title }}</td>
                            <td>{{ $worksheet->description }}</td>
                            <td>{{ $worksheet->questions->count() }}</td>
                            <td>{{ $worksheet->user->name ?? 'غير معروف' }}</td>
                            <td>
                                <form action="{{ route('worksheets.destroy', $worksheet->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من رغبتك في حذف ورقة العمل هذه؟')">
                                        <i class="fas fa-trash"></i> حذف
                                    </button>
                                </form>
                            </td>


                            <td>
    <form action="{{ route('worksheets.toggle', $worksheet->id) }}" method="POST" style="display: inline;">
        @csrf
        @method('PATCH')
        <button type="submit" class="btn btn-sm {{ $worksheet->is_active ? 'btn-success' : 'btn-warning' }}">
            <i class="fas {{ $worksheet->is_active ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
            {{ $worksheet->is_active ? 'مفعل' : 'غير مفعل' }}
        </button>
    </form>
    

</td>


<td>
    <a href="{{ route('worksheets.results', $worksheet->id) }}" class="btn btn-info btn-sm">
        <i class="fas fa-chart-bar"></i> النتائج
    </a>
    
</td>
                          

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <h2 class="text-right">آخر النشاطات</h2>
            <div class="table-responsive">
                <table class="table table-striped text-right">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>النشاط</th>
                            <th>التاريخ</th>
                            <th>الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>تسجيل دخول جديد</td>
                            <td>2023-05-01</td>
                            <td><span class="badge bg-success">نشط</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>



@endsection