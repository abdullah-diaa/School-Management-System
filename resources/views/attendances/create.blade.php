@extends('layouts.app')

@section('content')
<link href="{{ asset('css/attendances/create.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
        <!-- Close Button -->
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
        <div class="col-md-8">
            <div class="card"  dir="rtl">
                        @if(auth()->check() && auth()->user()->role === 'Admin'  && auth()->user()->status == '1')
                <div class="card-header">إضافة الحضور للصف: {{ $academicClass->class_name }}</div>

                <div class="card-body">
                    <form action="{{ route('attendances.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="academic_class_id" value="{{ $academicClass->id }}">
                        <div class="form-group">
                            <label for="date">تاريخ الحضور:</label>
                            <input type="date" id="date" name="date" class="form-control" required>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>اسم الطالب</th>
                                        <th>الحالة</th>
                                        <th>ملاحظات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                    <tr>
                                        <td>
                                            {{ $student->first_name }} {{ $student->last_name }}
                                            <input type="hidden" name="attendance[{{ $student->id }}][student_id]" value="{{ $student->id }}">
                                        </td>
                                        <td>
                                            <select name="attendance[{{ $student->id }}][status]" class="form-control" required>
                                                <option value="1">حاضر</option>
                                                <option value="0">غائب</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="attendance[{{ $student->id }}][remarks]" class="form-control" placeholder="أدخل ملاحظة">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">حفظ الحضور</button>
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
@push('scripts')
<script>
  $('#notification-container').delay(4000).fadeOut(300)
</script>
@endpush
