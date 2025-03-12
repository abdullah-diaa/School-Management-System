@extends('layouts.app')

@section('content')
<link href="{{ asset('css/grades/create.css') }}" rel="stylesheet">
<div id="notification-container">
                @if(auth()->check() && auth()->user()->role === 'Admin'  && auth()->user()->status == '1')
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
            <div class="card" dir="rtl">
              @if(auth()->check() && auth()->user()->role === 'Admin'  && auth()->user()->status == '1')
                <div class="card-header" dir="rtl">إضافة الدرجات لـ {{ $student->first_name }} {{ $student->last_name }}</div>

                <div class="card-body" dir="rtl">
                    <form action="{{ route('grades.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                        <input type="hidden" name="student_name" value="{{ $student->id }}">
                        <input type="hidden" name="academic_class_id" value="{{ $academicClass->id }}">
                        <input type="hidden" name="student_name" value="{{ $student->first_name }} {{ $student->last_name }}">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>المادة</th>
                                        <th>الدرجة</th>
                                        <th>الفترة</th>
                                        <th>ملاحظة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subjects as $index => $subject)
                                    <tr>
                                        <td>{{ $subject->name }}</td>
                                        <td>
                                            <input type="number" name="grades[{{ $index }}][grade]" class="form-control" step="0.01" min="0" max="100" required>
                                            <input type="hidden" name="grades[{{ $index }}][subject_id]" value="{{ $subject->id }}">
                                        </td>
                                        <td>
                                            <select name="grades[{{ $index }}][period]" class="form-control" required>
                                                <option value="">اختر الشهر</option>
                                                <option value="1stmonth">الشهر الأول</option>
                                                <option value="2ndmonth">الشهر الثاني</option>
                                                <option value="midterm">الفصل الأول</option>
                                                <option value="3rdmonth">الشهر الثالث</option>
                                                <option value="4thmonth">الشهر الرابع</option>
                                                <option value="finalexam">الامتحان النهائي</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="grades[{{ $index }}][remark]" class="form-control" 
                         placeholder="أدخل ملاحظة">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">إرسال الدرجات</button>
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



