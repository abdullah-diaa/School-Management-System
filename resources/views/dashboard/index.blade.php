@extends('layouts.app')

@section('content')
<link href="{{ asset('css/users/index_1.css') }}" rel="stylesheet">
<link rel="stylesheet" href="/path/to/font-awesome/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-xxx" crossorigin="anonymous" />
<div id="notification-container">


<!-- Display error notification if any -->
@if ($errors->any())
    <div class="notification error">
        <i class="fas fa-exclamation-circle"></i> <!-- Error Icon -->
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li> <!-- Error Messages -->
            @endforeach
        </ul>
      
    </div>
@endif

<!-- Display success notification if any -->
@if(session('success'))
    <div class="notification success">
        <i class="fas fa-check-circle"></i> <!-- Success Icon -->
        {{ session('success') }} <!-- Success Message -->

    </div>
@endif
</div>

   @if(auth()->check() && auth()->user()->role === 'Admin'  && auth()->user()->status == '1')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
                       
            <div class="card">

                <div class="card-header">لوحة التحكم</div>

                <div class="card-body">

                    <div class="row">
                      
                      <div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">اجمالي عدد المستخدمين</h5>
            <p class="card-text">{{ $totalUsers }}</p>
        </div>
    </div>
</div>
                      <div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">المستخدمين النشطين</h5>
            <p class="card-text">{{ $activeUsers }}</p>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">المستخدمين غير النشطين</h5>
            <p class="card-text">{{ $notactiveUsers }}</p>
        </div>
    </div>
</div>

                      
                      
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                    اجمالي عدد الطلاب</h5>
                                    <p class="card-text">{{ $totalStudents }}</p>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">اجمالي عدد المعلمين</h5>
                                    <p class="card-text">{{ $totalTeachers }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">اجمالي عدد الصفوف</h5>
                                    <p class="card-text">{{ $totalClasses }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <canvas id="myChart" width="400" height="200"></canvas>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-4">
                <div class="card-header">مخطط خطي</div> <!-- Line Chart -->
                <div class="card-body">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>



</div></div>
  <div class="container">
        <!-- Settings form -->

        <!-- Icon links -->
        <div class="row">
          

            <div class="col-md-4 mb-3">
    <a href="{{ route('dashboard.users.create') }}" class="icon-link text-decoration-none">
                    <div class="icon">
                        <i class="fa fa-users fa-3x text-dark"></i>
                    </div>
                    <div class="icon-label">إنشاء مستخدم</div>
                </a>
            </div>
            
            <div class="col-md-4 mb-3">
    <a href="{{ route('students.create') }}" class="icon-link text-decoration-none">
                    <div class="icon">
                        <i class="fas fa-user-graduate menu-icon fa-3x text-dark"></i>
                    </div>
                    <div class="icon-label">إنشاء طالب</div>
                </a>
            </div>
            
            
            <div class="col-md-4 mb-3">
        <a href="{{ route('teachers.create') }}" class="icon-link text-decoration-none">
                    <div class="icon">
                        <i class="fas fa-chalkboard-teacher menu-icon fa-3x text-dark"></i>
                    </div>
                    <div class="icon-label">إنشاء معلم</div>
                </a>
            </div>
            
            
            <div class="col-md-4 mb-3">
        <a href="{{ route('subjects.create') }}" class="icon-link text-decoration-none">
                    <div class="icon">
                        <i class="fas fa-book menu-icon fa-3x text-dark"></i>
                    </div>
                    <div class="icon-label">إنشاء مادة دراسية</div>
                </a>
            </div>
            
            <div class="col-md-4 mb-3">
<a href="{{ route('academic_classes.create') }}" class="icon-link text-decoration-none">
                    <div class="icon">
                        <i class="fas fa-graduation-cap menu-icon fa-3x text-dark"></i>
                    </div>
                    <div class="icon-label">إنشاء صف أكاديمي</div>
                </a>
            </div>
            
            <div class="col-md-4 mb-3">
    <a href="{{ route('schedules.create') }}" class="icon-link text-decoration-none">
                    <div class="icon">
                        <i class="fas fa-calendar-alt menu-icon fa-3x text-dark"></i>
                    </div>
                    <div class="icon-label">إنشاء جدول دراسي</div>
                </a>
            </div>
            
            <div class="col-md-4 mb-3">
    <a href="{{ route('guardians.create') }}" class="icon-link text-decoration-none">
                    <div class="icon">
                        <i class="fas fa-user-shield menu-icon fa-3x text-dark"></i>
                    </div>
                    <div class="icon-label">إنشاء ولي أمر</div>
                </a>
            </div>
            
            
            <div class="col-md-4 mb-3">
    <a href="{{ route('assignments.create') }}" class="icon-link text-decoration-none">
                    <div class="icon">
                        <i class="fas fa-tasks menu-icon fa-3x text-dark"></i>
                    </div>
                    <div class="icon-label">إنشاء واجب دراسي</div>
                </a>
            </div>
            
            <div class="col-md-4 mb-3">
    <a href="{{ route('events.create') }}" class="icon-link text-decoration-none">
                    <div class="icon">
                        <i class="fas fa-calendar-day menu-icon fa-3x text-dark"></i>
                    </div>
                    <div class="icon-label">إنشاء حدث</div>
                </a>
            </div>
          
            


          
        </div>
    </div>
    
    </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script>
    var ctx = document.getElementById('lineChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'أداء الطلاب',
                data: [12, 19, 3, 5, 2, 3, 9],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>



   @elseif(auth()->check() && auth()->user()->role === 'Teacher'  && auth()->user()->status == '1')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
                       
            <div class="card">

                <div class="card-header">لوحة التحكم</div>

                <div class="card-body">

                    <div class="row">
                      

                    
                    <canvas id="myChart" width="400" height="200"></canvas>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-4">
                <div class="card-header">مخطط خطي</div> <!-- Line Chart -->
                <div class="card-body">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>



</div></div>
  <div class="container">
        <!-- Settings form -->

        <!-- Icon links -->
        <div class="row">
          
                   
            <div class="col-md-4 mb-3">
    <a href="{{ route('schedules.index') }}" class="icon-link text-decoration-none">
                    <div class="icon">
                        <i class="fas fa-calendar-alt menu-icon fa-3x text-dark"></i>
                    </div>
                    <div class="icon-label">عرض الجداول</div>
                </a>
            </div>
            
                        <div class="col-md-4 mb-3">
    <a href="{{ route('assignments.index') }}" class="icon-link text-decoration-none">
                    <div class="icon">
                        <i class="fas fa-tasks menu-icon fa-3x text-dark"></i>
                    </div>
                    <div class="icon-label">عرض واجباتي الدراسية</div>
                </a>
            </div>
            
                        <div class="col-md-4 mb-3">
    <a href="{{ route('events.index') }}" class="icon-link text-decoration-none">
                    <div class="icon">
                        <i class="fas fa-calendar-day menu-icon fa-3x text-dark"></i>
                    </div>
                    <div class="icon-label">عرض الأحداث</div>
                </a>
            </div>
            
            
            
            


            

            
            
            


          
        </div>
    </div>
    
    </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script>
    var ctx = document.getElementById('lineChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'أداء طلابي',
                data: [12, 19, 3, 5, 2, 3, 9],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

@elseif(auth()->check() && auth()->user()->role === 'Student'  && auth()->user()->status == '1')



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
                       
            <div class="card">

                <div class="card-header">لوحة التحكم</div>

                <div class="card-body">

                    <div class="row">
                      

                    
                    <canvas id="myChart" width="400" height="200"></canvas>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-4">
                <div class="card-header">مخطط خطي</div> <!-- Line Chart -->
                <div class="card-body">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>



</div></div>
  <div class="container">
        <!-- Settings form -->

        <!-- Icon links -->
        <div class="row">
          
                   
            <div class="col-md-4 mb-3">
    <a href="{{ route('schedules.index') }}" class="icon-link text-decoration-none">
                    <div class="icon">
                        <i class="fas fa-calendar-alt menu-icon fa-3x text-dark"></i>
                    </div>
                    <div class="icon-label">عرض الجداول</div>
                </a>
            </div>
            
                        <div class="col-md-4 mb-3">
    <a href="{{ route('assignments.index') }}" class="icon-link text-decoration-none">
                    <div class="icon">
                        <i class="fas fa-tasks menu-icon fa-3x text-dark"></i>
                    </div>
                    <div class="icon-label">عرض واجباتي الدراسية</div>
                </a>
            </div>
            
            
            
            
            
            
            
            <div class="col-md-4 mb-3">
      <a href="{{ route('students.show_grades', ['student_id' => auth()->user()->student->id]) }}" class="icon-link text-decoration-none">
                    <div class="icon">
                        <i class="fas fa-user-graduate menu-icon fa-3x text-dark"></i>
                    </div>
                    <div class="icon-label">عرض درجاتي</div>
                </a>
            </div>
            
            
            <div class="col-md-4 mb-3">
<a href="{{ route('academic_classes.show_attendances', ['academic_class_id' => auth()->user()->student->academic_classes_id, 'date' => $date ?? '']) }}" class="icon-link text-decoration-none">
                    <div class="icon">
                        <i class="fas fa-chalkboard-teacher menu-icon fa-3x text-dark"></i>
                    </div>
                    <div class="icon-label">عرض الحضور</div>
                </a>
            </div>
            
                        <div class="col-md-4 mb-3">
    <a href="{{ route('events.index') }}" class="icon-link text-decoration-none">
                    <div class="icon">
                        <i class="fas fa-calendar-day menu-icon fa-3x text-dark"></i>
                    </div>
                    <div class="icon-label">عرض الأحداث</div>
                </a>
            </div>
            
            
            
            


            

            
            
            


          
        </div>
    </div>
    
    </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script>
    var ctx = document.getElementById('lineChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'أدائي الدراسي',
                data: [12, 19, 3, 5, 2, 3, 9],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

@else
     {{-- Handle unauthorized access here --}}
     <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
                       
            <div class="card">
                <div class="card-header">خطأ في التحميل</div>
                <div class="card-body">
                    <p>.عذرًا، يبدو أن هناك خطأ في تحميل الصفحة المطلوبة</p>
                </div>


                 <script>
        setTimeout(function() {
            window.location.href = "{{ route('login') }}"; // Replace 'login' with your actual route name
        }, 3000); // 3000 milliseconds = 3 seconds
    </script>
@endif








                



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
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
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection

@push('scripts')

<script>
  $('#notification-container').delay(4000).fadeOut(300)

</script>
@endpush
