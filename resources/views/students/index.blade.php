@extends('layouts.app')

@section('content')

<link href="{{ asset('css/students/index.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<!-- Notification Container -->
<!-- Notification Container -->
      @if(auth()->check() && auth()->user()->role === 'Admin'  && auth()->user()->status == '1')    
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
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              
      @if(auth()->check() && auth()->user()->role === 'Admin'  && auth()->user()->status == '1')        
              
                <div class="card-header">الطلاب</div> <!-- Students -->

<div class="card-body" >
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">إدارة الطلاب</h4> <!-- Manage Students -->
                        
   
                        <a href="{{ route('students.create') }}" class="btn btn-primary">إضافة طالب</a> <!-- Add Student -->
                    </div>

                    <form action="{{ route('students.index') }}" method="GET" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="البحث بالاسم"> <!-- Search by name -->
                            <button type="submit" class="btn btn-outline-secondary">بحث</button> <!-- Search -->
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                
                                    <th>#</th>
                                    <th>رقم القبول</th> <!-- Admission Number -->
                                    <th>الاسم الأول والأخير</th> <!-- First and Last Name -->
                                  
                                    <th>
                                      
      الصف والشعبة</th> <!-- First and Last Name -->
                                    <th>تاريخ الميلاد</th> <!-- Date of Birth -->
                                    <th>ولي الأمر</th>
                                    <th>الجنس</th> <!-- Gender -->
                                    <th>العنوان</th> <!-- Address -->
                                    <th>رقم الهاتف</th> <!-- Phone Number -->
                                    <th>البريد الإلكتروني</th> <!-- Email -->
                                    <th>إسم المستخدم</th> <!-- User Name -->
                                    <th>الإجراءات</th> <!-- Actions -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                <tr>
              
                                  
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $student->admission_number }}</td>
                                    <td>{{ $student->first_name }} {{ $student->last_name }}</td>

                                    
                            
@if($student->academic_classes_id && $student->academicClass)

    <td>-{{ $student->academicClass->class_level }}-{{ $student->academicClass->class_name }}</td>

@else

    <td>بيانات غير متوفرة</td>

@endif
                                    
                                    
                                   <td>{{ optional($student->user)->date_of_birth }}</td>
                                   
                                  <td>{{ optional($student->guardians)->father_name }}</td> 
                                   
                    
                   @if($student->gender ==="male")
                                    <td>ذكر</td>
                                    @elseif($student->gender ==="female")
                                    <td>أنثى</td>
                                    @endif
                                    
                                    <td>{{ $student->address }}</td>
                                    <td>{{ $student->phone_number }}</td>
                                    <td>{{ optional($student->user)->email }}</td> <!-- Displaying user email from users table -->
                                    <td>{{ optional($student->user)->user_name}}</td> <!-- Displaying user name from users table -->
<td>
    <div class="d-flex align-items-center justify-content-center">

                                                <a href="{{ route('dashboard.users.show', $student->user_id) }}" class="btn btn-info">عرض</a>


<a href="{{ route('students.addGrades', ['student' => $student->id]) }}" class="btn btn-warning me-2 btn-add-grades">اضافة درجات</a>

       <a href="{{ route('students.show_grades', ['student_id' => $student->id]) }}" class="btn btn-primary me-2 btn-show-grades">عرض الدرجات</a>

        <a href="{{ route('students.edit', $student) }}" class="btn btn-secondary me-2">تعديل</a>
        <form action="{{ route('students.destroy', $student) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من رغبتك في حذف هذا الطالب؟')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">حذف</button>
        </form>
    </div>
</td>

                             
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
<ul class="pagination" style="flex-wrap: wrap;">
    <li class="{{ $students->previousPageUrl() ? '' : 'disabled' }}" style="margin-bottom:100px !important;">
        <a href="{{ $students->previousPageUrl() }}">Previous</a>
    </li>
    @for ($i = 1; $i <= $students->lastPage(); $i++)
        <li class="{{ $students->currentPage() == $i ? 'active' : '' }}">
            <a href="{{ $students->url($i) }}">{{ $i }}</a>
        </li>
    @endfor
    <li class="{{ $students->nextPageUrl() ? '' : 'disabled' }}">
        <a href="{{ $students->nextPageUrl() }}">Next</a>
    </li>
</ul>


<p>Showing {{ $students->firstItem() }} - {{ $students->lastItem() }} of {{ $students->total() }} students</p>

                </div>
                 
                 @else
                 
                      {{-- Handle unauthorized access here --}}
<div class="card-header">خطأ في التحميل</div>
<div class="card-body">
    <p>.عذرًا، يبدو أن هناك خطأ في تحميل الصفحة المطلوبة
</p>
</div>
                @if(auth()->check())
                 <script>
        setTimeout(function() {
            window.location.href = "{{ route('dashboard.index') }}"; // Replace 'login' with your actual route name
        }, 3000); // 3000 milliseconds = 3 seconds
    </script>
                @else
                 <script>
        setTimeout(function() {
            window.location.href = "{{ route('login') }}"; // Replace 'login' with your actual route name
        }, 3000); // 3000 milliseconds = 3 seconds
    </script>
                
                @endif
                
                 @endif
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
  $('#notification-container').delay(4000).fadeOut(300)



</script>
@endpush
