@extends('layouts.app')

@section('content')
<link href="{{ asset('css/students/show.css') }}" rel="stylesheet">
<div class="container"   lang="ar" dir="rtl">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">تفاصيل الطالب</div> <!-- Student Details -->

                <div class="card-body">

                    <div class="row">

<div class="col-md-4 text-center">
                            <img src="{{ asset('storage/' . $student->profile_picture) }}" alt="صورة شخصية" class="img-fluid rounded-circle shadow" style="max-height: 300px;">
                        </div>

                        <div class="col-md-8">
                            <h4>{{ $student->first_name ? $student->first_name : 'بيانات غير متوفرة' }} {{ $student->last_name ? $student->last_name : 'بيانات غير متوفرة' }}</h4>

                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th scope="row">الصف الدراسي:</th>
                                        <td>{{ $student->academicClass ? $student->academicClass->class_name . ' _ ' . $student->academicClass->class_level .' _ ' : 'بيانات غير متوفرة' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">العنوان:</th>
                                        <td>{{ $student->address ? $student->address : 'بيانات غير متوفرة' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">تاريخ الميلاد:</th>
                                        <td>{{ optional($student->user)->date_of_birth ? $student->user->date_of_birth->format('Y-m-d') : 'بيانات غير متوفرة' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">الجنس:</th>
                                        <td>{{ $student->gender === 'male' ? 'ذكر' : ($student->gender === 'female' ? 'أنثى' : 'بيانات غير متوفرة') }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">المنطقة:</th>
                                        <td>{{ optional($student->user)->region ? $student->user->region : 'بيانات غير متوفرة' }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                  
                                  
                        @if(auth()->check() && auth()->user()->role === 'Student')
            @if(auth()->user()->id === $student->user_id)
                <a href="{{ route('students.edit', $student) }}" class="btn btn-danger me-2">تحرير</a>
            @endif
        @elseif(auth()->check() && auth()->user()->role === 'Admin')
        
            <a href="{{ route('students.edit', $student) }}" class="btn btn-danger me-2">تحرير</a>
        @endif          
                                  
                                  

                                
                                    <a href="{{ route('students.performance', $student->id) }}" class="btn btn-success">تحليل الأداء</a> <!-- Performance Analysis -->
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@push('scripts')
<script src="{{ asset('js/students/show.js') }}"></script>
@endpush
