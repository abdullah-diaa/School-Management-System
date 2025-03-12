@extends('layouts.app')
@section('content')
<link href="{{ asset('css/schedules/index.css') }}" rel="stylesheet">

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
        <div class="col-md-10">
            <div class="card" dir="rtl">
                        <div class="mt-3">

                <div class="card-header">قائمة الجداول</div> <!-- Schedules List -->
                
                      @if(auth()->check() && auth()->user()->role === 'Admin'  && auth()->user()->status == '1')       
                 <div class="mt-3">
    <a href="{{ route('schedules.create') }}" class="btn btn-primary mb-2">إنشاء جدول جديد</a> <!-- Create new -->
</div>
@endif
                <div class="card-body">
                      @foreach($schedules as $schedule)
                        <div class="card mb-3">
                            <div class="card-body">


        <h5 class="card-title">{{ $schedule->name}}</h5>
    @if (pathinfo($schedule->file_path, PATHINFO_EXTENSION) === 'pdf')
  <a href="{{ asset($schedule->file_path) }}" download>
        <img src="{{ asset('storage/profile_pictures/vJmwV9bfZMqrXkP14fWLx29Q7aqveps2tBtseqa5.jpg') }}" alt="PDF Image" style="width: 100%;  height: auto;max-height:450px;">
      
                                @elseif (in_array(pathinfo($schedule->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                    <img src="{{ asset('storage/' . $schedule->file_path) }}" alt="Schedule Image" class="img-fluid">
                                @else
                                    <p>Unsupported file format</p>
                                @endif
                                
    
                                
                          <div class="mt-3 d-flex flex-wrap justify-content-start ">
    <a href="{{ asset('storage/' . $schedule->file_path) }}" class="btn btn-success mr-2 mb-2" onclick="return confirm('هل أنت متأكد أنك تريد تحميل الملف؟')" download>تحميل الملف</a>

    @if(auth()->check() && auth()->user()->role === 'Admin'  && auth()->user()->status == '1')
        <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-secondary mr-2 mb-2">تعديل</a> <!-- Edit -->
        <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" class="d-inline" id="deleteForm">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger mr-2 mb-2" onclick="return confirm('هل أنت متأكد من أنك تريد حذف هذا الجدول؟')">حذف</button> <!-- Delete -->
        </form>
    @endif
</div>

                            </div>
                        </div>
                    @endforeach

                </div>
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
