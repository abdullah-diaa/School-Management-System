@extends('layouts.app')

@section('content')
<link href="{{ asset('css/teachers/show.css') }}" rel="stylesheet">
<div class="container" lang="ar" dir="rtl">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">تفاصيل المعلم</div> <!-- Teacher Details -->

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4 text-center">
                            <img src="{{ asset('img/teacher_profile_picture.jpg') }}" alt="Profile Picture" class="img-fluid rounded-circle" style="max-height: 200px;">
                        </div>

                        <div class="col-md-8">
                            <h4>{{ $teacher->first_name ? $teacher->first_name : 'بيانات غير متوفرة' }} {{ $teacher->last_name ? $teacher->last_name : 'بيانات غير متوفرة' }}</h4>

                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th scope="row">المادة:</th>
                                        <td>{{ $teacher->subject ? $teacher->subject->name : 'بيانات غير متوفرة' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">العنوان:</th>
                                        <td>{{ $teacher->address ? $teacher->address : 'بيانات غير متوفرة' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">رقم الهاتف:</th>
                                        <td>{{ $teacher->phone ? $teacher->phone : 'بيانات غير متوفرة' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">المؤهل العلمي:</th>
                                        <td>{{ $teacher->qualification ? $teacher->qualification : 'بيانات غير متوفرة' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">الجنس:</th>
                                        <td>{{ $teacher->gender === 'male' ? 'ذكر' : ($teacher->gender === 'female' ? 'أنثى' : 'بيانات غير متوفرة') }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                                         @if(auth()->check() && auth()->user()->role === 'Teacher')
            @if(auth()->user()->id === $Teacher->user_id)
                <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-danger me-2">تحرير</a>
            @endif
        @elseif(auth()->check() && auth()->user()->role === 'Admin')
        
            <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-danger me-2">تحرير</a>
        @endif          
                                
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
<script src="{{ asset('js/teachers/show.js') }}"></script>
@endpush
