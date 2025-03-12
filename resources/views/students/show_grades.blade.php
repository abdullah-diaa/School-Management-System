@extends('layouts.app')

@section('content')
<link href="{{ asset('css/students/show_grades.css') }}" rel="stylesheet">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @if(auth()->check()  && auth()->user()->status == '1' &&  (auth()->user()->role === 'Admin' || (auth()->user()->role === 'Student' && auth()->user()->id === $student->user_id)))

                <div class="card-header">
                    <h3 dir="rtl">&nbsp;شهادة الطالب&nbsp;:{{ $student->first_name }}&nbsp;{{ $student->last_name }}</h3>
                    <h4 dir="rtl">{{ $academicClass->class_level }}&nbsp;-{{ $academicClass->class_name }}-  </h4>
                </div>
                <div class="card-body" dir="rtl">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan="2">المادة</th>
                                    <th colspan="6">الفترة</th>
                                </tr>
                                <tr>
                                    <th>الشهر الأول</th>
                                    <th>الشهر الثاني</th>
                                    <th>منتصف العام</th>
                                    <th>الشهر الثالث</th>
                                    <th>الشهر الرابع</th>
                                    <th>الإمتحان النهائي</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($student->subjects as $subject)
                                <tr>
                                    <td>{{ $subject->name }}</td>
                                    @foreach($periods as $period)
                                    @php
                                    $grade = $grades->where('subject_id', $subject->id)->where('period', $period)->first();
                                    @endphp
                                    <td>{{ $grade ?number_format($grade->grade,0) : '' }}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
