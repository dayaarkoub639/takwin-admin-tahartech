<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>مراكز تطوير المقاولاتية</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Tajawal:wght@400;500;700;900&display=swap" rel="stylesheet">

    <!-- Base Styles (Normalize + Tailwind-like Utilities) -->
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --secondary-color: #f8fafc;
            --text-color: #1e293b;
            --light-gray: #e2e8f0;
        }
        
        body {
            margin: 0;
            font-family: 'Tajawal', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            background-color: var(--secondary-color);
            color: var(--text-color);
            line-height: 1.6;
        }
        
        /* الهوامش العامة للصفحة */
        .page-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        
        a {
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
        }
        a:hover {
            color: white;
        }
        
        /* تحسينات الشريط العلوي */
        .top-bar {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .logo-container {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .logo-img {
            height: 50px;
            width: auto;
        }
        
        .site-title {
            font-size: 1.8rem;
            font-weight: 900;
            color: var(--primary-color);
            margin: 0;
        }
        
        .site-title span {
            color: var(--text-color);
        }
        
        /* تحسينات روابط التسجيل */
        .auth-links {
            display: flex;
            gap: 1.5rem;
        }
        
        .auth-link {
            font-weight: 700;
            font-size: 1.1rem;
            padding: 0.5rem 1.2rem;
            border-radius: 50px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .login-link {
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
        }
        
        .login-link:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        .register-link {
            background-color: var(--primary-color);
            color: white;
            border: 2px solid var(--primary-color);
        }
        
        .register-link:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
        }
        
        /* تحسينات قسم البطل */
        #hero {
            height: 85vh;
            background: url('/static/assets/img/hero-bg.jpg') top center/cover no-repeat;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            margin: 2rem 0;
            border-radius: 15px;
            overflow: hidden;
        }
        
        #hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.4));
        }
        
        #hero .hero-content {
            position: relative;
            z-index: 1;
            color: #fff;
            max-width: 600px;
            padding: 0 3rem;
        }
        
        #hero h1 {
            font-size: 3.5rem;
            font-weight: 900;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }
        
        #hero h2 {
            font-size: 1.8rem;
            font-weight: 500;
            margin-bottom: 2rem;
            line-height: 1.4;
        }
        
        #hero p {
            font-size: 1.2rem;
            margin-bottom: 2.5rem;
            opacity: 0.9;
        }
        
        .btn-get-started {
            display: inline-block;
            padding: 1rem 2.5rem;
            font-size: 1.1rem;
            font-weight: 700;
            border: 2px solid #fff;
            border-radius: 50px;
            color: #fff;
            transition: all 0.3s ease;
        }
        
        .btn-get-started:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
    
        
        /* تأثيرات للهواتف */
        @media (max-width: 768px) {
            .page-container {
                padding: 0 1rem;
            }
            
            #hero {
                height: 70vh;
                margin: 1rem 0;
            }
            
            #hero h1 {
                font-size: 2.5rem;
            }
            
            #hero h2 {
                font-size: 1.4rem;
            }
            
            .header-content {
                flex-direction: column;
                text-align: center;
            }
            
            .auth-links {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body class="antialiased">

<!-- الشريط العلوي مع اللوجو وروابط التسجيل -->
<div class="top-bar">
    <div class="page-container">
        <div class="header-content">
            <div class="logo-container">
                <!-- هنا يمكنك إضافة لوجو الموقع -->
                <img src="{{ asset('storage/images/logo.png') }}" 
                    alt="لوجو الموقع" 
                    class="logo-img"
                    loading="lazy"
                    width="100"
                    height="100">
                     <h1 class="site-title">نظام <span>أوراق العمل</span></h1>
            </div>
            
            <!-- روابط الدخول والتسجيل -->
            @if (Route::has('login'))
                <div class="auth-links">
                    @auth
                        <a href="{{ url('/home') }}" class="auth-link login-link">
                            🏠 لوجة التحكم
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="auth-link login-link">
                            🔐 تسجيل الدخول
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="auth-link register-link">
                                📝 إنشاء حساب
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>
</div>

<!-- القسم الرئيسي -->
<div class="page-container">
    <!-- Hero Section -->
    <section id="hero" dir="rtl">
        <div class="hero-content">
            <h1>مراكز تطوير المقاولاتية</h1>
            <h2>دعم وتكوين الشباب الحاملين لشهادات التكوين المهني لتطوير مشاريعهم المقاولاتية</h2>
            <p>مساعدتك في تطوير مشاريعك هو هدفنا من خلال تقديم تدريب احترافي ودعم مستمر</p>
        </div>
    </section>
</div>

    <footer class="footer">
        <div>      
            <p> © 2025 مكتب الدراسات و الإستشارة طاهر تاك . جميع الحقوق محفوظة.
                <span>
                  <img src="{{ asset('images/1.png') }}" alt="Logo" style="height: 40px;">
                </span>
            </p>       
        </div>
    </footer>

</body>
</html>