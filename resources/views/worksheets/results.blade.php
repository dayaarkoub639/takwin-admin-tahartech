@extends('layouts.app')

@section('content')
<style>
    .chart-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        padding: 20px;
        margin-bottom: 30px;
    }
    
    .chart-header {
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }
    
    .chart-title {
        color: #2c3e50;
        font-weight: 600;
        font-size: 24px;
        margin-bottom: 5px;
    }
    
    .chart-subtitle {
        color: #7f8c8d;
        font-size: 16px;
    }
    
    .chart-card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        margin-bottom: 20px;
    }
    
    .chart-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    
    .progress-container {
        margin-top: 15px;
    }
    
    .progress-label {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
        font-size: 0.85rem;
    }
    
    .progress {
        height: 10px;
        border-radius: 5px;
    }
    
    .progress-bar {
        background: linear-gradient(90deg, #3498db, #2ecc71);
    }
    
    .analysis-text {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 15px;
        margin-top: 30px;
        font-style: italic;
        color: #555;
        text-align: center;
    }
        .main-float {
        float: left;
    }

</style>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
    
        
        <!-- Main Content -->
        <main class="col-md-8 ms-sm-auto col-lg-8 px-md-4 main-float" dir="rtl">


            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2 text-right">نتائج الاستبيان: {{ $worksheet->title }}</h1>
                <a href="{{ url('/home') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> العودة
                </a>
            </div>

            <div class="chart-container">
                <div class="chart-header">
                    <h2 class="chart-title">نسبة المتكونين حسب المجالات</h2>
                    <h3 class="chart-subtitle">آخر تحديث: {{ $date }}</h3>
                </div>
                
                <canvas id="fieldsChart" height="90"></canvas>
                
                <div class="analysis-text">
                    تحليل هذه البيانات يوفر رؤى قيمة يمكن أن تساعد في تحسين البرامج التدريبية وتوجيه المتكونين للمجالات الأنسب لهم.
                </div>
            </div>

            <h3 class="mt-5 mb-4">تفاصيل النتائج حسب المجالات</h3>
            
            <div class="row">
                @foreach($fields as $field)
                <div class="col-md-6">
                    <div class="card chart-card">
                        <div class="card-body">
                            <h3 class="card-title">{{ $field->name }}</h3>
                            <p class="card-text text-muted">{{ $field->description }}</p>
                            
                            <div class="progress-container">
                                <div class="progress-label">
                                    <span>نسبة الإنجاز</span>
                                    <span>{{ $fieldStats[$field->id]['percentage'] }}%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" 
                                         style="width: {{ $fieldStats[$field->id]['percentage'] }}%" 
                                         aria-valuenow="{{ $fieldStats[$field->id]['percentage'] }}" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-3">
                                <div class="d-flex justify-content-between">
                                    <small class="text-muted">عدد المتكونين: {{ $fieldStats[$field->id]['trainees_count'] }}</small>
                                    <small class="text-muted">متوسط النقاط: {{ $fieldStats[$field->id]['avg_points'] }}/{{ $field->max_points }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </main>

          {{-- Slider Container --}}
        <div class="col-md-4 ms-sm-auto col-lg-4 px-md-4 main-float" dir="rtl>
            <div class="card shadow">
                {{-- Slider Container --}}
                <div id="adSlider" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <!-- Slide 1 -->
                        <div class="carousel-item active">
                            <img src="{{ asset('images/1.svg') }}" alt="إعلان 1" class="d-block w-100 rounded shadow-sm">
                        </div>
                        <!-- Slide 2 -->
                        <div class="carousel-item">
                            <img src="{{ asset('images/2.svg') }}" alt="إعلان 2" class="d-block w-100 rounded shadow-sm">
                        </div>
                        <!-- Slide 3 -->
                        <div class="carousel-item">
                            <img src="{{ asset('images/3.svg') }}" alt="إعلان 3" class="d-block w-100 rounded shadow-sm">
                        </div>
                                                <div class="carousel-item">
                            <img src="{{ asset('images/4.svg') }}" alt="إعلان 3" class="d-block w-100 rounded shadow-sm">
                        </div>
                    </div>
                </div>

                <div class="steps bg-light p-3 rounded text-center">
                    <h3 class="fw-bold" style="font-size: 1.4rem;"><i class="fas me-6"></i>Bureau D'étude et De Conseils TAHAR.Tech</h3>
                    <p class="mb-1" style="font-size: 1.1rem;">Adresse : 20 Rue des abeilles zabana - Blida</p>
                    <p class="mb-1" style="font-size: 1.1rem;">Mob : 0562.04.33.98</p>
                    <p class="mb-1" style="font-size: 1.1rem;">Fax : 021466120</p>
                    <p class="mb-0" style="font-size: 1.1rem;">E-mail : <a href="mailto:admin@tahar-tech.com" class="text-decoration-none">admin@tahar-tech.com</a></p>
                </div>
            </div>
        </div>   
        
</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('fieldsChart').getContext('2d');
        const fieldsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($fields->pluck('name')) !!},
                datasets: [{
                    label: 'نسبة الإنجاز (%)',
                    data: {!! json_encode($fields->map(function($field) use ($fieldStats) { 
                        return $fieldStats[$field->id]['percentage']; 
                    })) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                        x: {
                                ticks: {
                                    font: {
                                        size: 32 
                                        
                                        
                                    },
                                    maxRotation: 45, // 👈 تدوير العناوين
                                    minRotation: 0,
                                    autoSkip: false // 👈 إظهار جميع العناوين
                                }
                            },
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            stepSize: 10,
                            callback: function(value) {
                                return value + '%';
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y + '%';
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection