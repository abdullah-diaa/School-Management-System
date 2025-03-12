@extends('layouts.app')

@section('content')
<link href="{{ asset('css/students/create.css') }}" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" dir="rtl">
                    @if(auth()->check() && auth()->user()->role === 'Admin'  && auth()->user()->status == '1')        
                <div class="card-header">إضافة صف دراسي جديد</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('academic_classes.store') }}">
                        @csrf

                        
                        <div class="form-group row">
                            <label for="class_level" class="col-md-4 col-form-label text-md-right">المستوى الدراسي</label>
                            <div class="col-md-6">
                                <input id="class_level" type="text" class="form-control @error('class_level') is-invalid @enderror" name="class_level" value="{{ old('class_level') }}" required autocomplete="class_level" autofocus>
                                @error('class_level')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
<div class="form-group row">
                            <label for="class_name" class="col-md-4 col-form-label text-md-right">اسم الصف</label>
                            <div class="col-md-6">
                                <input id="class_name" type="text" class="form-control @error('class_name') is-invalid @enderror" name="class_name" value="{{ old('class_name') }}" required autocomplete="class_name" autofocus>
                                @error('class_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="class_description" class="col-md-4 col-form-label text-md-right">وصف الصف</label>
                            <div class="col-md-6">
                                <textarea id="class_description" class="form-control @error('class_description') is-invalid @enderror" name="class_description" autocomplete="class_description" autofocus>{{ old('class_description') }}</textarea>
                                @error('class_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="class_teacher_id" class="col-md-4 col-form-label text-md-right">معلم الصف</label>
                            <div class="col-md-6">
                                <select id="class_teacher_id" class="form-control @error('class_teacher_id') is-invalid @enderror" name="class_teacher_id" autocomplete="class_teacher_id" autofocus>
                                    <option value="">اختر معلم الصف</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->first_name }}&nbsp;{{ $teacher->last_name }}</option>
                                    @endforeach
                                </select>
                                @error('class_teacher_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="capacity" class="col-md-4 col-form-label text-md-right">السعة</label>
                            <div class="col-md-6">
                                <input id="capacity" type="number" class="form-control @error('capacity') is-invalid @enderror" name="capacity" value="{{ old('capacity') }}" required autocomplete="capacity" autofocus>
                                @error('capacity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="start_date" class="col-md-4 col-form-label text-md-right">تاريخ البداية</label>
                            <div class="col-md-6">
                                <input id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date') }}" autocomplete="start_date" autofocus>
                                @error('start_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="end_date" class="col-md-4 col-form-label text-md-right">تاريخ الانتهاء</label>
                            <div class="col-md-6">
                                <input id="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ old('end_date') }}"  autocomplete="end_date" autofocus>
                                @error('end_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="subjects" class="col-md-4 col-form-label text-md-right">المواد</label>
                            <div class="col-md-6">
                                <select id="subjects" class="form-control @error('subjects') is-invalid @enderror" name="subjects[]" multiple autocomplete="subjects" autofocus>
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                                @error('subjects')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
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

@push('scripts')
<script src="{{ asset('js/students/create.js') }}"></script>
@endpush
