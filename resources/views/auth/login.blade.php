@extends('layouts.app')

@section('content')
<div class="login-container">
    <div class="login-card">
        <!-- رأس البطاقة -->
        <div class="login-header">
            <img src="{{ asset('storage/images/logo.png') }}" alt="شعار النظام" class="login-logo">
            <h1>تسجيل الدخول</h1>
            <p>مرحباً بعودتك! يرجى إدخال بياناتك للدخول</p>
        </div>

        <!-- جسم البطاقة -->
        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf

            <!-- مجموعة البريد الإلكتروني -->
            <div class="form-group">
                <label for="email">البريد الإلكتروني</label>
                <div class="input-with-icon">
                    <i class="icon icon-email"></i>
                    <input id="email" type="email" class="@error('email') is-invalid @enderror" 
                           name="email" value="{{ old('email') }}" required autocomplete="email" 
                           placeholder="أدخل بريدك الإلكتروني" autofocus>
                </div>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- مجموعة كلمة المرور -->
            <div class="form-group">
                <label for="password">كلمة المرور</label>
                <div class="input-with-icon">
                    <i class="icon icon-password"></i>
                    <input id="password" type="password" class="@error('password') is-invalid @enderror" 
                           name="password" required autocomplete="current-password" 
                           placeholder="أدخل كلمة المرور">
                    <button type="button" class="show-password" aria-label="إظهار كلمة المرور">
                        <i class="icon icon-eye"></i>
                    </button>
                </div>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- تذكرني ونسيت كلمة المرور -->
            <div class="form-options">
                <div class="remember-me">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">تذكرني</label>
                </div>
                
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-password">
                        نسيت كلمة المرور؟
                    </a>
                @endif
            </div>

            <!-- زر تسجيل الدخول -->
            <button type="submit" class="login-button">
                تسجيل الدخول
            </button>

            <!-- رابط التسجيل -->
            @if (Route::has('register'))
                <div class="register-link">
                    ليس لديك حساب؟ <a href="{{ route('register') }}">إنشاء حساب جديد</a>
                </div>
            @endif
        </form>
    </div>
</div>

<style>
    /* التنسيقات العامة */
    :root {
        --primary-color: #4361ee;
        --primary-hover: #3a56d4;
        --text-color: #2b2d42;
        --light-gray: #f8f9fa;
        --border-color: #e9ecef;
        --error-color: #ef233c;
        --success-color: #4cc9f0;
    }
    
    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: var(--light-gray);
        padding: 20px;
        direction: rtl;
    }
    
    .login-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 450px;
        padding: 40px;
    }
    
    /* رأس البطاقة */
    .login-header {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .login-logo {
        height: 60px;
        margin-bottom: 20px;
    }
    
    .login-header h1 {
        color: var(--text-color);
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 10px;
    }
    
    .login-header p {
        color: #6c757d;
        font-size: 14px;
    }
    
    /* حقول الإدخال */
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: var(--text-color);
        font-size: 14px;
        font-weight: 500;
    }
    
    .input-with-icon {
        position: relative;
        display: flex;
        align-items: center;
    }
    
    .input-with-icon i {
        position: absolute;
        left: 15px;
        color: #adb5bd;
    }
    
    .input-with-icon input {
        width: 100%;
        padding: 12px 15px 12px 40px;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s;
    }
    
    .input-with-icon input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        outline: none;
    }
    
    .show-password {
        position: absolute;
        left: 45px;
        background: none;
        border: none;
        color: #adb5bd;
        cursor: pointer;
    }
    
    /* خيارات تذكرني ونسيت كلمة المرور */
    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 20px 0;
    }
    
    .remember-me {
        display: flex;
        align-items: center;
    }
    
    .remember-me input {
        margin-left: 8px;
    }
    
    .forgot-password {
        color: var(--primary-color);
        font-size: 13px;
        text-decoration: none;
    }
    
    .forgot-password:hover {
        text-decoration: underline;
    }
    
    /* زر تسجيل الدخول */
    .login-button {
        width: 100%;
        padding: 12px;
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .login-button:hover {
        background-color: var(--primary-hover);
    }
    
    /* رابط التسجيل */
    .register-link {
        text-align: center;
        margin-top: 20px;
        font-size: 14px;
        color: #6c757d;
    }
    
    .register-link a {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 500;
    }
    
    .register-link a:hover {
        text-decoration: underline;
    }
    
    /* رسائل الخطأ */
    .error-message {
        color: var(--error-color);
        font-size: 12px;
        margin-top: 5px;
        display: block;
    }
    
    /* الأيقونات (يمكن استبدالها بأيقونات Font Awesome) */
    .icon {
        display: inline-block;
        width: 18px;
        height: 18px;
        background-size: contain;
        background-repeat: no-repeat;
    }
    
    .icon-email {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23adb5bd'%3E%3Cpath d='M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z'/%3E%3C/svg%3E");
    }
    
    .icon-password {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23adb5bd'%3E%3Cpath d='M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z'/%3E%3C/svg%3E");
    }
    
    .icon-eye {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23adb5bd'%3E%3Cpath d='M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z'/%3E%3C/svg%3E");
    }
</style>

<script>
    // إظهار/إخفاء كلمة المرور
    document.querySelectorAll('.show-password').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.closest('.input-with-icon').querySelector('input');
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.style.backgroundImage = icon.style.backgroundImage.replace('eye', 'eye-off');
            } else {
                input.type = 'password';
                icon.style.backgroundImage = icon.style.backgroundImage.replace('eye-off', 'eye');
            }
        });
    });
</script>
@endsection