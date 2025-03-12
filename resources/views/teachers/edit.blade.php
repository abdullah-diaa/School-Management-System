@extends('layouts.app')

@section('content')
<link href="{{ asset('css/teachers/edit.css') }}" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" dir="rtl">
              @if(auth()->check() && auth()->user()->role === 'Admin'  && auth()->user()->status == '1')
                <div class="card-header">تعديل بيانات المعلم</div> <!-- Edit Teacher Data -->

                <div class="card-body">
                    <form method="POST" action="{{ route('teachers.update', $teacher->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="admission_number" class="col-md-4 col-form-label text-md-right">رقم القبول</label> <!-- Admission Number -->
                            <div class="col-md-6">
                                <input id="admission_number" type="text" class="form-control @error('admission_number') is-invalid @enderror" name="admission_number" value="{{ $teacher->admission_number }}" required autocomplete="admission_number" autofocus>
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
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $teacher->first_name }}" required autocomplete="first_name" autofocus>
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
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $teacher->last_name }}" required autocomplete="last_name" autofocus>
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">رقم الهاتف</label> <!-- Phone Number -->
                            <div class="col-md-6">
                                <input pattern="\d{11}" title="يجب ان يحتوي على 11 رقم" id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $teacher->phone }}" required autocomplete="phone">
                                @error('phone')
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
                                    <option value="">اختر الجنس</option> <!-- Choose Gender -->
                                    <option value="male" {{ $teacher->gender === 'male' ? 'selected' : '' }}>ذكر</option>
                                    <option value="female" {{ $teacher->gender === 'female' ? 'selected' : '' }}>أنثى</option>
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="subject_id" class="col-md-4 col-form-label text-md-right">المادة</label> <!-- Subject -->
                            <div class="col-md-6">
                                <select id="subject_id" class="form-control @error('subject_id') is-invalid @enderror" name="subject_id" required autocomplete="subject_id">
                                    <option value="">اختر المادة</option> <!-- Choose Subject -->
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}" {{ $teacher->subject_id == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                                @error('subject_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="qualification" class="col-md-4 col-form-label text-md-right">المؤهل العلمي</label> <!-- Qualification -->
                            <div class="col-md-6">
                                <input id="qualification" type="text" class="form-control @error('qualification') is-invalid @enderror" name="qualification" value="{{ $teacher->qualification }}" autocomplete="qualification">
                                @error('qualification')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">العنوان</label> <!-- Address -->
                            <div class="col-md-6">
                                <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" autocomplete="address">{{ $teacher->address }}</textarea>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

   <div class="form-group row">
                            <label for="user_id" class="col-md-4 col-form-label text-md-right">اسم المستخدم</label> <!-- User ID -->
                            <div class="col-md-6">
                                <select id="user_id" class="form-control @error('user_id') is-invalid @enderror" name="user_id" required autocomplete="user_id" autofocus>
                                                      <option value="">اختر اسم المستخدم</option> <!-- Choose User -->
                            
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" @if($teacher->user_id == $user->id) selected @endif>{{ $user->user_name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">حفظ</button> <!-- Save -->
                            </div>
                        </div>
                    </form>
                </div>
                    
              @elseif(auth()->check() && auth()->user()->role === 'Teacher'  && auth()->user()->status == '1')
                  <div class="card-header">تعديل بيانات المعلم</div> <!-- Edit Teacher Data -->

                <div class="card-body">
                    <form method="POST" action="{{ route('teachers.update', $teacher->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="admission_number" class="col-md-4 col-form-label text-md-right">رقم القبول</label> <!-- Admission Number -->
                            <div class="col-md-6">
                                <input id="admission_number" type="text" class="form-control @error('admission_number') is-invalid @enderror" name="admission_number" value="{{ $teacher->admission_number }}" required autocomplete="admission_number" autofocus>
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
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $teacher->first_name }}" required autocomplete="first_name" autofocus>
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
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $teacher->last_name }}" required autocomplete="last_name" autofocus>
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">رقم الهاتف</label> <!-- Phone Number -->
                            <div class="col-md-6">
                                <input pattern="\d{11}" title="يجب ان يحتوي على 11 رقم" id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $teacher->phone }}" required autocomplete="phone">
                                @error('phone')
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
                                    <option value="">اختر الجنس</option> <!-- Choose Gender -->
                                    <option value="male" {{ $teacher->gender === 'male' ? 'selected' : '' }}>ذكر</option>
                                    <option value="female" {{ $teacher->gender === 'female' ? 'selected' : '' }}>أنثى</option>
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="subject_id" class="col-md-4 col-form-label text-md-right">المادة</label> <!-- Subject -->
                            <div class="col-md-6">
                                <select id="subject_id" class="form-control @error('subject_id') is-invalid @enderror" name="subject_id" required autocomplete="subject_id">
                                    <option value="">اختر المادة</option> <!-- Choose Subject -->
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}" {{ $teacher->subject_id == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                                @error('subject_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="qualification" class="col-md-4 col-form-label text-md-right">المؤهل العلمي</label> <!-- Qualification -->
                            <div class="col-md-6">
                                <input id="qualification" type="text" class="form-control @error('qualification') is-invalid @enderror" name="qualification" value="{{ $teacher->qualification }}" autocomplete="qualification">
                                @error('qualification')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">العنوان</label> <!-- Address -->
                            <div class="col-md-6">
                                <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" autocomplete="address">{{ $teacher->address }}</textarea>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <input type="hidden" name="user_id" value="{{ $teacher->user_id }}">

                        <div class="form-group row">
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
@push('scripts')
<script src="{{ asset('js/teachers/edit.js') }}"></script>
@endpush
