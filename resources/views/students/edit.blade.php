@extends('layouts.app')

@section('content')
<link href="{{ asset('css/students/edit.css') }}" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" dir="rtl">

@if(auth()->check() && auth()->user()->role === 'Admin'  && auth()->user()->status == '1')

                <div class="card-header">تعديل بيانات الطالب</div> <!-- Edit Student Data -->

                <div class="card-body">
<form method="POST" action="{{ route('students.update', $student->id) }}">

                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="admission_number" class="col-md-4 col-form-label text-md-right">رقم القبول</label> <!-- Admission Number -->
                            <div class="col-md-6">
                                <input id="admission_number" type="text" class="form-control @error('admission_number') is-invalid @enderror" name="admission_number" value="{{ old('admission_number', $student->admission_number) }}" required autocomplete="admission_number" autofocus>
                                @error('admission_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">الاسم الأول</label> <!-- First Name -->
                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name', $student->first_name) }}" required autocomplete="first_name" autofocus>
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">اسم العائلة</label> <!-- Last Name -->
                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name', $student->last_name) }}" required autocomplete="last_name" autofocus>
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">الجنس</label> <!-- Gender -->
                            <div class="col-md-6">
                                <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" required autocomplete="gender" autofocus>
                                    <option value="male" @if($student->gender == 'male') selected @endif>ذكر</option> <!-- Male -->
                                    <option value="female" @if($student->gender == 'female') selected @endif>أنثى</option> <!-- Female -->
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">العنوان</label> <!-- Address -->
                            <div class="col-md-6">
                                <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" required autocomplete="address" autofocus>{{ old('address', $student->address) }}</textarea>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">رقم الهاتف</label> <!-- Phone Number -->
                            <div class="col-md-6">
                                <input id="phone_number" type="tel" pattern="\d{11}" title="يجب ان يحتوي على 11 رقم" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number', $student->phone_number) }}" required autocomplete="phone_number" autofocus>
                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="academic_classes_id" class="col-md-4 col-form-label text-md-right">الصف الدراسي</label> <!-- Academic Class -->
                            <div class="col-md-6">
                                <select id="academic_classes_id" class="form-control @error('academic_classes_id') is-invalid @enderror" name="academic_classes_id" required autocomplete="academic_classes_id" autofocus>
                                    <option value="">اختر الصف الدراسي</option> <!-- Choose Academic Class -->
                                    @foreach($academicClasses as $academicClass)
                                        <option value="{{ $academicClass->id }}" @if($student->academic_classes_id == $academicClass->id) selected @endif>{{ $academicClass->class_name }}-{{ $academicClass->class_level}} </option>
                                    @endforeach
                                </select>
                                @error('academic_classes_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="guardians_id" class="col-md-4 col-form-label text-md-right">ولي الأمر</label> <!-- Guardian -->
                            <div class="col-md-6">
    <select id="guardians_id" class="form-control @error('guardians_id') is-invalid @enderror" name="guardians_id"  autocomplete="guardians_id" autofocus>
                                    <option value="">اختر ولي الأمر</option> <!-- Choose Guardian -->
                                    @foreach($guardians as $guardian)
                                        <option value="{{ $guardian->id }}" @if($student->guardians_id == $guardian->id) selected @endif>{{ $guardian->father_name }}-{{ $guardian->phone_number }} </option>
                                    @endforeach
                                </select>
                                @error('guardians_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_id" class="col-md-4 col-form-label text-md-right">اسم المستخدم</label> <!-- User Name -->
                            <div class="col-md-6">
                                <select id="user_id" class="form-control @error('user_id') is-invalid @enderror" name="user_id" required autocomplete="user_id" autofocus>
                                    <option value="">اختر اسم المستخدم</option> <!-- Choose User -->
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" @if($student->user_id == $user->id) selected @endif>{{ $user->user_name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Include other input fields for editing student data -->

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">حفظ التعديلات</button> <!-- Save Changes -->
                            </div>
                        </div>
                    </form>
                </div>
                
                 @elseif(auth()->check() && auth()->user()->role === 'Student' && auth()->user()->status == '1')
                                 <div class="card-header">تعديل بيانات الطالب</div> <!-- Edit Student Data -->
                 
                <div class="card-body">
<form method="POST" action="{{ route('students.update', $student->id) }}">

                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="admission_number" class="col-md-4 col-form-label text-md-right">رقم القبول</label> <!-- Admission Number -->
                            <div class="col-md-6">
                                <input id="admission_number" type="text" class="form-control @error('admission_number') is-invalid @enderror" name="admission_number" value="{{ old('admission_number', $student->admission_number) }}" required autocomplete="admission_number" autofocus>
                                @error('admission_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">الاسم الأول</label> <!-- First Name -->
                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name', $student->first_name) }}" required autocomplete="first_name" autofocus>
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">اسم العائلة</label> <!-- Last Name -->
                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name', $student->last_name) }}" required autocomplete="last_name" autofocus>
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">الجنس</label> <!-- Gender -->
                            <div class="col-md-6">
                                <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" required autocomplete="gender" autofocus>
                                    <option value="male" @if($student->gender == 'male') selected @endif>ذكر</option> <!-- Male -->
                                    <option value="female" @if($student->gender == 'female') selected @endif>أنثى</option> <!-- Female -->
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">العنوان</label> <!-- Address -->
                            <div class="col-md-6">
                                <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" required autocomplete="address" autofocus>{{ old('address', $student->address) }}</textarea>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                        <label for="phone_number" class="col-md-4 col-form-label text-md-right">رقم الهاتف</label> <!-- Phone Number -->
                            <div class="col-md-6">
                                <input id="phone_number" pattern="\d{11}"
                          title="يجب ان يحتوي على 11 رقم"
                                id="phone_number" type="tel" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number', $student->phone_number) }}" required autocomplete="phone_number" autofocus>
                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                     
                    

        <input type="hidden" name="academic_classes_id" value="{{$student->academic_classes_id}}">
        <input type="hidden" name="user_id" value="{{$student->user_id}}">

                        <!-- Include other input fields for editing student data -->

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">حفظ التعديلات</button> <!-- Save Changes -->
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
<script src="{{ asset('js/students/edit.js') }}"></script>
@endpush
