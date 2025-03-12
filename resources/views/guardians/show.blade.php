@extends('layouts.app')

@section('content')
<link href="{{ asset('css/guardians/show.css') }}" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" dir="rtl">
                   @if(auth()->check() && auth()->user()->role === 'Admin')
                <div class="card-header">تفاصيل ولي الأمر</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>اسم الأب:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $guardian->father_name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>اسم الأم:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $guardian->mother_name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>البريد الإلكتروني:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $guardian->email }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>رقم الهاتف:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $guardian->phone_number }}
                        </div>
                    </div>
                    <!-- Add other fields as needed -->
                </div>
                      @else
      {{-- Handle unauthorized access here --}}
<div class="card-header">خطأ في التحميل</div>
<div class="card-body">
    <p>.عذرًا، يبدو أن هناك خطأ في تحميل الصفحة المطلوبة
</p>
</div>
<script>
        setTimeout(function() {
            window.location.href = "{{ route('login') }}"; // Replace 'login' with your actual route name
        }, 3000); // 3000 milliseconds = 3 seconds
    </script>
            
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
