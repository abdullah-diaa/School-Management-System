@extends('layouts.app')

@section('content')
<link href="{{ asset('css/attendances/index.css') }}" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" dir="rtl" style="text-align:center;">
                    @if(auth()->check() && (auth()->user()->role === 'Admin' || auth()->user()->role === 'Student')  && auth()->user()->status == '1')        
                <div class="card-header">إسم الصف والشعبة :{{ $academicClass->class_level }} &nbsp; -{{ $academicClass->class_name }}-</div>
                <div class="card-body">
                    @foreach($attendanceData as $attendance)
                    <div class="card mb-4">
                     <div class="card-header">{{ $attendance['date']->format('Y-m-d') }}</div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>اسم الطالب</th>
                                            <th>الحالة</th>
                                            <th>الملاحظات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($attendance['attendanceRecords'] as $attendanceRecord)
                                        <tr>
                                            <td>{{ $attendanceRecord->student->first_name }} {{ $attendanceRecord->student->last_name }}</td>
                                            <td>
                                                @if($attendanceRecord->status)
                                                    <span class="badge bg-success">حاضر</span>
                                                @else
                                                    <span class="badge bg-danger">غائب</span>
                                                @endif
                                            </td>
                                            <td>{{ $attendanceRecord->remarks }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
