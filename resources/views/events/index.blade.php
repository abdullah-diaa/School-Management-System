@extends('layouts.app')

@section('content')
<link href="{{ asset('css/events/index.css') }}" rel="stylesheet">

@if(auth()->check() && auth()->user()->role === 'Admin'  && auth()->user()->status == '1')
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
              
          @if(auth()->check() && auth()->user()->status == '1')
                <div class="card-header">قائمة الأحداث</div> <!-- Events List -->
                <div class="card-body">
                   @if(auth()->user()->role === 'Admin'  && auth()->user()->status == '1')
                      <div class="mb-3">
                       
        <a href="{{ route('events.create') }}" class="btn btn-primary">إضافة حدث جديد</a> <!-- Link to create event page -->
    </div>
    @endif
@foreach($events as $event)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $event->title }}</h5>
            <p class="card-text">{{ $event->description }}</p>
            <p class="card-text">وقت البدء: {{ $event->start_datetime ? $event->start_datetime->format('Y-m-d H:i') : 'غير محدد' }}</p>
            <p class="card-text">وقت الانتهاء: {{ $event->end_datetime ? $event->end_datetime->format('Y-m-d H:i') : 'غير محدد' }}</p>
            <p class="card-text">الموقع: {{ $event->location }}</p>
            <p class="card-text">
                @if($event->user->role === 'Admin')
                    تم النشر بواسطة : admin
                    &nbsp;
                 
                 @endif
            </p>
               @if($event->end_datetime_passed)
                <h4 class="text-danger">انتهى الموعد
                </h4>
            @endif
@if(auth()->check() && (auth()->user()->role === 'Admin'))
                <div class="mt-3">
                    <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning">تعديل</a> <!-- Edit -->
                   <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-inline" id="deleteForm">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من أنك تريد حذف هذا الحدث؟')">حذف</button> <!-- Delete -->
</form>

                </div>
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
@endsection
@push('scripts')
<script>
  $('#notification-container').delay(4000).fadeOut(300)
</script>
@endpush
