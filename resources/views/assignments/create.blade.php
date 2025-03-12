@extends('layouts.app')

@section('content')
<link href="{{ asset('css/assignments/create.css') }}" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" dir="rtl">
@if(auth()->check() && auth()->user()->role === 'Admin'  && auth()->user()->status == '1')       
                <div class="card-header">إضافة واجب جديد</div> <!-- Add New Assignment -->
                <div class="card-body">
                    <form method="POST" action="{{ route('assignments.store') }}">
                        @csrf

                        <div class="form-group row">
                              <label for="title" class="col-md-4 col-form-label text-md-right">العنوان</label> <!-- Title -->
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">الوصف</label> <!-- Description -->
                            <div class="col-md-6">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description" autofocus>{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="deadline" class="col-md-4 col-form-label text-md-right">الموعد النهائي</label> <!-- Deadline -->
                            <div class="col-md-6">
                                <input id="deadline" type="datetime-local" class="form-control @error('deadline') is-invalid @enderror" name="deadline" required>
                                @error('deadline')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="academic_class_id" class="col-md-4 col-form-label text-md-right">الصف الدراسي</label> <!-- Academic Class -->
                            <div class="col-md-6">
                                <select id="academic_class_id" class="form-control @error('academic_class_id') is-invalid @enderror" name="academic_class_id" required>
                                    <option value="">اختر الصف الدراسي</option> <!-- Choose Academic Class -->
                                    @foreach($academicClasses as $academicClass)
                                        <option value="{{ $academicClass->id }}">{{ $academicClass->class_level }}&nbsp; -{{ $academicClass->class_name }}- </option>
                                    @endforeach
                                </select>
                                @error('academic_class_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="teacher_id" class="col-md-4 col-form-label text-md-right">المعلم</label> <!-- Teacher -->
                            <div class="col-md-6">
                                <select id="teacher_id" class="form-control @error('teacher_id') is-invalid @enderror" name="teacher_id" required>
                                    <option value="">اختر المعلم</option> <!-- Choose Teacher -->
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->first_name }}&nbsp;{{ $teacher->last_name }}</option>
                                    @endforeach
                                </select>
                                @error('teacher_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="subject_id" class="col-md-4 col-form-label text-md-right">المادة</label> <!-- Subject -->
                            <div class="col-md-6">
                                <select id="subject_id" class="form-control @error('subject_id') is-invalid @enderror" name="subject_id" required>
                                    <option value="">اختر المادة</option> <!-- Choose Subject -->
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                                @error('subject_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">حفظ</button> <!-- Save -->
                            </div>
                        </div>
                    </form>
                </div>
                
                
                @elseif(auth()->check() && auth()->user()->role === 'Teacher'  && auth()->user()->status == '1' && \App\Models\Teacher::where('user_id', auth()->user()->id)->exists())     
                
                  <div class="card-header">إضافة واجب جديد</div> <!-- Add New Assignment -->
                <div class="card-body">
                    <form method="POST" action="{{ route('assignments.store') }}">
                        @csrf

                        <div class="form-group row">
                              <label for="title" class="col-md-4 col-form-label text-md-right">العنوان</label> <!-- Title -->
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">الوصف</label> <!-- Description -->
                            <div class="col-md-6">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description" autofocus>{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="deadline" class="col-md-4 col-form-label text-md-right">الموعد النهائي</label> <!-- Deadline -->
                            <div class="col-md-6">
                                <input id="deadline" type="datetime-local" class="form-control @error('deadline') is-invalid @enderror" name="deadline" required>
                                @error('deadline')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="academic_class_id" class="col-md-4 col-form-label text-md-right">الصف الدراسي</label> <!-- Academic Class -->
                            <div class="col-md-6">
                                <select id="academic_class_id" class="form-control @error('academic_class_id') is-invalid @enderror" name="academic_class_id" required>
                                    <option value="">اختر الصف الدراسي</option> <!-- Choose Academic Class -->
                                    @foreach($academicClasses as $academicClass)
                                        <option value="{{ $academicClass->id }}">{{ $academicClass->class_level }}&nbsp;{{ $academicClass->class_name }}- </option>
                                    @endforeach
                                </select>
                                @error('academic_class_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    
                                     <input name="teacher_id" value="{{auth()->user()->teacher->id}}" hidden >
                                  
                                     <input name="subject_id" value="{{ auth()->user()->teacher->subject_id}}" hidden >
                                  

                 


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">حفظ</button> <!-- Save -->
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
