@extends('layouts.app')

@section('content')
<link href="{{ asset('css/events/edit.css') }}" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" dir="rtl">
               @if(auth()->user()->role === 'Admin'  && auth()->user()->status == '1')
                <div class="card-header">تعديل الحدث</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('events.update', $event->id) }}">
                        @csrf
                        @method('PUT')

                        <input type="text" name="user_id" value="{{ auth()->user()->id }}" required hidden>

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">العنوان</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $event->title }}" required autofocus>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">الوصف</label>
                            <div class="col-md-6">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required>{{ $event->description }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="start_datetime" class="col-md-4 col-form-label text-md-right">وقت بدء الحدث</label>
                            <div class="col-md-6">
                                <input id="start_datetime" type="datetime-local" class="form-control @error('start_datetime') is-invalid @enderror" name="start_datetime" value="{{ date('Y-m-d\TH:i', strtotime($event->start_datetime)) }}" required>
                                @error('start_datetime')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="end_datetime" class="col-md-4 col-form-label text-md-right">وقت انتهاء الحدث</label>
                            <div class="col-md-6">
                                <input id="end_datetime" type="datetime-local" class="form-control @error('end_datetime') is-invalid @enderror" name="end_datetime" value="{{ date('Y-m-d\TH:i', strtotime($event->end_datetime)) }}" required>
                                @error('end_datetime')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="location" class="col-md-4 col-form-label text-md-right">الموقع</label>
                            <div class="col-md-6">
                                <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ $event->location }}">
                                @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">حفظ</button>
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
