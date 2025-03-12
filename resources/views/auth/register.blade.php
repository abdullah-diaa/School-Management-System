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
    <link href="{{ asset('css/auth/register.css') }}" rel="stylesheet">    
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

	<!-- container div -->
	<div class="container">

		<!-- upper button section to select the login or signup form -->
		<div class="Fop"></div>
		<div class="rqs">
			<button class="gnt"><a href="{{ route('login') }}" class="rote">تسجيل الدخول</a></button>
			<button class="enlist">إنشاء حساب</button>
		</div>

		<!-- Form section that contains the login and the signup form -->
		<div class="auth-section">

		    
		  <div class="scheduling-box">
				<input type="email" class="email ele" placeholder="أدخل بريدك الألكتروني">
				<input type="password" class="password ele" placeholder="أدخل كلمة المرور">
 
				<button class="clkbtn">تسجيل الدخول</button>
			</div>
   

			<!-- signup form -->
  <form method="POST" action="{{ route('register') }}">
                        @csrf
			<div class="registration-box">
			  
			  
			  

			  
			  
			  
			  
				<input type="text" class="name ele @error('user_name') is-invalid @enderror" name="user_name"     placeholder="أدخل اسم المستخدم"  value="{{ old('user_name') }}" required autocomplete="user_name" autofocus >
				

                                
 

                                
                                
                                
				
				<input type="email" class="email ele @error('email') is-invalid @enderror" placeholder="أدخل بريدك الألكتروني" name="email" value="{{ old('email') }}" required autocomplete="email">
				

				
	
                            
				
				
				
				
				<input type="password" class="password ele @error('password') is-invalid @enderror" name="password" placeholder="أدخل كلمة المرور" required autocomplete="new-password">
				

				
	
				
				
				
<input type="hidden" name="role" value="Student"> <!-- Default value if not selected -->

				
				
				<input id="password-confirm" type="password" class="password ele" placeholder="تأكيد كلمة المرور"
name="password_confirmation" required autocomplete="new-password">




				<button type="submit" class="clkbtn">إنشاء حساب</button>
			</div>
		
		   </form>
		
      
      
      
      
		</div>
	</div>
  @include('partials.footer')
	<script src="{{ asset('js/auth/register.js') }}"></script>
</body>
</html>
        @endif