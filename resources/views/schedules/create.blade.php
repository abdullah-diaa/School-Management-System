@extends('layouts.app')

@section('content')
<link href="{{ asset('css/schedules/create.css') }}" rel="stylesheet">
      @if(auth()->check() && auth()->user()->role === 'Admin'  && auth()->user()->status == '1')       
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
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
             <div class="card" dir="rtl">
                @if(auth()->check() && auth()->user()->role === 'Admin'  && auth()->user()->status == '1')       
                    <div class="card-header">إضافة جدول دراسي جديد</div> <!-- Add New Schedule -->
                    <div class="card-body">
                        <form method="POST" action="{{ route('schedules.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">العنوان</label> <!-- Title -->
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                         

<div class="form-group row">
        <label for="file" class="col-md-4 col-form-label text-md-right">File:</label>
          <div class="col-md-6">
        <input type="file" name="file_path" class="form-control-file @error('file') is-invalid @enderror">
        @error('file')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
    </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">حفظ</button> <!-- Save -->
                                </div>
                            </div>
                        </form>
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
