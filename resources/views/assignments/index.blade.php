@extends('layouts.app')

@section('content')
<link href="{{ asset('css/assignments/index.css') }}" rel="stylesheet">


@if(auth()->check()  && auth()->user()->status == '1' &&  (auth()->user()->role === 'Admin' || auth()->user()->role === 'Teacher'))
    {{-- Code to execute if the user is either Admin or Teacher --}}


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
        
          
            <div class="card" dir="rtl">
              
          @if(auth()->check() && auth()->user()->role === 'Admin'  && auth()->user()->status == '1')                  
                <div class="card-header">قائمة الواجبات</div> <!-- Assignments List -->
                <div class="card-body">
                        
                      <div class="mb-3">
                       
        <a href="{{ route('assignments.create') }}" class="btn btn-primary">إضافة واجب جديد</a> <!-- Link to create event page -->
    </div>
  
@foreach($assignments as $assignment)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $assignment->title }}</h5>
            <p class="card-text">{{ $assignment->description }}</p>
            <p class="card-text">الموعد النهائي: {{ $assignment->deadline ? $assignment->deadline->format('Y-m-d') : 'غير محدد' }}</p>
            <p class="card-text">الصف الدراسي: {{ $assignment->academicClass->class_level }}&nbsp;-{{ $assignment->academicClass->class_name }}-</p>
<p class="card-text">المعلم: {{ optional($assignment->teacher)->first_name }} {{ optional($assignment->teacher)->last_name }}</p>

            <p class="card-text">المادة: {{ $assignment->subject->name }}</p>
            @if($assignment->deadline_passed)
                <span class="text-danger">انتهى الموعد</span>
            @endif
            @if(auth()->user()->role === 'Admin'  && auth()->user()->status == '1')
                <div class="mt-3">
                    <a href="{{ route('assignments.edit', $assignment->id) }}" class="btn btn-primary">تعديل</a> <!-- Edit -->
                   <form action="{{ route('assignments.destroy', $assignment->id) }}" method="POST" class="d-inline" id="deleteForm">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من أنك تريد حذف هذا الواجب؟')">حذف</button> <!-- Delete -->
</form>

                </div>
            @endif
        </div>
    </div>
@endforeach

                </div>
                      @elseif(auth()->check()  && auth()->user()->status == '1' && auth()->user()->role === 'Teacher'  && \App\Models\Teacher::where('user_id', auth()->user()->id)->exists())     
                                      <div class="card-header">قائمة الواجبات</div> <!-- Assignments List -->
                <div class="card-body">
                      <div class="mb-3">
                       
        <a href="{{ route('assignments.create') }}" class="btn btn-primary">إضافة واجب جديد</a> <!-- Link to create event page -->
    </div>
@foreach($assignments as $assignment)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $assignment->title }}</h5>
            <p class="card-text">{{ $assignment->description }}</p>
            <p class="card-text">الموعد النهائي: {{ $assignment->deadline ? $assignment->deadline->format('Y-m-d') : 'غير محدد' }}</p>
            <p class="card-text">الصف الدراسي: {{ $assignment->academicClass->class_level }}&nbsp;-{{ $assignment->academicClass->class_name }}-</p>
        <p class="card-text">المعلم: {{ optional($assignment->teacher)->first_name }} {{ optional($assignment->teacher)->last_name }}</p>

            <p class="card-text">المادة: {{ $assignment->subject->name }}</p>
            @if($assignment->deadline_passed)
                <span class="text-danger">انتهى الموعد</span>
            @endif
            @if(auth()->user()->role === 'Teacher'  && auth()->user()->status == '1')
                <div class="mt-3">
                    <a href="{{ route('assignments.edit', $assignment->id) }}" class="btn btn-primary">تعديل</a> <!-- Edit -->
                   <form action="{{ route('assignments.destroy', $assignment->id) }}" method="POST" class="d-inline" id="deleteForm">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من أنك تريد حذف هذا الواجب؟')">حذف</button> <!-- Delete -->
</form>

                </div>
            @endif
        </div>
    </div>
@endforeach

                </div>
                                  @elseif(auth()->check() && auth()->user()->role === 'Student'   && auth()->user()->status == '1' && \App\Models\Student::where('user_id', auth()->user()->id)->exists())  
                                                            <div class="card-header">قائمة الواجبات</div> <!-- Assignments List -->
                <div class="card-body">
@foreach($assignments as $assignment)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $assignment->title }}</h5>
            <p class="card-text">{{ $assignment->description }}</p>
            <p class="card-text">الموعد النهائي: {{ $assignment->deadline ? $assignment->deadline->format('Y-m-d') : 'غير محدد' }}</p>
            <p class="card-text">الصف الدراسي: {{ $assignment->academicClass->class_level }}&nbsp; -{{ $assignment->academicClass->class_name }}-</p>
           <p class="card-text">المعلم: {{ optional($assignment->teacher)->first_name }} {{ optional($assignment->teacher)->last_name }}</p>

            <p class="card-text">المادة: {{ $assignment->subject->name }}</p>
            @if($assignment->deadline_passed)
                <span class="text-danger">انتهى الموعد</span>
            @endif
          
        </div>
    </div>
@endforeach

                </div>
                      
                                       @else

                {{-- Handle unauthorized access here --}}
                <div class="card-header">خطأ في التحميل</div>
                <div class="card-body">
                    <p>.عذرًا، يبدو أن هناك خطأ في تحميل الصفحة المطلوبة</p>
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