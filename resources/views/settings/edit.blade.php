@extends('layouts.app')

@section('title', 'تعديل الإعدادات')

@section('content')
  <style>
        /* Main Container */
        .container {
            max-width: 100%;
            margin: 0 auto;
            padding: 20px;
            background-color: #f2f2f2;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        /* Icon link */
        .icon-link {
            display: grid;
            grid-template-columns: auto; /* Adjust column widths */
            align-items: center;
            gap: 10px; /* Add gap between icon and label */
            transition: transform 0.2s; /* Add transition effect for smooth hover */
        }

        .icon-link:hover {
            transform: translateY(-5px); /* Move icon link up slightly on hover */
        }

        /* Icon */
        .icon {
            background-color: #fff; /* Icon background color */
            border-radius: 50%; /* Rounded shape */
            width: 80px; /* Increased icon size for mobile screens */
            height: 80px; /* Increased icon size for mobile screens */
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px solid #333; /* Icon border color */
        }

        /* Icon label */
        .icon-label {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            /* Icon label color */
            margin-top: 10px; /* Adjust margin for better spacing */
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .icon-link {
                margin-bottom: 20px; /* Adjust margin for smaller screens */
            }

            .col-md-4 {
                flex-basis: 100%; /* Make columns full width on smaller screens */
                max-width: 100%;
            }
        }
    </style>
  
  
                  @if(auth()->check() && auth()->user()->role === 'Admin' && auth()->user()->status == '1')

    <div class="container">
        <!-- Settings form -->

        <!-- Icon links -->
        <div class="row">
            <!-- Icon link for changing password -->
            <div class="col-md-4 mb-3">
                <a href="{{ route('password.change') }}" class="icon-link text-decoration-none">
                    <div class="icon">
                        <i class="fas fa-key fa-3x text-dark"></i>
                    </div>
                    <div class="icon-label">تغيير كلمة المرور</div>
                </a>
            </div>

            <!-- Icon link for editing user -->
            <div class="col-md-4 mb-3">
                <a href="{{ route('dashboard.users.edit', auth()->user()->id) }}" class="icon-link text-decoration-none">
                    <div class="icon">
                        <i class="fas fa-user-edit fa-3x text-dark"></i>
                    </div>
                    <div class="icon-label">تحديث معلومات حسابي </div>
                </a>
            </div>

            <!-- Icon link for editing student data -->
        
    @elseif(auth()->check() && auth()->user()->role === 'Teacher' && auth()->user()->status == '1')
    
      <div class="container">
        <!-- Settings form -->

        <!-- Icon links -->
        <div class="row">
            <!-- Icon link for changing password -->
            <div class="col-md-4 mb-3">
                <a href="{{ route('password.change') }}" class="icon-link text-decoration-none">
                    <div class="icon">
                        <i class="fas fa-key fa-3x text-dark"></i>
                    </div>
                    <div class="icon-label">تغيير كلمة المرور</div>
                </a>
            </div>

            <!-- Icon link for editing user -->
                       <div class="col-md-4 mb-3">
                <a href="{{ route('dashboard.users.edit', auth()->user()->id) }}" class="icon-link text-decoration-none">
                    <div class="icon">
                        <i class="fas fa-user-edit fa-3x text-dark"></i>
                    </div>
                    <div class="icon-label">تحديث معلومات حسابي </div>
                </a>
            </div>

            <!-- Icon link for editing student data -->
            <div class="col-md-4 mb-3">
                <a href="{{ route('teachers.edit', auth()->user()-> teacher->id) }}" class="icon-link text-decoration-none">
                    <div class="icon">
                        <i class="fas fa-edit fa-3x text-dark"></i>
                    </div>
                    <div class="icon-label">تحديث معلوماتي الدراسية </div>
                </a>
            </div>
        </div>
    </div>
    
    
    
    
        @elseif(auth()->check() && auth()->user()->role === 'Student' && auth()->user()->status == '1')
    
      <div class="container">
        <!-- Settings form -->

        <!-- Icon links -->
        <div class="row">
            <!-- Icon link for changing password -->
            <div class="col-md-4 mb-3">
                <a href="{{ route('password.change') }}" class="icon-link text-decoration-none">
                    <div class="icon">
                        <i class="fas fa-key fa-3x text-dark"></i>
                    </div>
                    <div class="icon-label">تغيير كلمة المرور</div>
                </a>
            </div>

            <!-- Icon link for editing user -->
            <div class="col-md-4 mb-3">
                <a href="{{ route('dashboard.users.edit', auth()->user()->id) }}" class="icon-link text-decoration-none">
                    <div class="icon">
                        <i class="fas fa-user-edit fa-3x text-dark"></i>
                    </div>
                    <div class="icon-label">تحديث معلومات حسابي </div>
                </a>
            </div>

            <!-- Icon link for editing student data -->
            <div class="col-md-4 mb-3">
                <a href="{{ route('students.edit', auth()->user()->student->id) }}" class="icon-link text-decoration-none">
                    <div class="icon">
                        <i class="fas fa-edit fa-3x text-dark"></i>
                    </div>
                    <div class="icon-label">تحديث معلوماتي الدراسية </div>
                </a>
            </div>
        </div>
    </div>
    
    
    @else
                     <script>
        setTimeout(function() {
            window.location.href = "{{ route('login') }}"; // Replace 'login' with your actual route name
        }, 3000); // 3000 milliseconds = 3 seconds
    </script>
    @endif
@endsection
