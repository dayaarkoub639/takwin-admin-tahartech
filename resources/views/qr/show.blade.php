@extends('layouts.app')

@section('content')
<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h3><i class="fas fa-qrcode me-2"></i>مسح رمز الاختبار</h3>
                </div>
                
                <div class="card-body p-4">
                    {{-- سطر يحتوي على QR والصورة بجانب بعض --}}
                    <div class="row">
                        {{-- رمز QR --}}
                        <div class="card-body text-center p-4">
                            <div class="qr-box my-4 p-3 bg-light rounded">
                                {!! QrCode::size(200)->generate($url) !!}
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    {{-- رابط الاختبار --}}
                    <div class="link-box bg-light p-3 rounded mb-4">
                        <p class="text-muted mb-2 text-center">رابط الاختبار:</p>
                        <div class="input-group">
                            <input type="text" class="form-control text-center" id="qr-link" value="{{ $url }}" readonly>
                            <button class="btn btn-outline-primary" onclick="copyLink()">
                                <i class="fas fa-copy"></i> نسخ
                            </button>
                        </div>
                    </div>

                    {{-- خطوات إضافية إن وجدت --}}
                    <div class="steps bg-light p-3 rounded">
                        <!-- خطوات أو تعليمات إضافية -->
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
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
</div>

<style>
    .card {
        border-radius: 10px;
        border: none;
    }
    .qr-box {
        display: inline-block;
        border: 2px dashed #dee2e6;
    }
    .steps {
        border-left: 4px solid #0d6efd;
    }
    #qr-link {
        font-size: 1.1rem;
    }
    .carousel {
        margin-bottom: 15px;
    }
    .carousel-item {
        transition: transform 1s ease-in-out;
    }
</style>

<script>
    function copyLink() {
        let linkInput = document.getElementById('qr-link');
        linkInput.select();
        document.execCommand('copy');
        
        let copyBtn = event.currentTarget;
        copyBtn.innerHTML = '<i class="fas fa-check"></i> تم النسخ!';
        
        setTimeout(() => {
            copyBtn.innerHTML = '<i class="fas fa-copy"></i> نسخ';
        }, 2000);
    }

    // Initialize slider with 3 second interval
    document.addEventListener('DOMContentLoaded', function() {
        var myCarousel = document.querySelector('#adSlider');
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: 3000,
            wrap: true
        });
    });
</script>
@endsection