  @if(auth()->check() && auth()->user()->status == '1' && (auth()->user()->role === 'Admin' || auth()->user()->role === 'Teacher' || auth()->user()->role === 'Student' ))
          
                 <script>
        setTimeout(function() {
            window.location.href = "{{ route('dashboard.index') }}"; // Replace 'login' with your actual route name
        }, 1); // 3000 milliseconds = 3 seconds
    </script>
    @else
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>School management system</title>
    <link href="{{ asset('css/auth/login.css') }}" rel="stylesheet">    


</head>
<body>
            @if ($errors->any())
                <div class="error-message">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
@include('partials.navbar')
    <header>
        <h1 class="heading">مدرسة الأقلام الثانوية المختلطة</h1>

    </header>

    <div class="container">
        <div class="Fop"></div>
        <div class="rqs">
            <button class="gnt">تسجيل الدخول</button>
            <button class="enlist"><a href="{{ route('register') }}" class="rote">إنشاء حساب</a></button>
        </div>

        <div class="auth-section">

            <!-- login form -->
            

            
          
                <form method="POST" action="{{ route('login') }}" class="scheduling-box">
                    @csrf
                    
                    
                    
      <input type="email" name="email" class="email ele  @error('email') is-invalid @enderror" placeholder="أدخل بريدك الألكتروني" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    

                    
                    
              
                    
                    
                    
                               
                    
                    
                    
                    
                    
                    
                    <input type="password" name="password" class="password ele @error('password') is-invalid @enderror" placeholder="أدخل كلمة المرور" required autocomplete="current-password">
                  
                    <button type="submit" class="clkbtn">تسجيل الدخول</button>
                </form>
            

            <!-- signup form -->
            <div class="registration-box">
                <input type="text" class="name ele" placeholder="أدخل اسم المستخدم">
                <input type="email" class="email ele" placeholder="أدخل بريدك الألكتروني">
                <input type="password" class="password ele" placeholder="ادخل كلمة المرور">
                <input type="password" class="password ele" placeholder="تأكيد كلمة المرور">
                <button class="btn clkbtn">إنشاء حساب</button>
                

                
            </div>

            <!-- Error messages -->

        </div>
    </div>
  @include('partials.footer')
    <script src="{{ asset('js/auth/login.js') }}"></script>
</body>
</html>

@endif

