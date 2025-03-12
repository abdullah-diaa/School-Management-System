@extends('layouts.app')

@section('content')
<link href="{{ asset('css/academic_classes/show.css') }}" rel="stylesheet">
<div class="container" lang="ar" dir="rtl">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">تفاصيل الصف الدراسي</div> <!-- Academic Class Details -->

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4 text-center">
                            <!-- Insert any relevant image or icon for the academic class -->
                        </div>

                        <div class="col-md-8">
                            <h4>
                             {{ $academicClass->class_level ? $academicClass->class_level : 'بيانات غير متوفرة'
                              }}_(
                              {{ $academicClass->class_name ? $academicClass->class_name : 'بيانات غير متوفرة'  
                              }}
                              )</h4>

                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th scope="row">مستوى الصف:</th> <!-- Class Level -->
                                        <td>{{ $academicClass->class_level ? $academicClass->class_level : 'بيانات غير متوفرة' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">الشعبة:</th> <!-- Class Level -->
                                        <td>{{ $academicClass->class_name ? $academicClass->class_name : 'بيانات غير متوفرة' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">السعة القصوى:</th> <!-- Capacity -->
                                        <td>{{ $academicClass->capacity ? $academicClass->capacity : 'بيانات غير متوفرة' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">تاريخ بدء الصف:</th> <!-- Start Date -->
                                        <td>{{ $academicClass->start_date ? $academicClass->start_date : 'بيانات غير متوفرة' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">تاريخ انتهاء الصف:</th> <!-- End Date -->
                                        <td>{{ $academicClass->end_date ? $academicClass->end_date : 'بيانات غير متوفرة' }}</td>
                                    </tr>
                                    <!-- Add any other relevant details for the academic class -->
                                    <tr>
                                        <th scope="row">المدرس:</th> <!-- Teacher -->
                                        <td>{{ $academicClass->classTeacher ? $academicClass->classTeacher->name : 'بيانات غير متوفرة' }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <!-- Add any relevant buttons or actions for the academic class -->
                                       @if(auth()->check() && auth()->user()->role === 'Admin')           
                                    
                                    <a href="{{ route('academic_classes.edit', $academicClass) }}" class="btn btn-danger me-2">تحرير</a>
                                 
                                 @endif
                                    <!-- Edit Button -->
                                    <!-- Add more buttons as needed -->
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
<script src="{{ asset('js/academic_classes/show.js') }}"></script>
@endpush
